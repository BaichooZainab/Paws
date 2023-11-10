<?php
require_once "./db/pdo.php";
require_once "./db/util.php";

session_start();

checkUserAuth();

if (isset($_POST['btncancel'])) {
    header('Location: index.php');
    return;
    }
    if (isset($_POST['btnupdate'])) {
    $msg = validateOPass();
    $msg2 = validateConPass();
    $msg3 = validateNewPass();
    if (is_string($msg) || is_string($msg2) || is_string($msg3)) {
    $_SESSION['errormsg'] = "$msg <br/> $msg2 <br/> $msg3";
    header("Location: change_apass.php");
    return;
    }
    $stmt = $pdo->prepare("SELECT a_id, a_pass
    FROM tbladopter where a_id = :aid");
    $stmt->execute(
    array(
    ':aid' => $_SESSION['aid']
    )
    );
    
    $srow = $stmt->fetch(PDO::FETCH_ASSOC);
    //encrypt the password
    $oldpass = hash('md5',$_POST['txtoldpass']);
    if ($srow["a_pass"] == $oldpass) {
    //encrypt the new password
    $newpass = hash('md5', $_POST['txtnewpass']);
    //add sql to update the client password
    $sql = "UPDATE tbladopter SET a_pass = :apass WHERE a_id = :aid";
    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute(
    array(
    ':aid' => $_SESSION['aid'],
    ':apass' => $newpass
    )
    );
    $_SESSION['successmsg'] = "Your password has been changed";
    header("Location: change_apass.php");
    return;
    } else {
    $_SESSION['errormsg'] = "Old password does not match!";
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
<title>Change Password</title>
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
<section id="trainers" class="trainers">
<div class="container" data-aos="fade-up">
<div class="row" data-aos="zoom-in" data-aos-delay="100">
<div class="col-md-5 pt-5">
<img src="../images/setting.jpg" class="img-fluid h-50" />
</div>
<div class="col-md-6 pt-5 offset-md-1">
<h3><?php flashMessages(); ?></h3>
<form id="frmmoapass" method="post" enctype="multipart/formdata">
<div class="mb-3">
<label for="txtpass" class="form-label">Old Password</label>
<input type="password" class="form-control"
name="txtoldpass" id="txtoldpass" />
</div>
<div class="mb-3">

<label for="txtnewpass" class="form-label">New
Password</label>
<input type="password" class="form-control"
name="txtnewpass" id="txtnewpass" />
</div>
<div class="mb-3">
<label for="txtcpass" class="form-label">Confirm
Password</label>
<input type="password" class="form-control" name="txtcpass"
id="txtcpass" />
</div>
<button type="submit" name="btnupdate" class="col-12 btn btnsuccess
btn-lg mx-auto">
Change Password
</button>
<p></p>
<button type="submit" name="btncancel" class="col-12 btn btnsuccess
btn-lg mx-auto mb-5">
Cancel
</button>
</form>
</div>
</div>
</div>
</section>
<!-- End Section -->
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