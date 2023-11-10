<?php

require_once"../db/pdo.php";
require_once"../db/util.php";
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Ensure that the advert_id is provided and is a valid integer
    if (isset($_GET["t_id"]) && is_numeric($_GET["t_id"])) {
        $tid = intval($_GET["t_id"]);

        // Prepare and execute the UPDATE statement
        try {
            $stmt = $pdo->prepare("UPDATE tbltestimonials SET status = 1 WHERE t_id = :tid");
            $stmt->bindParam(':tid', $tid, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect back to the page displaying the advertisements
            header("Location: approvetesti.php");
            exit();
        } catch (PDOException $e) {
            // Handle any database errors here
            die("Error updating testimonial status: " . $e->getMessage());
        }
    }
}
?>