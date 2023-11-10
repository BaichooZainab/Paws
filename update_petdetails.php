<?php

require_once"./db/pdo.php";
require_once"./db/util.php";
session_start();


if (isset($_POST['btncancel'])) {
    header('Location: view_updated_pet.php');
    return;
    }
    //add code to check if the url contains the token “nid”
    if (!isset( $_GET["pid"] )) {
    $_SESSION['errormsg'] = "Missing Pet id";
    header('Location: view_updated_pet.php');
    return;
    }
    //add code to search tblnotice by id
    $stmt = $pdo->prepare("select * from tblpet where pet_id=:pid");
    //retrieve nid token from url and store in parameter
    $stmt->execute(array(":pid" => $_GET["pid"]));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //check if $row is strictly false
    if ($row===false ) {
    $_SESSION['errormsg'] = 'Incorrect id';
    header('Location: view_updated_pet.php');
    return;

    } else {
    $pname = htmlentities($row['pet_name']);
    $pdesc = htmlentities($row['pet_desc']);
    $ppic = htmlentities($row['pet_image']);

  
    }

    if (isset($_POST['btnupdate']) && isset($_POST['txtpetname'])) {
    $msg = validatePet();
    if (is_string($msg)) {
    $_SESSION['errormsg'] = $msg;
    header("Location: update_petdetails.php?pid=" . $row['pet_id']);
    return;
    }
    //add the update statement for all the attributes
    $sql = "update tblpet set pet_name=:pn, pet_desc=:pd, pet_image=:pimage where pet_id=:pid";
    $filename = $_FILES['pet_image']['name'];
    $stmt = $pdo->prepare($sql);
    //retrieve the form values and store in the parameters
    $stmt->execute(
    array(
    ':pn' => $_POST['txtpetname'],
    ':pd' => $_POST['txtpetd'],
    ':pimage' => $filename,
    ':pid' => $_GET["pid"]
    )
    );
    move_uploaded_file($_FILES["pet_image"]["tmp_name"], "./upload/" .
    $filename);
    $_SESSION["successmsg"] = "Pet Details Updated";
    header('Location: view_updated_pet.php');
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
<title>Update Pet Details</title>
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

<main class="col-md-7 offset-md-1 py-5">

<?php flashMessages(); ?>

<form id="frmupdpet" class="row" method="post" enctype="multipart/form-data">

<h2 class="mt-3">Update Your Pet's Details</h2>

<div class="col-md-6 pt-5">
<div class="mb-3">
<label for="txtpetname" class="form-label">Pet Name</label>
<input type="text" class="form-control" name="txtpetname"
id="txtpetname" value="<?= $pname ?>" />
</div>

<div class="mb-3">
<label for="txtpetd" class="form-label">Pet Description</label>
<input type="text" class="form-control" name="txtpetd"
id="txtpetd" value="<?= $pdesc ?>" />
</div>

<div class="mb-3">
<label for="pet_image" class="form-label">Upload Pet's Image</label>
<input class="form-control form-control-lg" id="pet_image"
name="pet_image" type="file" />

<?php
echo '<p><img id="blah" src="./upload/' . $ppic . '"
width="100px" /></p>';
?>

</div>

<button type="submit" name="btnupdate"
class="col-12 btn btn-primary btn-lg mx-auto">
Update Pet Details
</button>

<p></p>

<button type="submit" name="btncancel"
class="col-12 btn btn-primary btn-lg mx-auto">Cancel</button>

</div>

</form>

</main>

<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>