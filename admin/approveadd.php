<?php

require_once"../db/pdo.php";
require_once"../db/util.php";
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Ensure that the advert_id is provided and is a valid integer
    if (isset($_GET["ad_id"]) && is_numeric($_GET["ad_id"])) {
        $adid = intval($_GET["ad_id"]);

        // Prepare and execute the UPDATE statement
        try {
            $stmt = $pdo->prepare("UPDATE tbladvert SET status = 1 WHERE ad_id = :adid");
            $stmt->bindParam(':adid', $adid, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect back to the page displaying the advertisements
            header("Location: approveadvert.php");
            exit();
        } catch (PDOException $e) {
            // Handle any database errors here
            die("Error updating advert status: " . $e->getMessage());
        }
    }
}
?>


