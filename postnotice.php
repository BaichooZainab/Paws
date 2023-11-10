<?php

require_once "./db/pdo.php";
require_once "./db/util.php";

session_start();
//date_default_timezone_set

$d = new DateTime('now');
$d->setTimezone(new DateTimeZone('GMT+4'));
//$datetime = $d->format('Y-m-d H:i:s');
$date = $d->format('Y-m-d');

if (isset($_POST['btncancel'])) {
header('Location: postnotice.php');
return;
}
//Add a name to the button
if (isset($_POST['btnaddnotice'])) {
    $msg = validateNoticeName();
$msg2 = validateFileUpPic();
if (is_string($msg) || is_string($msg2)) {
$_SESSION['errormsg'] = $msg . " " . $msg2;
header("Location: postnotice.php");
return;
}
//add the insert statement
$sql = "INSERT INTO tblnotice (notice_name, notice_desc, picture, notice_date, d_id) 
VALUES (:nname, :ndesc, :npic, :ndate, :did)";
$filename = $_FILES['filepic']['name'];
$stmt = $pdo->prepare($sql);
//add codes to retrieve the form values
$stmt->execute(
array(
':nname' => $_POST['txtnoticename'],
':ndesc' => $_POST['txtnoticedesc'],
':npic' => $filename,
':ndate' => $date,
':did' => $_SESSION['did']


)
);
move_uploaded_file($_FILES["filepic"]["tmp_name"], "./upload/" .
$filename);
$_SESSION["successmsg"] = "Notice added successfully wait For confirmation";
header('Location: postnotice.php');
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
<title>Post a Notice</title>
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

<section class="gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">


            <h3> <?php flashMessages(); ?></h3>
<form id="frmadd" class="row" method="post"
enctype="multipart/form-data">

              <h2 class="fw-bold mb-2 text-uppercase">Post a Notice</h2>
              <p class="text-white-50 mb-5">Add a notice here!</p>

              <div class="form-outline form-white mb-4">
              <label for="txtnoticename" class="form-label">Notice Name</label>
            <input type="text" class="form-control" name="txtnoticename" id="txtnoticename" />
              </div>

              <div class="form-outline form-white mb-4">
              <label for="txtnoticedesc" class="form-label">Notice Description</label>
            <input type="text" class="form-control" name="txtnoticedesc" id="txtnoticedesc" />
              </div>

              <div class="form-outline form-white mb-4">
             
                <input class="form-control" id="txtndate" name="txtndate" value="<?=$date?>" type="hidden" /></div>

              <div class="form-outline form-white mb-4">
              <label for="filepic" class="form-label">Picture</label>
                <input class="form-control form-control-lg" id="filepic" name="filepic" type="file" />
              </div>

              <button class="col-12 btn btn-outline-light btn-lg mx-auto" name="btnaddnotice" type="submit">Post Notice</button>

              <p></p>
            <button type="submit" name="btncancel" class="col-12 btn btn-primary btn-lg mx-auto"> Cancel</button>

           

            </form>

          </div>
        </div>
      </div>
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