<?php

require_once"./db/pdo.php";
require_once"./db/util.php";
session_start();


if (isset($_POST['btncancel'])) {
    header('Location: view_updated_equip.php');
    return;
    }
    //add code to check if the url contains the token “nid”
    if (!isset( $_GET["eid"] )) {
    $_SESSION['errormsg'] = "Missing Equipment id";
    header('Location: view_updated_equip.php');
    return;
    }
    //add code to search tblnotice by id
    $stmt = $pdo->prepare("select * from tblequipments where equip_id=:eid");
    //retrieve nid token from url and store in parameter
    $stmt->execute(array(":eid" => $_GET["eid"]));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //check if $row is strictly false
    if ($row===false ) {
    $_SESSION['errormsg'] = 'Incorrect id';
    header('Location: view_updated_equip.php');
    return;

    } else {
    $ename = htmlentities($row['equip_name']);
    $edesc = htmlentities($row['equip_desc']);
    $epic = htmlentities($row['equip_img']);
   
    }

    if (isset($_POST['btnupdate']) && isset($_POST['txtename'])) {
    $msg = validateEquipName();
    if (is_string($msg)) {
    $_SESSION['errormsg'] = $msg;
    header("Location: update_equip.php?eid=" . $row['equip_id']);
    return;
    }
    //add the update statement for all the attributes
    $sql = "update tblequipments set equip_name=:en, equip_desc=:ed, equip_img=:ep, equip_date=:edate where equip_id=:eid";
    $filename = $_FILES['equip_img']['name'];
    $stmt = $pdo->prepare($sql);
    //retrieve the form values and store in the parameters
    $stmt->execute(
    array(
    ':en' => $_POST['txtename'],
    ':ed' => $_POST['txted'],
    ':ep' => $filename,
    ':edate' => $_date,
    ':eid' => $_GET["eid"]
    )
    );
    move_uploaded_file($_FILES["equip_img"]["tmp_name"], "./upload/" .
    $filename);
    $_SESSION["successmsg"] = "Equipments Updated";
    header('Location: view_updated_equip.php');
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
<title>Update Equipments</title>
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

<h2 class="mt-3">Update Your Posted Equipments</h2>

<div class="col-md-6 pt-5">
<div class="mb-3">
<label for="txtename" class="form-label">Title Name</label>
<input type="text" class="form-control" name="txtename"
id="txtename" value="<?= $ename ?>" />
</div>

<div class="mb-3">
<label for="txted" class="form-label">Equipment's Description</label>
<input type="text" class="form-control" name="txted"
id="txted" value="<?= $edesc ?>" />
</div>

<div class="mb-3">

<input class="form-control" id="txtedate" name="txtedate" value="<?=$edate?>" type="hidden" />
</div>

<div class="mb-3">
<label for="equip_img" class="form-label">Upload Equipments Picture Here</label>
<input class="form-control form-control-lg" id="equip_img"
name="equip_img" type="file" />

<?php
echo '<p><img id="blah" src="./upload/' . $epic . '"
width="100px" /></p>';
?>

</div>

<button type="submit" name="btnupdate"
class="col-12 btn btn-primary btn-lg mx-auto">
Update Equipment
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