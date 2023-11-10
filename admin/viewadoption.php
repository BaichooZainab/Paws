<?php

require_once "../db/pdo.php";
require_once "../db/util.php";
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
<title>View Adoption requests</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/login.css" type="text/css">

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

<!--Icon -->
<link rel="icon" href="../assets/images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 

<script src="https://kit.fontawesome.com/8181027d18.js"crossorigin="anonymous"></script>

</head>
<body>

<?php include_once('../assets/includes/hadmin.php');?>

<!-- /Header -->


<main class="col-md-7 offset-md-1 py-5">
<?php flashMessages(); ?>
<div class="row mt-3">
<?php
if (!isset($_REQUEST['pid'])) {
echo '<h3>List of Adoption Request</h3>';
} else {
echo '<h3>List of Adoption Requests: ' . $_GET['pet_name'] . '</h3>';
}
?>
<table id="ls" class="p-4">
<thead>
<th>Pet Name</th>
<th>Pet Gender</th>
<th>Pet Image</th>
<th>Adopter Email</th>
<th>Adopter Name</th>
<th>Adopter Profile</th>
<th>Action</th>
</thead>
<tbody>
<?php
if (!isset($_REQUEST['pid'])) {
$stmt = $pdo->query("SELECT * FROM tbladoption tadopt, tblpet tp, tbladopter ta where tadopt.pet_id = tp.pet_id and tadopt.a_id = ta.a_id and tadopt.adopt_status=1");
} else {
$stmt = $pdo->prepare("SELECT * FROM tbladoption tadopt, tblpet tp, tbladopter ta where tadopt.pet_id = tp.pet_id and tadopt.a_id = ta.a_id and tadopt.adopt_status=1 and tp.pet_id =
:pid and tp.d_id = :did");

$stmt->execute(array(":did" => $_SESSION['did']));


}

//     $stmt = $pdo->prepare("SELECT
//     ado.a_id,
//     ado.a_username,
//     ado.a_email,
//     ado.a_profile,
//     adopt.pet_id,
//     pet.pet_name,
//     pet.pet_gender,
//     don.d_id,
//     don.d_username,
//     don.d_email
// FROM
//     tbladopter ado
// JOIN
//     tbladoption adopt ON ado.a_id = adopt.a_id
// JOIN
//     tblpet pet ON adopt.pet_id = pet.pet_id
// JOIN
//     tbldonator don ON pet.d_id = don.d_id
// WHERE
//      d_id = :did and adopt.adopt_status = 1");




while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo ("<tr>");
echo "<td>" . htmlentities($rows['pet_name']) . "</td>";
echo "<td>" . htmlentities($rows['pet_gender']) . "</td>";
echo '<td><img src="../upload/' .
htmlentities($rows['pet_image']) . '" width="50px" /></td>';
echo "<td>" . htmlentities($rows['a_email']) . "</td>";
echo "<td>" . htmlentities($rows['a_username']) . "</td>";
echo '<td><img src="../upload/' .
htmlentities($rows['a_profile']) . '" width="50px" /></td>';
echo ('<td><a class="btn btn-outline-warning"
href="../confirmreser.php?adoid=' . $rows['adopt_id'] . '">Confirm
Adoption</a> </td> ');
echo ("</tr>");
}
?>
</tbody>
</table>
</div>
</main>


<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>