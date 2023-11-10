<?php
require_once "./db/pdo.php";
require_once "./db/util.php";
require_once "./db/email.o.php";
session_start();

$gn = $_POST["txtoname"] ?? '';
$user = $_POST["txtouname"] ?? '';
$em = $_POST["txtemail"] ?? '';
$num = $_POST["txtonum"] ?? '';
$pass = $_POST["txtpass"] ?? '';

if (isset($_POST['btncancel'])) {
  header('Location: orgreg.php');
  return;
  }

if (isset($_POST['btnregister'])) {
  $msg1 = validateOrgName();

  $msg2 = validateEmptyField($_POST["txtouname"], "Username");
  $msg3 = validateEmptyField($_POST["txtemail"], "Email Address");
  $msg4 = validateEmptyField($_POST["txtpass"], "Password");
  $msg5 = validateNumericField($_POST["txtonum"], "Mobile Number");
  $msg6 = validateOrgPic();

  if (is_string($msg1) || is_string($msg2) || is_string($msg3) || is_string($msg4) || is_string($msg5) || is_string($msg6)) {
    $_SESSION['errormsg'] = $msg1 . " " . $msg2 . " " . $msg3. " " . $msg4 . " " . $msg5. " " . $msg6;
  header("Location: orgreg.php");
  return;
  }

//Check if email address already exists in database
//add sql to search table client by email
$stmt = $pdo->prepare("select * from tblorganisation where org_email=:email");
//retrieve txtemail value
$stmt->execute(array(":email" => $_POST['txtemail'] ));
$srow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($srow === false) {
//later we will insert the record

$check = hash('md5' , $_POST['txtpass']);

//add the insert statement
$sql = "INSERT INTO tblorganisation (org_name, org_email, org_number, org_username, org_pass, org_profile) 
VALUES (:oname, :oemail, :onum, :ouser, :opass, :filen)";

$filename = $_FILES['org_profile']['name'];
$stmt = $pdo->prepare($sql);
//add codes to retrieve the form values
$stmt->execute(
array(
':oname' => $_POST['txtoname'],
':oemail' => $_POST['txtemail'],
':onum' => $_POST['txtonum'],
':ouser' => $_POST['txtouname'],
':opass' => $check,
':filen' => $filename

)
);

move_uploaded_file($_FILES["org_profile"]["tmp_name"], "./upload/" .
$filename);

sendEmail();

$_SESSION["successmsg"] = "Registered successfully";

header("refresh:3; url=orglogin.php");

} else {
$_SESSION['errormsg'] = "Email already exists!";
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
<title>Organisation Registration Page</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">

<!--Icon -->
<link rel="icon" href="assets/images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 

<script src="https://kit.fontawesome.com/8181027d18.js"crossorigin="anonymous"></script>

</head>
<body>
        
<!--Header-->
<?php include_once('assets/includes/header.php');?>
<!-- /Header -->

<!-- Section: Design Block -->
<section class="text-center text-lg-start" style="background: linear-gradient(0deg, rgba(177,157,112,1) 0%, rgba(46,57,57,1) 100%);">
  <style>
    .cascading-right {
      margin-right: -50px;
    }

    @media (max-width: 991.98px) {
      .cascading-right {
        margin-right: 0;
      }
    }
  </style>

  <!-- Jumbotron -->
  <div class="container py-4" style="background: linear-gradient(0deg, rgba(224,215,196,1) 0%, rgba(0,0,0,1) 100%);">
    <div class="row justify-content-center align-items-center h-100">
    <div class="col-12 col-lg-9 col-xl-7">
        <div class="card" style="background: linear-gradient(0deg, rgba(224,215,196,1) 0%, rgba(0,0,0,1) 100%);">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5" style="color:white;">Sign up as an Organisation</h2>

            <h3>
            <?php
            // Flash pattern
            if (isset($error_message)) {
            echo '<p style="color:red">' . $error_message . '</p>';
            unset($error_message);
            }
            if (isset($success_message)) {
            echo '<p style="color:green">' . $success_message . '</p>';
            unset($success_message);

            }
            ?>
        </h3>

        <form class="row" id="frmsignup" method="post" action="orgreg.php" enctype="multipart/form-data">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="txtoname" name="txtoname" placeholder="Organisation Name" required="required" class="form-control" />
                    <label class="form-label" for="txtoname"></label>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="txtouname" name="txtouname"  placeholder="Username" required="required" class="form-control" />
                    <label class="form-label" for="txtouname"></label>
                  </div>
                </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" id="txtemail" name="txtemail" placeholder="Email Address" required="required" class="form-control" />
                <label class="form-label" for="txtemail"></label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" class="form-control" id="txtonum" name="txtonum" required="required" maxlength="8" placeholder="Mobile Number" >
                <label class="form-label" for="txtonum"></label>
            </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="txtpass" name="txtpass" placeholder="Password" required="required" class="form-control" />
                <label class="form-label" for="txtpass"></label>
              </div>

             
                                            <div class="form-outline mb-4">
                                                <input type="password" id="txtcpass" name="txtcpass"
                                                    class="form-control" placeholder="Repeat your password" />
                                                <label class="form-label" for="txtcpass"></label>
                                            </div>
                                       

              <div class="form-outline mb-4">
                <label for="org_profile" style="color:white;" class="form-label">Choose picture</label>
                <input class="form-control" name="org_profile" type="file" id="org_profile" onchange="preview()">
                <button onclick="clearImage()" class="btn btn-primary mt-3">Clear</button>
            </div>

              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-center mb-4">
              <input class="form-check-input me-2" type="checkbox" value="" name="chk" id="chck" checked />
              <label class="form-check-label" for="chck">
                Status
              </label>
            </div>


              <!-- Submit button -->
              <button name="btnregister" type="submit" class="btn btn-primary btn-block mb-4">
                Sign up
              </button>

              <p></p>
              <button type="submit" name="btncancel"
              class="col-6 btn btn-primary btn-lg mx-auto">
              Cancel
              </button>

            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->


<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script>
            function preview() {
                frame.src = URL.createObjectURL(event.target.files[0]);
            }
            function clearImage() {
                document.getElementById('org_profile').value = null;
                frame.src = "";
            }
    
    // Add animation to the messages
    const messageContainer = document.getElementById('message-container');
    const messages = messageContainer.getElementsByTagName('p');
    
    for (let i = 0; i < messages.length; i++) {
        const message = messages[i];
        message.classList.add('animated-message');
    }
</script>


</body>
</html>