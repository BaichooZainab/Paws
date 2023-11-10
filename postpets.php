<?php

require_once "./db/pdo.php";
require_once "./db/util.php";
session_start();

$d = new DateTime('now');
$d->setTimezone(new DateTimeZone('GMT+4'));
//$datetime = $d->format('Y-m-d H:i:s');
$date = $d->format('Y-m-d');

// $stmt = $pdo->query("SELECT * FROM tblpet_type");
// $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['btncancel'])) {
//redirect to index page
header('Location: index.php');
return;
}

if (isset($_POST['btnadd'])) {

    $msg = validatePet();
    $msg2 = validateImage();
    if (is_string($msg) || is_string($msg2)) {
    //create a session variable “error” to store the error messages
    $_SESSION['errormsg'] = "$msg <br/> $msg2";
    //reload the page
    header("Location: postpets.php");
    return;
    }

//add the insert statement
$sql = "Insert into tblpet (pet_name, pet_age, pet_gender, pet_desc, arrival_date, pet_image, species_id, d_id) 
VALUES (:pn, :age, :gender, :desc, :pdate, :img, :sid, :did)";

$filename = $_FILES['pet_image']['name'];
$stmt = $pdo->prepare($sql);
//add the parameters for each form field
$stmt->execute(
    array(
        ':pn' => $_POST['txtpetname'],
        ':age' => $_POST['txtpetage'],
        ':gender' => $_POST['radgender'],
        ':desc' => $_POST['txtpetdesc'],
        ':pdate' => $date,
        ':img' => $filename,
     
        ':sid' => $_POST["txtpettype"],
        ':did' => $_SESSION['did']
        
        )
        );

        move_uploaded_file($_FILES["pet_image"]["tmp_name"], "./upload/" . 
        $filename);
        //create a session variable “successmsg” to store "Pet added";
        $_SESSION['successmsg'] = 'New Pet added';

        //reload the current page
        header('Location: postpets.php');

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
<title>Post Pets</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/pet.css" type="text/css">

<!--Icon -->
<link rel="icon" href="assets/images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 

<script src="https://kit.fontawesome.com/8181027d18.js"crossorigin="anonymous"></script>

</head>
<body>
        
<!--Header-->
<?php include_once('assets/includes/header.php');?>
<!-- /Header -->


<div id="main-wrapper" class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card border-5 m-3">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="mb-5">
                                    <h3 class="h4 font-weight-bold text-theme">Paws Welcomes You.</h3>
                                </div>

                                <h6 class="h5 mb-0">Post your pets and find a family for them !</h6>
                               
                                <h3> <?php flashMessages(); ?></h3>
                                <form id="frmadd" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="txtpetname" class="form-label"></label>
                                        <input type="text" class="form-control" name="txtpetname" placeholder="Pet Name" id="txtpetname" />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="txtpetage" class="form-label"></label>
                                        <input type="text" class="form-control" name="txtpetage" placeholder="Input your pet's age" id="txtpetage" />
                                    </div>

                                    <div class="form-group">
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" value="male" id="radmale" name="radgender" />
                                        <label class="form-check-label" for="radmale">Male</label>

                                        <input class="form-check-input" type="radio" value="female" id="radfemale" name="radgender" />
                                        <label class="form-check-label" for="radfemale">Female</label>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="txtpetdesc" class="form-label"></label>
                                        <input type="text" class="form-control" name="txtpetdesc" placeholder="Description of your pet" id="txtpetdesc" />
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="txtpdate" class="form-label"></label>
                                        <input class="form-control" id="txtpdate" placeholder="Arrival date" name="txtpdate" value="<?=$date?>" type="text" /></div>

                                    <div class="form-group mb-2">
                                        <label for="pet_image" class="form-label">Pet image</label>
                                        <input class="form-control" id="pet_image" name="pet_image" type="file" />
                                    </div>

                                    <div class="form-group">
                                        <div class="col-12 mt-3 mb-3">

                                            <select name="txtpettype" id="txtpettype" class="form-select" aria-label="Select Location">
                                                <?php
                                                //add sql to search tblpet_type and display species in ascending order
                                                $sql1 = $pdo->query("select * from tblpet_type ");
                                                foreach ($sql1 as $row) {
                                                //assign the id and name attribute to the option tag
                                                echo "<option value='" . $row['species_id'] . "'>" . $row['species_name'] .
                                                "</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>


                                    <button type="submit" name="btnadd" class="btn btn-theme btn mt-4">Post</button>

                                    <button type="submit" name="btncancel" class="btn btn-dark btn mt-4">Cancel</button>
                                    
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded-right">
                                <div class="overlay rounded-right"></div>
                                <div class="account-testimonial">
                                    <h4 class="text-white mb-4">PAWS is here</h4>
                                    <p class="lead text-white">"to help any animal in need !!"</p>
                                    <p>- Admin User</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

            <!-- end row -->

        </div>
        <!-- end col -->
    </div>
    <!-- Row -->
</div>
 

<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 

<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</body>

</html>