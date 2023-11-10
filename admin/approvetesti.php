<?php
require_once "../db/pdo.php";
session_start();

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Approve Advert</title>
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
        
<!--Header-->
<?php include_once('../assets/includes/hadmin.php');?>
<!-- /Header -->
 
 
  <div class="container-fluid mt-5">
<div class="row">

<main class="col-md-7 offset-md-1 py-5">
<div class="row mt-3">
<h3>Testimonial's Listing</h3>

<?php
// Retrieve data from the database by joining the organization and advertisement tables
$stmt = $pdo->query("SELECT a.a_username, a.a_profile, t.t_id, t.t_name, t.testify, t.ratings, t.testified_date, t.status
    FROM tbladopter a
    JOIN tbltestimonials t ON a.a_id = t.a_id WHERE t.status = 0");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $auser = htmlentities($row['a_username']);
    $aprofile = htmlentities($row['a_profile']);
    $tid = htmlentities($row['t_id']);
    $tname = htmlentities($row['t_name']);
    $testify = htmlentities($row['testify']);
    $rate = htmlentities($row['ratings']);
    $date = htmlentities($row['testified_date']);

    ?>
 <div class="card">
        <img src="../upload/<?php echo $aprofile; ?>" class="card-img-top" style="max-height: 500px;" alt="Adopter Profile">

        <div class="card-body">
            <h5 class="card-title"><?php echo $auser; ?></h5>
           
            <p class="card-text"><?php echo $tname; ?></p>
            <p class="card-text"><?php echo $testify; ?></p>
            <p class="card-text"><?php echo $rate; ?></p>
            <p class="card-text"><?php echo $date; ?></p>

            <form action="app_testi.php" method="GET">
                <input type="hidden" name="t_id" value="<?php echo $tid; ?>">
                <button type="submit" class="btn btn-primary">Approve Testimonial</button>
            </form>
        </div>
    </div>

<?php
}
?>

</main>
</div>
</div>



<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>
