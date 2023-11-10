<?php

require_once"../db/pdo.php";
require_once"../db/util.php";
session_start();

if (isset($_POST['btncancel'])) {
    header('Location: view_updated_pet_type.php');
    return;
    }
    //add code to check if the url contains the token “pid”
    if (!isset( $_GET["pid"] )) {
    $_SESSION['errormsg'] = "Missing pet type id";
    header('Location: view_updated_pet_type.php');
    return;
    }
    //add code to search tblpet_type by id
    $stmt = $pdo->prepare("select * from tblpet_type where species_id=:spid");
    //retrieve pid token from url and store in parameter
    $stmt->execute(array(":spid" => $_GET["pid"]));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //check if $row is strictly false
    if ($row===false ) {
    $_SESSION['errormsg'] = 'Incorrect id';
    header('Location: view_updated_pet_type.php');
    return;
    } else {
    $ptypename = htmlentities($row['species_name']);
    $sn = htmlentities($row['species_pic']);
    }
    if (isset($_POST['btnupdate']) && isset($_POST['txtspecies'])) {
    $msg = validateSpeciesName();
    $msg2 = validatepic();
    if (is_string($msg) || is_string($msg2)) {
    $_SESSION['errormsg'] = $msg . " " . $msg2;
    header("Location: update_pet_type.php?pid=" . $row['species_id']);
    return;
    }
    //add the update statement for all the attributes
    $sql = "update tblpet_type set species_name=:sn, species_pic=:sp where species_id=:spid";
    $filename = $_FILES['pic']['name'];
    $stmt = $pdo->prepare($sql);
    //retrieve the form values and store in the parameters
    $stmt->execute(
    array(
    ':sn' => $_POST['txtspecies'],
    ':sp' => $filename,
    ':spid' => $_GET["pid"]
    )
    );
    move_uploaded_file($_FILES["pic"]["tmp_name"], "../upload/" .
    $filename);
    $_SESSION["successmsg"] = "Pet Type Updated";
    header('Location: view_updated_pet_type.php');
    return;
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
<title>update Pet Type</title>
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

<form id="frmupdpet" class="row" method="post" enctype="multipart/form-data">

<h2 class="mt-3">Update Pet Type</h2>

<div class="col-md-6 pt-5">
<div class="mb-3">
<label for="txtspecies" class="form-label">Species Name</label>
<input type="text" class="form-control" name="txtspecies"
id="txtspecies" value="<?= $ptypename ?>" />
</div>


<div class="mb-3">
<label for="pic" class="form-label">Upload Pet Type Picture</label>
<input class="form-control form-control-lg" id="pic"
name="pic" type="file" />

<?php
echo '<p><img id="blah" src="../upload/' . $sn . '"
width="100px" /></p>';
?>

</div>

<button type="submit" name="btnupdate"
class="col-12 btn btn-primary btn-lg mx-auto">
Update Pet Type
</button>

<p></p>

<button type="submit" name="btncancel"
class="col-12 btn btn-primary btn-lg mx-auto">Cancel</button>

</div>

</form>

</main>


<!--Footer -->
<?php include_once('../assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>