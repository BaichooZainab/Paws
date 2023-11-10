<?php
require_once "./db/pdo.php";
require_once "./db/util.php";
require_once "./db/emailconfig.php";
session_start();

$fn = $_POST["txtafname"] ?? '';
$ln = $_POST["txtalname"] ?? '';
$em = $_POST["txtemail"] ?? '';
$user = $_POST["txtauname"] ?? '';
$add = $_POST["txtaadd"] ?? '';
$num = $_POST["txtanum"] ?? '';
$pass = $_POST["txtpass"] ?? '';



if (isset($_POST['btncancel'])) {
  header('Location: dreg.php');
  return;
  }

if (isset($_POST['btnregister'])) {
  $msg = validatefname();
  $msg2 = validateEmptyField($_POST["txtalname"], "Last name");
  $msg3 = validateEmptyField($_POST["txtaadd"], "Address");
  $msg4 = validateEmptyField($_POST["txtauname"], "Username");
  $msg5 = validateEmptyField($_POST["txtemail"], "Email Address");
  $msg6 = validateEmptyField($_POST["txtpass"], "Password");
  $msg7 = validateNumericField($_POST["txtanum"], "Mobile Number");
  $msg8 = validateFileProfile();

  if (is_string($msg) || is_string($msg2) || is_string($msg3) || is_string($msg4) || is_string($msg5) || is_string($msg6) || is_string($msg7) || is_string($msg8)) {
    $_SESSION['errormsg'] = $msg . " " . $msg2 . " " . $msg3. " " . $msg4 . " " . $msg5. " " . $msg6. " " .$msg7. " " .$msg8;
  header("Location: dreg.php");
  return;
  }

  //Check if email address already exists in database
//add sql to search table client by email
$stmt = $pdo->prepare("select * from tbladopter where a_email=:aemail");
//retrieve txtemail value
$stmt->execute(array(":aemail" => $_POST['txtemail'] ));
$srow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($srow === false) {
//later we will insert the record

$check = hash('md5' , $_POST['txtpass']);

//add the insert statement
$sql = "INSERT INTO tbladopter (a_fname, a_lname, a_email, a_address, a_number, a_username, a_pass, a_profile, location_id) 
VALUES (:afname, :alname, :aemail, :aadd, :anum, :auser, :apass, :filen, :loc)";

$filename = $_FILES['a_profile']['name'];
$stmt = $pdo->prepare($sql);
//add codes to retrieve the form values
$stmt->execute(
array(
':afname' => $_POST['txtafname'],
':alname' => $_POST['txtalname'],
':aemail' => $_POST['txtemail'],
':aadd' => $_POST['txtaadd'],
':anum' => $_POST['txtanum'],
':auser' => $_POST['txtauname'],
':apass' => $check,
':filen' => $filename,
':loc' => $_POST['ddlloc']
)
);

move_uploaded_file($_FILES["a_profile"]["tmp_name"], "upload/" .
$filename);

sendEmail();

$_SESSION["successmsg"] = "Registered successfully";

header("refresh:3; url=login.php");

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
<title>Adopter Registration Page</title>
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

<section class="vh-50" style="background: linear-gradient(0deg, rgba(199,152,52,1) 0%, rgba(112,141,142,1) 100%);">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-1 card-registration" style="border-radius: 15px; background: linear-gradient(0deg, rgba(199,152,52,1) 0%, rgba(112,141,142,1) 100%);">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Adopter Registration Form</h3>
            
            <h3>
              <?php flashMessages(); ?>
            </h3>

            <form  id="frmsignup" method="post" action="areg.php" enctype="multipart/form-data">
          

            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="txtafname" placeholder="First name" name="txtafname" value="<?=$fn?>" required="required" class="form-control" />
                  <label class="form-label" for="txtafname"></label>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="txtalname" placeholder="Last name" name="txtalname" value="<?=$ln?>" required="required" class="form-control" />
                  <label class="form-label" for="txtalname"></label>
                </div>
              </div>
            </div>

              <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="txtauname" placeholder="Username" name="txtauname" value="<?=$user?>" required="required" class="form-control" />
                  <label class="form-label" for="txtauname"></label>
                </div>
            </div>
            

            <!-- Password input -->
           
              <div class="col-md-6 mb-4">
            <div class="form-outline">
              <input type="password" id="txtpass" placeholder="Password" name="txtpass" value="<?=$pass?>" required="required" class="form-control" />
              <label class="form-label" for="txtpass"></label>
            </div>
            </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="txtcpass" name="txtcpass"
                                                    class="form-control" placeholder="Repeat your password" />
                                                <label class="form-label" for="txtcpass"></label>
                                            </div>
                                        </div>

            <div class="form-outline">
                  <input type="text" id="txtaadd" placeholder="Address" name="txtaadd" value="<?=$add?>"  required="required" class="form-control" />
                  <label class="form-label" for="txtaadd"></label>
                </div>

               <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="txtemail" placeholder="Email Address" name="txtemail" value="<?=$em?>" required="required" class="form-control" />
              <label class="form-label" for="txtemail"></label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" class="form-control" id="txtanum" name="txtanum" value="<?=$num?>" placeholder="Mobile Number" maxlength="8" required="required">
                <label class="form-label" for="txtanum"></label>
            </div>

             <!-- Profile input -->
             <div class="form-outline mb-4">
             <label for="a_profile" style="color:white;" class="form-label">Choose a profile Picture</label>
                <input class="form-control" name="a_profile" type="file" id="a_profile" onchange="preview()">
                <button onclick="clearImage()" class="btn btn-primary mt-3">Clear</button>
            </div>

            <div class="row">
                <div class="col-12">

                <select name="ddlloc" id="ddlloc" class="form-select" aria-label="Select Location">
                    <?php
                      //add sql to search tbllocation and display location in ascending order
                      $sql1 = $pdo->query("select * from tbllocation ");
                      foreach ($sql1 as $row) {
                      //assign the id and name attribute to the option tag
                      echo "<option value='" . $row['location_id'] . "'>" . $row['location_name'] .
                      "</option>";
                    }
                    ?>
                </select>

                </div>
              </div>

<br>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-center mb-4">
              <input class="form-check-input me-2" type="checkbox" value="" name="dchk" id="dchck" checked />
              <label class="form-check-label" for="dchck">
                Status
              </label>
            </div>

            <!-- Submit button -->
            <button  type="submit" name="btnregister" class="col-6 btn btn-primary btn-lg mx-auto">
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
</section>


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
                document.getElementById('profilepic').value = null;
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