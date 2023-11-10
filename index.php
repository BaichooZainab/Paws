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

      <section>

<div id="carouselExampleFade" class="carousel slide carousel-fade">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/images/banner.jpg" class="d-block w-100" alt="...">
    </div>

    <div class="carousel-item">
      <img src="assets/images/puppies.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</section>

<hr class="my-5" />


      <section style="background: rgb(195,194,205);
background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
        <div class="row">
          <div class="col-md-6 mt-4 gx-5 mb-4">
            <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
              <img src="assets/images/dog.jpg" style="height: 500px; " class="img-fluid" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a>
            </div>
          </div>

          <div class="col-md-6 mt-4 gx-5 mb-4">
            <h4><strong>Welcome to PAWS - Providing Animals With Shelter!</strong></h4>
            <p class="text-muted">
            At PAWS, we are dedicated to making a positive impact on the lives of animals in need. Our online shelter was established with a heartfelt mission: to create a safe haven for animals, where they can find love, care, and a forever home.

Founded by a passionate team of animal lovers, PAWS is more than just a virtual shelter; it's a community-driven initiative that believes every life is worth saving. We understand the importance of animal welfare and strive to make a difference, one paw at a time.

            </p>
            <p><strong>Our Core Values:</strong></p>
            <p class="text-muted">
            1. Adoption: Our ultimate goal is to find loving forever homes for all our rescued animals. We carefully screen potential adopters to ensure a perfect match between the animal and their new family.
            </p>

            <p class="text-muted">
            2. Compassion: We believe in treating every animal with love and respect, regardless of their background or circumstances. We are committed to nurturing injured, abandoned, and neglected animals back to health and happiness.
            </p>
          </div>
        </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />


<!-- ======= Stands Section ======= -->
<section class="text-center">
        <h4 class="mb-3"><strong>View Our animals that are ready to have a home</strong></h4>

          <div  class="row">

            <div class="d-flex justify-content-center mb-4">
              <form name='frmsearchpet'>
                <div class="row">

                  <div class="col">
                    <input type='text' class="form-control"
                    onkeyup='ajaxCall()' id='pet_gender' placeholder="Gender" />
                  </div>

                </div>
              </form>

              </div>

              <div id="searchresult" class="row"></div>

            </div>
          
        <?php
  $stmt = $pdo->query("SELECT * FROM tblpet p
  INNER JOIN tblpet_type pt ON p.species_id = pt.species_id and p.pet_status = 1");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

  $pn = htmlentities($row['pet_name']);
$img = htmlentities($row['pet_image']);
$sn = htmlentities($row['species_name']);
$age = htmlentities($row['pet_age']);
$gender = htmlentities($row['pet_gender']);
$desc = htmlentities($row['pet_desc']);
$date = htmlentities($row['arrival_date']);

?>  

<div class="card mb-2" >
        <img src="./upload/<?php echo $img; ?>" class="card-img-top" style="max-height: 500px;" alt="work image">

           <div class="card-body">
                <h5 class="card-title">Pet Name: <?php echo $pn; ?></h5>
                <h5 class="card-title">Species: <?php echo $sn; ?></h5>
                <p class="card-text">Age: <?php echo $age; ?></p>
                <p class="card-text">Gender: <?php echo $gender; ?></p>
                <p class="card-text"><?php echo $desc; ?></p>
                <p class="card-text">Arrival Date: <?php echo $date; ?></p>
                

            </div>
         </div>

<?php
}
?>

      </section>
      <!--Section: Content-->

      <hr class="my-5" />

  
