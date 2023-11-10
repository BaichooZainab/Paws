

<?php session_start();
require_once "./db/pdo.php";
require_once "./db/util.php";

//check if the session does not exist
checkUserAuth();

if (isset($_POST['btncancel'])) {
header('Location: updateaprofile.php');
return;
}
//add sql to search for user details based on the session id
$stmt = $pdo->prepare("SELECT * from tbladopter where a_id=:aid");
$stmt->execute(array(":aid" => $_SESSION["aid"]));
$srow = $stmt->fetch(PDO::FETCH_ASSOC);

$pic = htmlentities($srow['a_profile']);

//update profile information

if (isset($_POST['btnupdate'])) {
  if (is_string($msg) || is_string($msg2)) {
  $_SESSION['errormsg'] = "$msg <br/> $msg2";
  header("Location: areg.php");
  return;
  }
  //add sql to check if the chosen email address is not taken up by OTHER
  //USERS
  $stmt2 = $pdo->prepare("SELECT * FROM tbladopter
  where a_email = :em and a_id != :aid");
  $stmt2->execute(
  array(
  ":em" => $_POST['txtemail'],
  ':aid' => $_SESSION['aid']
  )
  );
  
  $srow2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  if ($srow2 === false) {
  //add the sql statement to update the client profile
  $sql = "UPDATE tbladopter set a_fname = :fn, a_lname =:ln, a_email=:email, a_address=:add, a_number=:num, a_profile =:filen where a_id =:aid";
  $filename = $_FILES['a_profile']['name'];
  $stmt3 = $pdo->prepare($sql);
  $stmt3->execute(
  array(
    ':fn' => $_POST['txtafname'],
    ':ln' => $_POST['txtalname'],
    ':email' => $_POST['txtemail'],
    ':add' => $_POST['txtaadd'],
    ':num' => $_POST['txtanum'],
    ':filen' => $filename,
    ':aid' => $_SESSION['aid']
  )
  );
  move_uploaded_file($_FILES["a_profile"]["tmp_name"], "../upload/" .
  $filename);
  $_SESSION['successmsg'] = "Profile Updated";
  header("Location: updateaprofile.php");
  return;
 
  } else {
  $_SESSION['errormsg'] = "Email already exists!";
  }
  }

//end of update profile



?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>update adopter profile</title>
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
              <label for="txtafname" class="form-label">First name</label>
              <input type="text" class="form-control" name="txtafname" id="txtafname"
                    value="<?= $srow['a_fname'] ?>" />
            </div>


            <div class="mb-3">
            <label for="txtalname" class="form-label">Last name</label>
              <input type="text" class="form-control" name="txtalname" id="txtalname"
                    value="<?= $srow['a_lname'] ?>" />
            </div>

            <div class="mb-3">

            <label for="txtemail" class="form-label">E-mail</label>
              <input type="text" class="form-control" name="txtemail" id="txtemail"
                    value="<?= $srow['a_email'] ?>" />
            </div>

            <div class="mb-3">

            <label for="txtanum" class="form-label">Mobile Number</label>
              <input type="text" class="form-control" name="txtanum" id="txtanum"
                    value="<?= $srow['a_number'] ?>" />
            </div>

            <div class="mb-3">
            <label for="txtaadd" class="form-label">Address</label>
              <input type="text" class="form-control" name="txtaadd" id="txtaadd"
                    value="<?= $srow['a_address'] ?>" />
            </div>

            <div class="mb-3">
            <label for="a_profile" class="form-label">Profile
                                    Picture</label>
                                <input class="form-control form-control-lg" id="a_profile" onchange="readURL(this);"
                                    name="a_profile" type="file" />
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