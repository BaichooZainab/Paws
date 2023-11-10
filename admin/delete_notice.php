<?php

require_once "../db/pdo.php";
require "../db/util.php";
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
<title>Pet Types</title>
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
<div class="mt-3">
<h3>Delete Notice</h3>
<table class="table table-dark table-hover table-striped w-75">
<thead>
<th>Notice Name</th>
<th>Notice Description</th>
<th>Notice Picture</th>
<th>Notice_date</th>
<th>Notice posted by ID:</th>
<th>Action</th>
</thead>

<tbody>
<?php
$stmt = $pdo->query("SELECT * FROM tblnotice");
while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $xyz = $rows['d_id'];
echo ("<tr>");
echo "<td>" . htmlentities($rows["notice_name"]) . "</td>";
echo "<td>" . htmlentities($rows["notice_desc"]) . "</td>";
echo '<td><img src="../upload/' . htmlentities($rows["picture"]) . '"
width="50px" /></td>';
echo "<td>" . htmlentities($rows['notice_date']) . "</td>";
echo "<td>" . htmlentities($rows["d_id"]) . "</td>";
//the href should link to delete.php

echo '<form id="frmdel" action="delete.php?nid=' . $rows["notice_id"] .'" method="post">

<td>
<button type="submit" name="btndel" class="col-12 btn btn-outline-danger btn-lg mx-auto"> Delete Notice </button>
</td>
</tr>
</form>';
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