</section>

      <section class="text-center">
        
      <h4 class="mb-3"><strong>View All equipments to donate</strong></h4>
        <div class="row">

        <?php
  $stmt = $pdo->query("SELECT * FROM tblequipments e
  INNER JOIN tbldonator d ON e.d_id = d.d_id and status = 1");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


       echo   '<div class="col-lg-4 col-md-12 mb-4">
            <div class="card">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">';
               echo ('<img class="img-fluid" alt="" src="./upload/' .
               htmlentities($row['equip_img']) . '">' . "\n");
                echo '<a href="#">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>';
              echo '<div class="card-body">
              <h5 class="card-title"><a href="">' . htmlentities($row['equip_name']) .
              '</a></h5>';

              echo '<p class="card-text">' . htmlentities($row['equip_desc']) . '</p>';

              echo '<p class="card-text">' . htmlentities($row['d_username']) . '</p>';

              echo '<p class="card-text">' . htmlentities($row['d_number']) . '</p>';

              echo '<p class="fst-italic text-center">' .
htmlentities($row['equip_date']) . '</p>

              </div>
            </div>
          </div>';
}
?>
         </div>
      </section>
      <!--Section: Content-->

      <hr class="my-5" />

      <section class="text-center">
  <div class="row">
    <div class="col-lg-3 col-md-6 mb-5 mb-md-5 mb-lg-0 position-relative">
      <i class="fas fa-dog fa-3x text-primary mb-4"></i>
      <p class="card-text"><?php echo $petcount; ?></p>
      <h6 class="fw-normal mb-0">Pets available</h6>
      <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
    </div>

    <div class="col-lg-3 col-md-6 mb-5 mb-md-5 mb-lg-0 position-relative">
      <i class="fas fa-cat fa-3x text-primary mb-4"></i>
      <p class="card-text"><?php echo $pet_typecount; ?></p>
      <h6 class="fw-normal mb-0">Animal Species</h6>
      <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
    </div>

    <div class="col-lg-3 col-md-6 mb-5 mb-md-0 position-relative">
      <i class="fas fa-user fa-3x text-primary mb-4"></i>
      <p class="card-text"><?php echo $adoptercount; ?></p>
      <h6 class="fw-normal mb-0">Adopters</h6>
      <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
    </div>

    <div class="col-lg-3 col-md-6 mb-5 mb-md-0 position-relative">
      <i class="fas fa-user fa-3x text-primary mb-4"></i>
      <p class="card-text"><?php echo $donatorcount; ?></p>
      <h6 class="fw-normal mb-0">Donators</h6>
    </div>
  </div>
</section>

<hr class="my-5" />


<section>
  <h2 style="text-align:center;">Advertise With us</h2>
<div class="swiper-container">
        <div class="swiper-wrapper">
        <?php
    $stmt = $pdo->query("SELECT * FROM tbladvert where status=1");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo ('<div class="swiper-slide">
                <div >
                    <div >
                        <div >
                        <a target="_blank" href="' .htmlentities($row['websiteurl']) . '">

                            <img class="img-fluid" alt="" src="upload/' . htmlentities($row['ad_image']) . '">
                        </div>
                        <p class="text-center mt-2">' . htmlentities($row['company_name']) . '</p>

                        <p class="text-center mt-2">' . htmlentities($row['ad_desc']) . '</p>

                        
                        
                    </div>
                </div>
            </div>');
    }
    ?>
</div>
<div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<hr class="my-5" />

<section class="p-4 p-md-5 text-center text-lg-start shadow-1-strong rounded" style="background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(147,107,47,0.9836309523809523) 35%, rgba(43,54,56,1) 100%);">
  <div class="row d-flex justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-body m-3">
          <div class="row">
            <h2 style="text-align:center;">What they are saying about PAWS</h2>
<div class="swiper-container">
        <div class="swiper-wrapper">
        <?php
    $stmt = $pdo->query("SELECT * FROM tbltestimonials ts
    INNER JOIN tbladopter a ON ts.a_id=a.a_id and ts.status = 1");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo ('<div class="swiper-slide">
                <div >
                    <div >
                        <div >
                            <img class="img-fluid" alt="" src="upload/' . htmlentities($row['a_profile']) . '">
                        </div>
                        <p class="text-center">' . htmlentities($row['t_name']) . '</p>

                        <p class="text-center">' . htmlentities($row['a_username']) . '</p>

                        <p class="text-center">' . htmlentities($row['a_email']) . '</p>

                        <p class="text-center">' . htmlentities($row['testify']) . '</p>

                        <p class="text-center">' . htmlentities($row['ratings']) . '</p>

                        <p class="text-center">' . htmlentities($row['testified_date']) . '</p>
                    </div>
                </div>
            </div>');
    }
    ?>
</div>
<div class="swiper-pagination"></div>
        </div>
    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<hr class="my-5" /> 
    </div>
  </main>
  <!--Main layout-->

  


<!--Footer -->
<?php include_once('assets/includes/footer.php');?>
<!-- /Footer--> 


<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper('.swiper-container', {
            // Set the direction to 'horizontal' for horizontal scrolling/swiping
            direction: 'horizontal',
            loop: true, // Set loop to true if you want the slides to repeat
            autoplay: {
                delay: 3000, // Set the delay between slide changes (in milliseconds)
            },
            pagination: {
                el: '.swiper-pagination', // Set the class name for the pagination element
                clickable: true, // Enable clickable pagination bullets
            },
        });
    });
</script>



<script language="javascript" type="text/javascript">
function ajaxCall() {
  // Get the values from user and pass it to the server script
  var st = document.getElementById('pet_gender').value;

  var queryString = "?pet_gender=" + encodeURIComponent(st);


  fetch("loaddata.php" + queryString)
    .then(response => response.text())
    .then(successFn)
    .catch(error => console.error('Error:', error));
}

function successFn(result) {
  document.getElementById('searchresult').innerHTML = result;
}

</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</body>
</html>