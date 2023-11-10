<?php

require_once "../db/pdo.php";
require "../db/util.php";
session_start();

//check to see if the session exists
 if (isset($_SESSION['admin_id'])) {
  header("Location: dashboard.php");
  exit();
  }

  if (isset($_POST['btncancel'])) {
    header('Location: ../index.php');
    return;
    }
if (isset($_POST['btnlog']) && isset($_POST["txtadname"]) &&
isset($_POST["txtadpass"])) {
// delete any previously defined session variable
unset($_SESSION["admin_name"]);

$msg = validateAdminName();
$msg2 = validateAdminPass();

if (is_string($msg) || is_string($msg2)) {
$_SESSION['errormsg'] = "$msg <br/> $msg2";
header('Location: loginadmin.php');
exit();
  } else {
//encrypt password
$check = ($_POST['txtadpass']);
//add a where clause to check whether there is a matching name and password
$stmt = $pdo->prepare('SELECT admin_id, admin_name FROM paws_admin where admin_name = :adname and admin_pass = :adpw');

$stmt->execute(array(':adname' => $_POST['txtadname'], ':adpw' => $check));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row !== false) {
$_SESSION["successmsg"] = "Logged in.";
//create two more session variables dn and did
 $_SESSION["admin_name"] = $row["admin_name"];
 $_SESSION["admin_id"] = $row["admin_id"];

//to store the first name and donator id

//redirect admin to dashboard

header("Location: dashboard.php");

exit();


} else {  

$_SESSION["errormsg"] = "Incorrect credentials, please try again!";

header('Location: loginadmin.php');

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
<title>Admin Login</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/admin.css" type="text/css">

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



<div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                
                <div class="col-lg-12 login-title">
                    ADMIN PANEL LOGIN
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                    
        <?php
        flashMessages();
        ?>
        </h3>
           
                        <form id="frmlogin" method="post" onsubmit="return remem()" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="txtadname" class="form-control-label">USERNAME</label>
                                <input type="text" name="txtadname" id="txtadname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="txtadpass" class="form-control-label">PASSWORD</label>
                                <input type="password" name="txtadpass" id="txtadpass" class="form-control" i>
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="chkrem">
                                <label class="form-check-label" for="chkrem">
                                Remember Me
                                </label>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" name="btnlog" class="btn btn-outline-primary">LOGIN</button>
                                </div>

                                 <div class="row mb-3 px-3">
                        <button type="submit" name="btncancel" class="btn btn-outline-primary">CANCEL</button>
                    </div>



                              


                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>




 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>
