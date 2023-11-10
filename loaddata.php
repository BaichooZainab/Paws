<?php session_start();
require_once "./db/pdo.php";
// Retrieve data from Query String
$st = '%' . $_GET['pet_gender'] . '%';




// $stmt = $pdo->query("SELECT * FROM tblpet p
// INNER JOIN tblpet_type pt ON p.species_id = pt.species_id and p.pet_status = 1");

$stmt = $pdo->prepare("SELECT * FROM tblpet p
INNER JOIN tblpet_type pt ON p.species_id = pt.species_id and p.pet_status = 1 where p.pet_gender like :gender");


$stmt->execute(
array(
':gender' => $st
)
);

$display_str = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):

  $pn = htmlentities($row['pet_name']);
  $img = htmlentities($row['pet_image']);
  $sn = htmlentities($row['species_name']);
  $age = htmlentities($row['pet_age']);
  $gender = htmlentities($row['pet_gender']);
  $desc = htmlentities($row['pet_desc']);
  $date = htmlentities($row['arrival_date']);


?>


<div class="card mb-2" >
        <img src="./upload/<?php echo $img; ?>" class="card-img-top" style="max-height: 500px;" alt="Pet image">

           <div class="card-body">
                <h5 class="card-title">Pet Name: <?php echo $pn; ?></h5>
                <h5 class="card-title">Species: <?php echo $sn; ?></h5>
                <p class="card-text">Age: <?php echo $age; ?></p>
                <p class="card-text">Gender: <?php echo $gender; ?></p>
                <p class="card-text"><?php echo $desc; ?></p>
                <p class="card-text">Arrival Date: <?php echo $date; ?></p>
                

            </div>
         </div>

   <?php endwhile; 

echo $display_str;

