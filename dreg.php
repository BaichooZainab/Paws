<?php
require_once "./db/pdo.php";
require_once "./db/util.php";
require_once "./db/email.d.php";
session_start();

$fn = $_POST["txtdfname"] ?? '';
$ln = $_POST["txtdlname"] ?? '';
$em = $_POST["txtdemail"] ?? '';
$user = $_POST["txtduname"] ?? '';
$add = $_POST["txtdadd"] ?? '';
$num = $_POST["txtdnum"] ?? '';
$pass = $_POST["txtdpass"] ?? '';



if (isset($_POST['btncancel'])) {
  header('Location: dreg.php');
  return;
  }

if (isset($_POST['btnregister'])) {
  $msg = validateFirstName();
  $msg2 = validateEmptyField($_POST["txtdlname"], "Last name");
  $msg3 = validateEmptyField($_POST["txtdadd"], "Address");
  $msg4 = validateEmptyField($_POST["txtduname"], "Username");
  $msg5 = validateEmptyField($_POST["txtdemail"], "Email Address");
  $msg6 = validateEmptyField($_POST["txtdpass"], "Password");
  $msg7 = validateNumericField($_POST["txtdnum"], "Mobile Number");
  $msg8 = validateFileProfilePic();

  if (is_string($msg) || is_string($msg2) || is_string($msg3) || is_string($msg4) || is_string($msg5) || is_string($msg6) || is_string($msg7) || is_string($msg8)) {
    $_SESSION['errormsg'] = $msg . " " . $msg2 . " " . $msg3. " " . $msg4 . " " . $msg5. " " . $msg6. " " .$msg7. " " .$msg8;
  header("Location: dreg.php");
  return;
  }

  //Check if email address already exists in database
//add sql to search table client by email
$stmt = $pdo->prepare("select * from tbldonator where d_email=:demail");
//retrieve txtemail value
$stmt->execute(array(":demail" => $_POST['txtdemail'] ));
$srow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($srow === false) {
//later we will insert the record

$check = ($_POST['txtdpass']);

//add the insert statement
$sql = "INSERT INTO tbldonator (d_fname, d_lname, d_email, d_address, d_number, d_username, d_pass, d_profile, location_id) 
VALUES (:dfname, :dlname, :demail, :dadd, :dnum, :duser, :dpass, :filen, :loc)";

$filename = $_FILES['d_profile']['name'];
$stmt = $pdo->prepare($sql);
//add codes to retrieve the form values
$stmt->execute(
array(
':dfname' => $_POST['txtdfname'],
':dlname' => $_POST['txtdlname'],
':demail' => $_POST['txtdemail'],
':dadd' => $_POST['txtdadd'],
':dnum' => $_POST['txtdnum'],
':duser' => $_POST['txtduname'],
':dpass' => $check,
':filen' => $filename,
':loc' => $_POST['ddlloc']
)
);

move_uploaded_file($_FILES["d_profile"]["tmp_name"], "./upload/" .
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
<title>Donator Registration Page</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="" type="text/css">

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
<section class="text-center m-5">
  <!-- Background image -->
  <div class="p-5 bg-image" style="background-image: url('assets/images/dog.jpg'); height: 400px;"></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8); backdrop-filter: blur(30px);">
    <div class="card-body py-5 px-md-5" style="background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Sign up now as Donator</h2>

          <h3>
            <?php flashMessages(); ?>
          </h3>

     <form class="row" id="frmsignup" method="post" action="dreg.php" enctype="multipart/form-data">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="txtdfname" placeholder="First name" name="txtdfname" value="<?=$fn?>" required="required" class="form-control" />
                  <label class="form-label" for="txtdfname"></label>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="txtdlname" placeholder="Last name" name="txtdlname" value="<?=$ln?>"  required="required" class="form-control" />
                  <label class="form-label" for="txtdlname"></label>
                </div>
              </div>
            </div>

            <div class="form-outline">
                  <input type="text" id="txtdadd" placeholder="Address" name="txtdadd" value="<?=$add?>"  required="required" class="form-control" />
                  <label class="form-label" for="txtdadd"></label>
                </div>
              </div>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="txtdemail" placeholder="Email Address" name="txtdemail" value="<?=$em?>"  required="required" class="form-control" />
              <label class="form-label" for="txtdemail"></label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" class="form-control" id="txtdnum" name="txtdnum" value="<?=$num?>"  placeholder="Mobile Number" maxlength="8" required="required">
                <label class="form-label" for="txtdnum"></label>
            </div>

            <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="txtduname" placeholder="Username" required="required" value="<?=$user?>"  name="txtduname"class="form-control" />
                  <label class="form-label" for="txtduname"></label>
                </div>
            </div>
            

            <!-- Password input -->
           
              <div class="col-md-6 mb-4">
            <div class="form-outline">
              <input type="password" id="txtdpass" placeholder="Password" value="<?=$pass?>"  required="required" name="txtdpass" class="form-control" />
              <label class="form-label" for="txtdpass"></label>
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

            <!-- Profile input -->
            <div class="form-outline mb-4">
                <label for="d_profile" style="color:white;" class="form-label">Choose a profile Picture</label>
                <input class="form-control" name="d_profile" type="file" id="d_profile" onchange="preview()">
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
                document.getElementById('d_profile').value = null;
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