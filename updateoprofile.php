

<?php session_start();
require_once "./db/pdo.php";
require_once "./db/util.php";

//check if the session does not exist
checkUserAuth();

if (isset($_POST['btncancel'])) {
header('Location: index.php');
return;
}
//add sql to search for user details based on the session id
$stmt = $pdo->prepare("SELECT * from tblorganisation where org_id=:oid");
$stmt->execute(array(":oid" => $_SESSION["oid"]));
$srow = $stmt->fetch(PDO::FETCH_ASSOC);

$pic = htmlentities($srow['org_profile']);

//update profile information

if (isset($_POST['btnupdate'])) {
  if (is_string($msg) || is_string($msg2)) {
  $_SESSION['errormsg'] = "$msg <br/> $msg2";
  header("Location: orgreg.php");
  return;
  }
  //add sql to check if the chosen email address is not taken up by OTHER
  //USERS
  $stmt2 = $pdo->prepare("SELECT * FROM tblorganisation
  where org_email = :em and org_id != :oid");
  $stmt2->execute(
  array(
  ":em" => $_POST['txtemail'],
  ':oid' => $_SESSION['oid']
  )
  );
  
  $srow2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  if ($srow2 === false) {
  //add the sql statement to update the client profile
  $sql = "UPDATE tblorganisation set org_name = :on, org_email=:email, org_number=:num, org_profile =:filen where org_id =:oid";
  $filename = $_FILES['org_profile']['name'];
  $stmt3 = $pdo->prepare($sql);
  $stmt3->execute(
  array(
    ':on' => $_POST['txtoname'],
    ':email' => $_POST['txtemail'],
    ':num' => $_POST['txtonum'],
    ':filen' => $filename,
    ':oid' => $_SESSION['oid']
  )
  );
  move_uploaded_file($_FILES["org_profile"]["tmp_name"], "../upload/" .
  $filename);
  $_SESSION['successmsg'] = "Profile Updated";
  header("Location: updateoprofile.php");
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
<title>update Organisation profile</title>
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
              <label for="txtoname" class="form-label">First name</label>
              <input type="text" class="form-control" name="txtoname" id="txtoname"
                    value="<?= $srow['org_name'] ?>" />
            </div>


            <div class="mb-3">

            <label for="txtemail" class="form-label">E-mail</label>
              <input type="text" class="form-control" name="txtemail" id="txtemail"
                    value="<?= $srow['org_email'] ?>" />
            </div>

            <div class="mb-3">

            <label for="txtonum" class="form-label">Mobile Number</label>
              <input type="text" class="form-control" name="txtonum" id="txtonum"
                    value="<?= $srow['org_number'] ?>" />
            </div>


            <div class="mb-3">
            <label for="org_profile" class="form-label">Profile
                                    Picture</label>
                                <input class="form-control form-control-lg" id="org_profile" onchange="readURL(this);"
                                    name="org_profile" type="file" />
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