



<?php

require_once"../db/pdo.php";
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
<title>View Adopters</title>
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
        
<!--Header-->
<?php include_once('../assets/includes/hadmin.php');?>
<!-- /Header -->


<main class="col-md-7 offset-md-1 py-5">
<div class="mt-3">
<h3>Adopters</h3>
<table class="table table-dark table-hover table-striped w-75">
<thead>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Address</th>
<th>Number</th>
<th>Username</th>
<th>Profile</th>
<th>Status</th>
<th>Location</th>
</thead>
<tbody>
<?php
//add the select statement to read table tblstandtype
$stmt = $pdo->query("select * from tbladopter");
while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
//add the attribute name
echo ("<tr>");
echo "<td>" . htmlentities($rows["a_fname"]) . "</td>";
echo "<td>" . htmlentities($rows["a_lname"]) . "</td>";
echo "<td>" . htmlentities($rows["a_email"]) . "</td>";
echo "<td>" . htmlentities($rows["a_address"]) . "</td>";
echo "<td>" . htmlentities($rows["a_number"]) . "</td>";
echo "<td>" . htmlentities($rows["a_username"]) . "</td>";
echo '<td><img src="../upload/' . htmlentities($rows["a_profile"]) . '"
width="50px" /></td>';
echo "<td>" . htmlentities($rows["a_status"]) . "</td>";
echo "<td>" . htmlentities($rows["location_id"]) . "</td>";
echo ("</tr>");
}
?>
</tbody>
</table>
</div>
</main>
    

<!--Footer -->
<?php include_once('../assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>