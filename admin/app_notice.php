<?php

require_once"../db/pdo.php";
require_once"../db/util.php";
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Ensure that the advert_id is provided and is a valid integer
    if (isset($_GET["notice_id"]) && is_numeric($_GET["notice_id"])) {
        $nid = intval($_GET["notice_id"]);

        // Prepare and execute the UPDATE statement
        try {
            $stmt = $pdo->prepare("UPDATE tblnotice SET status = 1 WHERE notice_id = :nid");
            $stmt->bindParam(':nid', $nid, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect back to the page displaying the advertisements
            header("Location: approvenotice.php");
            exit();
        } catch (PDOException $e) {
            // Handle any database errors here
            die("Error updating notice status: " . $e->getMessage());
        }
    }
}
?>