<?php
require_once "./db/pdo.php";
require_once "./db/util.php";
session_start();

  if(isset($_SESSION['oid'])) {
    header("Location: updateoprofile.php");
    }
  
  if (isset($_POST['btncancel'])) {
  header('Location: orglogin.php');
  return;
  }
  if (isset($_POST['btnlogin']) && isset($_POST["txtoemail"]) &&
  isset($_POST["txtopass"])) {
  // delete any previously defined session variable
 
  unset($_SESSION["org_email"]);
  $msg = validateOEmail();
  $msg2 = validateOP();
  
  if (is_string($msg) || is_string($msg2)) {
  $_SESSION['errormsg'] = "$msg <br/> $msg2";
  header('Location: orglogin.php');
  return;
  } else {
  //encrypt password
  $check = hash('md5', $_POST['txtopass']);
  //add a where clause to check whether there is a matching email and password


  $stmt = $pdo->prepare('SELECT org_id, org_name FROM tblorganisation where org_email = :em and org_pass = :pw and status=1');

  $stmt->execute(array(':em' => $_POST['txtoemail'], ':pw' => $check));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($row !== false) {
  $_SESSION["successmsg"] = "Logged in.";
  //create two more session variables dn and did


  $_SESSION["on"] = $row["org_name"];
  $_SESSION["oid"] = $row["org_id"];
  //to store the first name and donator id
  
  //redirect user to updateprofile

  
  header("Location: updateoprofile.php");

  //send error messages to apache log file
  error_log("Login successful for " . $_POST['txtoemail']);
  return;
  
  } else {
  $_SESSION["errormsg"] = "Incorrect credentials or your account has been suspended, please try again!";
  
  header('Location: orglogin.php');
  
  //send error messages to apache log file
  error_log("Login failed " . $_POST['txtoemail'] . " $check");
  return;
  }
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
<title>Login Page</title>
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

<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">

                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                        <img src="assets/images/office.jpg" class="image">
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3">
                        <h6 class="mb-0 mr-4 mt-2">Sign in As an Organisation</h6>

                    </div>

                    <h3><?php flashMessages(); ?> </h3>
                    <form id="frmlogin" onsubmit="return remem()" method="post" enctype="multipart/form-data" action="orglogin.php">
                    <div class="row px-3">
                        <label for="txtoemail" class="mb-1"><h6 class="mb-0 text-sm"></h6></label>
                        <input class="mb-4" type="text" name="txtoemail" id="txtoemail" placeholder="Enter a valid email address">
                    </div>

                    <div class="row px-3">
                        <label for="txtopass" class="mb-1"><h6 class="mb-0 text-sm"></h6></label>
                        <input type="password" name="txtopass" id="txtopass" placeholder="Enter password">
                    </div>


                    <div class="row px-3 mb-4">
                        <div class="form-check">
                            <input id="chkrem" type="checkbox" name="chkrem" class="form-check-input"> 
                            <label for="chkrem" class="form-check-label text-sm">Remember me</label>
                        </div>
                    </div>

             

                    <div class="row mb-3 px-3">
                        <button type="submit" name="btnlogin" class="btn btn-blue text-center">Login</button>
                    </div>

                    <div class="row mb-3 px-3">
                        <button type="submit" name="btncancel" class="btn btn-blue text-center">Cancel</button>
                    </div>

                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold">Don't have an account? <a href="orgreg.php" class="text-danger ">Register</a></small>
                    </div>

                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold">Forgot Password ?<a href="forgetpassword.php" class="text-danger ">Click Here</a></small>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>






<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script type="text/javascript" src="js/mylib.js"></script>
</body>
</html>