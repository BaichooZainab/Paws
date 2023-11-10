<?php
require_once "./db/pdo.php";
require_once "./db/util.php";
session_start();

  if(isset($_SESSION['aid'])) {
    header("Location: updateaprofile.php");
    }
  
  if (isset($_POST['btncancel'])) {
  header('Location: index.php');
  return;
  }
  if (isset($_POST['btnlogin']) && isset($_POST["txtemail"]) &&
  isset($_POST["txtpass"])) {
  // delete any previously defined session variable
 
  unset($_SESSION["a_email"]);
  $msg = validateEmail();
  $msg2 = validatePass();
  
  if (is_string($msg) || is_string($msg2)) {
  $_SESSION['errormsg'] = "$msg <br/> $msg2";
  header('Location: login.php');
  return;
  } else {
  //encrypt password
  $check = hash('md5', $_POST['txtpass']);
  //add a where clause to check whether there is a matching email and password


  $stmt = $pdo->prepare('SELECT a_id, a_fname FROM tbladopter where a_email = :em and a_pass = :pw and a_status=1');

  $stmt->execute(array(':em' => $_POST['txtemail'], ':pw' => $check));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($row !== false) {
  $_SESSION["successmsg"] = "Logged in.";
  //create two more session variables dn and did


  $_SESSION["an"] = $row["a_fname"];
  $_SESSION["aid"] = $row["a_id"];
  //to store the first name and donator id
  
  //redirect user to updateprofile

  
  header("Location: updateaprofile.php");

  //send error messages to apache log file
  error_log("Login successful for " . $_POST['txtemail']);
  return;
  
  } else {
  $_SESSION["errormsg"] = "Incorrect credentials or your account has been suspended, please try again!";
  
  header('Location: login.php');
  
  //send error messages to apache log file
  error_log("Login failed " . $_POST['txtemail'] . " $check");
  return;
  }
  }
  }

//check to see if the session exists
 if (isset($_SESSION['did'])) {
  header("Location: updatedprofile.php");
  }


if (isset($_POST['btncancel'])) {
header('Location: index.php');
return;
}
if (isset($_POST['btnlogin']) && isset($_POST["txtdemail"]) &&
isset($_POST["txtdpass"])) {
// delete any previously defined session variable
unset($_SESSION["d_email"]);

$msg = validatemail();
$msg2 = validatep();

if (is_string($msg) || is_string($msg2)) {
$_SESSION['errormsg'] = "$msg <br/> $msg2";
header('Location: login.php');
return;
} else {
//encrypt password
$check = ($_POST['txtdpass']);
//add a where clause to check whether there is a matching email and password
$stmt = $pdo->prepare('SELECT d_id, d_fname FROM tbldonator where d_email = :em and d_pass = :pw and d_status=1');

$stmt->execute(array(':em' => $_POST['txtdemail'], ':pw' => $check));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row !== false) {
$_SESSION["successmsg"] = "Logged in.";
//create two more session variables dn and did
 $_SESSION["dn"] = $row["d_fname"];
 $_SESSION["did"] = $row["d_id"];

//to store the first name and donator id

//redirect user to updateprofile

header("Location: updatedprofile.php");

//send error messages to apache log file
error_log("Login successful for " . $_POST['txtdemail']);
return;

} else {
$_SESSION["errormsg"] = "Incorrect credentials or your account has been suspended, please try again!";

header('Location: login.php');

//send error messages to apache log file
error_log("Login failed " . $_POST['txtemail'] . " $check");
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



	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Adopter Log In </span><span>Donator Log In</span></h6>
			          	<input class="check" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h5 class="mb-2 mt-2 pb-3">Log In to welcome a Pet in your home.</h5>
                      <h3><?php flashMessages(); ?> </h3>
                      <form id="frmlogin" onsubmit="return remem()" method="post" enctype="multipart/form-data" action="login.php">
											<div class="form-group">
												<input type="email" name="txtemail" class="form-style" placeholder="Your Email" required="required" id="logemail" autocomplete="off">
                        <label class="form-label" for="txtemail"></label>
												<i class=""></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" name="txtpass" class="form-style" placeholder="Your Password" required="required" id="logpass" autocomplete="off">
                        <label class="form-label" for="txtpass"></label>
												<i class=""></i>
											</div>

                      <div class="form-check mt-3">
                      <input class="form-check-input" type="checkbox" value="" id="chkrem">
                      <label class="form-check-label" for="chkrem">
                      Remember Me
                      </label>
                      </div>

											<button name="btnlogin" type="submit" class="btn mt-4">Log In</button>

                      <button name="btncancel" type="submit" class="btn mt-4">Cancel</button>
                            				
                      <div class="form-group d-flex justify-content-center mb-4">
                      <p class="mb-0" style="color:white;">Don't have an account? <a href="areg.php" class="text-50 fw-bold"> Register Now!</a></p>
                      </div>
				      					</div>
			      					</div>
</form>
			      				</div>


								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h5 class="mb-2 mt-2 pb-3">Log In to Donate your Pet to PAWS</h5>
                      <h3><?php flashMessages(); ?> </h3>
                      <form id="frmlog" onsubmit="return remem()" method="post" enctype="multipart/form-data" action="login.php">
                      <div class="form-group">
												<input type="email" name="txtdemail" class="form-style" placeholder="Your Email" required="required" id="logemail" autocomplete="off">
                        <label class="form-label" for="txtdemail"></label>
												<i class=""></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" name="txtdpass" class="form-style" placeholder="Your Password" required="required" id="logpass" autocomplete="off">
                        <label class="form-label" for="txtdpass"></label>
												<i class=""></i>
											</div>

                      
                        <div class="form-check mt-3">
                      <input class="form-check-input" type="checkbox" value="" id="chkrem">
                      <label class="form-check-label" for="chkrem">
                      Remember Me
                      </label>
                      </div>
                   

											<button name="btnlogin" type="submit" class="btn mt-4">Log In</button>

                      <button name="btncancel" type="submit" class="btn mt-4">Cancel</button>
                            				
                      <div class="form-group d-flex justify-content-center mb-4">
                      <p class="mb-0" style="color:white;">Don't have an account? <a href="dreg.php" class="text-50 fw-bold"> Register Now!</a></p>
                      </div>
				      					</div>
                      </form>
			      				</div>
			      			</div>
			      		</div>
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



</body>
</html>