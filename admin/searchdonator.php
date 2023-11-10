<?php

require_once "../db/pdo.php";
require "../db/util.php";
session_start();

if (isset($_POST['btncancel'])) {
header('Location: searchdonator.php');
return;
}

if (isset($_POST['txtduname'])) {
//call the validateduname function
$msg = validateDUName() ;
if (is_string($msg)) {
$_SESSION['errormsg'] = $msg;
header("Location: searchdonator.php");
return;
}
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
<title>Search Donator</title>
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
    <?php flashMessages(); ?>
    <div class="row">
<div class="col-md-6 border border-1">

<form id="frmsearchpettype" method="post" enctype="multipart/form-data">

<h2 class="mt-3">Search Donator By Username</h2>

<div class="mb-3">
<label for="txtduname" class="form-label">Username</label>
<input type="text" class="form-control" name="txtduname" id="txtduname" />

</div>

<button type="submit" name="btnsearch" class="col-12 btn btn-primary btn-lg mx-auto">Search Donator</button>

<p></p>

<button type="submit" name="btncancel" class="col-12 btn btn-primary btn-lg mx-auto">Cancel</button>

</form>

</div>

<div class="col-md-5 offset-md-1 border border-1">

<h3 class="mt-3">Donator Listing</h3>

<table class="table table-dark table-hover table-striped w-100">
<thead>
<th>Username</th>
<th>Donator Profile</th>
</thead>
<tbody>

<?php
//verify if the textbox has not been set
if (!isset($_POST["txtduname"] )) {
//add the sql to read the table tbldonator
$stmt = $pdo->query("select * from tbldonator");
} else {

//add the sql to search the table by username
$stmt = $pdo->prepare("select * from tbldonator where d_username = :duname ");
//retrieve the textbox value
$stmt->execute(array(":duname" => $_POST["txtduname"]));
}
while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo ("<tr>");
//add the attribute names
echo "<td>" . htmlentities($rows["d_username"]) . "</td>";
echo '<td><img src="../upload/' . htmlentities($rows["d_profile"]) . '"
width="50px" /></td>';
echo ("</tr>");
}
?>

</tbody>
</table>
</div>
</div>
</main>


<!--Footer -->
<?php include_once('../assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>