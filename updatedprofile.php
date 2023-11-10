

<?php session_start();
require_once "./db/pdo.php";
require_once "./db/util.php";

//check if the session does not exist
checkUserAuth();

if (isset($_POST['btncancel'])) {
header('Location: view_posted_notice.php');
return;
}
//add sql to search for user details based on the session id
$stmt = $pdo->prepare("SELECT * from tbldonator where d_id=:did");
$stmt->execute(array(":did" => $_SESSION["did"]));
$srow = $stmt->fetch(PDO::FETCH_ASSOC);

$pic = htmlentities($srow['d_profile']);

//update profile information

if (isset($_POST['btnupdate'])) {
  if (is_string($msg) || is_string($msg2)) {
  $_SESSION['errormsg'] = "$msg <br/> $msg2";
  header("Location: dreg.php");
  return;
  }
  //add sql to check if the chosen email address is not taken up by OTHER
  //USERS
  $stmt2 = $pdo->prepare("SELECT * FROM tbldonator
  where d_email = :em and d_id != :did");
  $stmt2->execute(
  array(
  ":em" => $_POST['txtdemail'],
  ':did' => $_SESSION['did']
  )
  );
  
  $srow2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  if ($srow2 === false) {
  //add the sql statement to update the client profile
  $sql = "UPDATE tbldonator set d_fname = :fn, d_lname =:ln, d_email=:email, d_address=:add, d_number=:num, d_profile =:filen where d_id =:did";
  $filename = $_FILES['d_profile']['name'];
  $stmt3 = $pdo->prepare($sql);
  $stmt3->execute(
  array(
    ':fn' => $_POST['txtdfname'],
    ':ln' => $_POST['txtdlname'],
    ':email' => $_POST['txtdemail'],
    ':add' => $_POST['txtdadd'],
    ':num' => $_POST['txtdnum'],
    ':filen' => $filename,
    ':did' => $_SESSION['did']
  )
  );
  move_uploaded_file($_FILES["d_profile"]["tmp_name"], "./upload/" .
  $filename);
  $_SESSION['successmsg'] = "Profile Updated";
  header("Location: updatedprofile.php");
  return;
 
  } else {
  $_SESSION['errormsg'] = "Email already exists!";
  }
  }

//end of update profile

if (isset($_SESSION['errormsg'])) {
  echo '<p>Error: ' . $_SESSION['errormsg'] . '</p>';
  unset($_SESSION['errormsg']);
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
<title>update donator profile</title>
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

<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-white mt-5">Update Your Profile</h2>
       
        <div class="card my-5">
        <h3><?php flashMessages(); ?></h3>
          <form class="card-body cardbody-color p-lg-5" id="frmadd"  method="post"
enctype="multipart/form-data">

            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>

            <div class="mb-3">
              <label for="txtdfname" class="form-label">First name</label>
              <input type="text" class="form-control" name="txtdfname" id="txtdfname"
                    value="<?= $srow['d_fname'] ?>" />
            </div>


            <div class="mb-3">
            <label for="txtdlname" class="form-label">Last name</label>
              <input type="text" class="form-control" name="txtdlname" id="txtdlname"
                    value="<?= $srow['d_lname'] ?>" />
            </div>

            <div class="mb-3">

            <label for="txtdemail" class="form-label">E-mail</label>
              <input type="text" class="form-control" name="txtdemail" id="txtdemail"
                    value="<?= $srow['d_email'] ?>" />
            </div>

            <div class="mb-3">

            <label for="txtdnum" class="form-label">Mobile Number</label>
              <input type="text" class="form-control" name="txtdnum" id="txtdnum"
                    value="<?= $srow['d_number'] ?>" />
            </div>

            <div class="mb-3">
            <label for="txtdadd" class="form-label">Address</label>
              <input type="text" class="form-control" name="txtdadd" id="txtdadd"
                    value="<?= $srow['d_address'] ?>" />
            </div>

            <div class="mb-3">
            <label for="d_profile" class="form-label">Profile
                                    Picture</label>
                                <input class="form-control form-control-lg" id="d_profile" onchange="readURL(this);"
                                    name="d_profile" type="file" />
                                <?php
                                  echo '<p><img id="blah" class="zz_image" src="upload/' . $pic . '"
                                  width="100px" /></p>';
                                  ?>
            </div>

            <div class="text-center"><button type="submit" name="btnupdate" class="btn btn-color px-5 mb-5 w-100">Update</button></div>
            <div class="text-center"><button type="submit" name="btncancel" class="btn btn-color px-5 mb-5 w-100">Cancel</button></div>


            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 

<script type="text/javascript">
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function(e) {
$('#blah').attr('src', e.target.result);
}
reader.readAsDataURL(input.files[0]);
}
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>