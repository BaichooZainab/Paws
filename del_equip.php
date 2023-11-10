<?php

require_once "./db/pdo.php";
require_once "./db/util.php";
session_start();

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Delete Notice</title>
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

<section id="courses" class="courses">
<div class="container" data-aos="fade-up">
<div class="row" data-aos="zoom-in" data-aos-delay="100">
    
<?php
//add the select statement to read table tblnotice
$stmt = $pdo->prepare('SELECT * FROM tblequipments WHERE d_id = :did');
$stmt->execute(array(':did' => $_SESSION["did"]));

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    

    echo   '<div class="col-lg-4 col-md-12 mb-4 mt-4">
    <div class="card">
      <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">';
       echo ('<img class="img-fluid" width="300px" alt="" src="./upload/' .
       htmlentities($row['equip_img']) . '">' . "\n");
        echo '<a href="#">
          <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
        </a>
      </div>';
      echo '<div class="card-body">
      <h5 class="card-title"><a href="">' . htmlentities($row['equip_name']) .
      '</a></h5>';

      echo '<p class="card-text">' . htmlentities($row['equip_desc']) . '</p>';


echo '<a href="delete.php?eid=' . $row['equip_id'] . '" class="btn btn-primary">delete equipments</a>

</div>
</div>
</div>';
}
?>

</div>
</div>
</section>

<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>