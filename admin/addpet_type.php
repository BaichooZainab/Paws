<?php

require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();

if (isset($_POST['btncancel'])) {
//redirect to dashboard page
header('Location: dashboard.php');
return;
}

if (isset($_POST['txtspecies'])) {

    $msg = validateSpeciesName();
    if (is_string($msg)) {
    //create a session variable “error” to store the error messages
    $_SESSION['errormsg'] = "$msg";
    //reload the page
    header("Location: addpet_type.php");
    return;
    }

//add the insert statement (tblstandtype)
$sql = "Insert into tblpet_type (species_name, species_pic) VALUES (:sn, :sp)";

$filename = $_FILES['pic']['name'];
$stmt = $pdo->prepare($sql);
//add the parameters for each form field
$stmt->execute(
    array(
        ':sn' => $_POST['txtspecies'],
        ':sp' => $filename,

        )
        );

        move_uploaded_file($_FILES["pic"]["tmp_name"], "../upload/" . 
        $filename);
        //create a session variable “successmsg” to store "Stand added";
        $_SESSION['successmsg'] = 'New Pet type added';

        //reload the current page
        header('Location: addpet_type.php');

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
<title>Pet Types</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/login.css" type="text/css">

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

<!--Icon -->
<link rel="icon" href="../assets/images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 

<script src="https://kit.fontawesome.com/8181027d18.js"crossorigin="anonymous"></script>

</head>
<body>

<?php include_once('../assets/includes/hadmin.php');?>

<!-- /Header -->


<section class="gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">


            <h3> <?php flashMessages(); ?></h3>

            <form id="frmaddpet" class="row" method="post"enctype="multipart/form-data">

              <h2 class="fw-bold mb-2 text-uppercase">Add Pet Type</h2>
             
              <div class="form-outline form-white mb-4">
              <label for="txtspecies" class="form-label">Species Name</label>
            <input type="text" class="form-control" name="txtspecies" id="txtspecies" />
              </div>

              <div class="form-outline form-white mb-4">
              <label for="pic" class="form-label">Pet type Image</label>
                <input class="form-control form-control-lg" id="pic" name="pic" type="file" />
              </div>

              <button class="col-12 btn btn-outline-light btn-lg mx-auto" name="btnaddtype" type="submit">Add Pet Type</button>

              <p></p>
            <button type="submit" name="btncancel" class="col-12 btn btn-primary btn-lg mx-auto"> Cancel</button>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    


<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>