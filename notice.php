<?php session_start();
require_once "./db/pdo.php";



function getpetcount() {
  global $pdo;
$stmt = $pdo->query("SELECT * FROM tblpet");
//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

return $count;
}

function getpet_typecount() {
  global $pdo;
$stmt = $pdo->query("SELECT * FROM tblpet_type");
$count =$stmt->rowCount();
return $count;
}

function getadoptercount() {
  global $pdo;
$stmt = $pdo->query("SELECT * FROM tbladopter");
$count =$stmt->rowCount();
return $count;
}

function getdonatorcount() {
  global $pdo;
$stmt = $pdo->query("SELECT * FROM tbldonator");
$count =$stmt->rowCount();
return $count;

}

$petcount = getpetcount();
$pet_typecount = getpet_typecount();
$adoptercount = getadoptercount();
$donatorcount = getdonatorcount();

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>PAWS</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/login.css" type="text/css">

<link rel="stylesheet" href="assets/css/swiper.css" type="text/css">

<link rel="stylesheet" type="text/css" href="./swiper/swiper-bundle.min.css">

<!--Icon -->
<link rel="icon" href="assets/images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 

<script src="https://kit.fontawesome.com/8181027d18.js"crossorigin="anonymous"></script>


</head>
<body>

<!--Header-->
<?php include_once('assets/includes/header.php');?>
<!-- /Header --> 

  <!--Main layout-->
  <main class="mt-5">
    <div class="container">
      <!--Section: Content-->

      <section class="text-center">
        
      <h4 class="mb-3"><strong>View Important Notice</strong></h4>
        <div class="row">

        <?php
  $stmt = $pdo->query("SELECT * FROM tblnotice n
  INNER JOIN tbldonator d ON n.d_id = d.d_id and status = 1");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


       echo   '<div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">';
               echo ('<img class="img-fluid" alt="" src="./upload/' .
               htmlentities($row['picture']) . '">' . "\n");
                echo '<a href="#">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>';
              echo '<div class="card-body">
              <h5 class="card-title"><a href="">' . htmlentities($row['notice_name']) .
              '</a></h5>';

              echo '<p class="card-text">' . htmlentities($row['notice_desc']) . '</p>';

              echo '<p class="card-text">' . htmlentities($row['d_username']) . '</p>';

              echo '<p class="card-text">' . htmlentities($row['d_number']) . '</p>';

              echo '<p class="fst-italic text-center">' .
htmlentities($row['notice_date']) . '</p>

              </div>
            </div>
          </div>';
}
?>
         </div>
      </section>
      <!--Section: Content-->

    </div>
  </main>
  <!--Main layout-->

  


<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 


<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</body>
</html>