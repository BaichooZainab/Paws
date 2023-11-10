<?php

require_once "./db/pdo.php";
require_once "./db/util.php";

session_start();

unset($_SESSION["pet_name"]);

if (isset($_SESSION["adopt"])) {
unset($_SESSION["adopt"]);
}

if (isset($_GET["pid"])) {

$_SESSION["pet_id"] = $_GET["pid"];

$_SESSION["pet_name"] = $_GET["pet_name"];

} else {

 $_SESSION["errormsg"] = "!";
  
header('Location: postpets.php');

}
?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Adoption Process Details</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/login.css" type="text/css">

<!--Icon -->

<link rel="icon" href="assets/images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 

<script src="https://kit.fontawesome.com/8181027d18.js"crossorigin="anonymous"></script>

</head>
<body>

<!--Header-->
<?php include_once('assets/includes/header.php');?>
<!-- /Header -->

<main>
<!-- ======= Breadcrumbs ======= -->

<div class="container">

<?php
if (isset($_SESSION["pet_name"])) {
echo '<h2>' . $_SESSION['pet_name'] . '</h2>';
} else {
echo '<h2>Adopt and welcome them into your family</h2>';
}
?>


</div>


<section id="courses" class="courses">
<div class="container" data-aos="fade-up">
<div class="row" data-aos="zoom-in" data-aos-delay="100">

<?php
$stmt = $pdo->prepare('SELECT * FROM tblpet WHERE pet_id = :pid');

$stmt->execute(
    array(
    ':pid' => $_GET['pid']

    )
    );

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo ' <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
<div class="course-item">';
echo ('<img class="img-fluid" alt="" src="./upload/' .
htmlentities($row['pet_image']) . '">' . "\n");
echo ' <div class="course-content">
<div class="d-flex justify-content-between align-items-center
mb-3">
<h4>' . htmlentities($row['pet_desc']) . '</h4>';
echo ' <p>' . htmlentities($row['pet_gender']) .
'</p>';
echo ' </div>';
echo ' <div class="trainer d-flex justify-content-between alignitems-
center">';
echo ' <div class="trainer-profile d-flex align-items-center">';

echo ' </div> ';
//Add code to customize buttons here

echo ' <div class="trainer-rank d-flex align-items-center">';
$stmt3 = $pdo->prepare("SELECT * FROM tbladoption
where a_id = :aid and pet_id = :pid");
$stmt3->execute(
array(
':aid' => $_SESSION["aid"],
':pid' => $row['pet_id']
)
);
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
if ($row3 === false) {
echo ' &nbsp;&nbsp;
<a class="btn btn-outline-success"
href="adopt.php?pid=' . $row['pet_id'] . '">
<i class="bx bx-heart"></i>&nbsp;Adopt</a>&nbsp;';
} elseif ($row3["adopt_status"] == 1) {
echo ' &nbsp;&nbsp;
<p class="btn btn-warning text-white">
<i class="bx bx-heart"></i>&nbsp;Waiting for confirmation</p>&nbsp;';
} elseif ($row3["adopt_status"] == 2) {
echo ' &nbsp;&nbsp;
<p class="btn btn-danger text-white">
<i class="bx bx-heart"></i>&nbsp;Already adopted</p>&nbsp;';
}
echo '</div>';

echo '
</div>
</div>
</div>
</div> <!-- End Item-->';
}
?>

</div>
</div>
</section>
</main>
<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>