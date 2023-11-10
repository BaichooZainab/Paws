<?php
require_once "./db/pdo.php";
require_once "./db/util.php";

session_start();


if (!isset($_SESSION['aid'])) {
    header("Location: login.php");
    exit; // Ensure the script stops execution after redirecting
}

if (isset($_POST['btncancel'])) {
    header('Location: index.php');
    exit;
}


$pid = isset($_GET['pid']) ? $_GET['pid'] : null;

$stmt1 = $pdo->prepare("SELECT * FROM tbladoption WHERE a_id = :aid AND pet_id = :pid");
$stmt1->execute(
    array(
        ":aid" => $_SESSION['aid'],
        ":pid" => $pid
    )
);
$srow1 = $stmt1->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM tblpet WHERE pet_id = :pid");
$stmt->execute(array(":pid" => $pid));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$pic = htmlentities($row['pet_image']);

if (isset($_POST['btnadopt'])) {

  $pid = $_POST['pid'];


    $d = new DateTime('now');
    $d->setTimezone(new DateTimeZone('GMT+4'));
    //$datetime = $d->format('Y-m-d H:i:s');
    $date = $d->format('Y-m-d');


    $pid = $_GET['pid'];
    
    $sql = "INSERT INTO tbladoption (adopt_date, adopt_status, a_id, pet_id) VALUES (:adopdate, 1, :aid, :pid)";
    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute(
        array(
           ':adopdate' => $date,
            ':aid' => $_SESSION['aid'],
            ':pid' => $pid
        )
    );

    $_SESSION['successmsg'] = "Adoption successful";
    $_SESSION['adopt'] = "Adopted";
    header("Location: adopt.php?pid=" . $pid);
    exit;
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
<title>Adoption Process</title>
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
<div class="container">
<div class="row" data-aos="zoom-in" data-aos-delay="100">
<div class="col-md-5 pt-5">
<?php
echo '<p><img id="blah" class="zz_image img-fluid h-
50" src="upload/' . $pic . '" /></p>';
?>
</div>
<div class="col-md-6 pt-5 offset-md-1">
<h3>
<?php
flashMessages();
?>
</h3>
<form id="frmadopt" method="post"
enctype="multipart/form-data" onsubmit="return validate();">

<div class="mb-3">
<label for="txtpetname" class="form-
label">Pet Name</label>
<input type="text" class="form-control"
name="txtpetname" id="txtpetname" readonly="true" value="<?= $row['pet_name']
?>" />
</div>

<input type="hidden" class="form-control"
name="aid" id="aid" readonly="true" value="<?= $_SESSION['aid'] ?>"/>


<div class="mb-3">
<label for="txtpetgender" class="form-
label">Pet Gender</label>
<input type="text" class="form-control"
name="txtpetgender" id="txtpetgender" readonly="true" value="<?= $row['pet_gender']
?>" />
</div>

<div class="mb-3">
<label for="txtpdesc" class="form-
label">Pet Description</label>
<textarea id="txtpdesc" readonly="true"
class="form-control" rows="4"><?= $row['pet_desc'] ?></textarea>
</div>

<div class="mb-3">
<label for="txtspecies" class="form-
label">Pet Species</label>
<input type="text" class="form-control"
name="txtspecies" id="txtspecies" readonly="true" value="<?= $row['species_id']
?>" />
</div>

<div class="mb-3">
<label for="txtadate" class="form-
label">Arrivals Date</label>
<input type="date" class="form-control"
name="txtadate" id="txtadate" readonly="true" value="<?= $row['arrival_date']
?>" />
</div>


<?php
if (isset($_GET["pid"])) {
echo ' <button type="submit"
name="btnadopt" class="col-12 btn btn-primary btn-lg mx-auto">
Adopt Pet
</button>
<p></p>
<button type="submit" name="btncancel" class="col-12 btn btn-primary
btn-lg mx-auto">
Cancel
</button>
';
}
?>
</div>
</div>
</div>

<!-- End Trainers Section -->
</main>

<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 


<script type="text/javascript">
function validate() {
var result = confirm("Do you want to proceed?");
return result;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>