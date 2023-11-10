<?php

require_once"../db/pdo.php";
require_once"../db/util.php";
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Ensure that the advert_id is provided and is a valid integer
    if (isset($_GET["equip_id"]) && is_numeric($_GET["equip_id"])) {
        $eid = intval($_GET["equip_id"]);

        // Prepare and execute the UPDATE statement
        try {
            $stmt = $pdo->prepare("UPDATE tblequipments SET status = 1 WHERE equip_id = :eid");
            $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
            $stmt->execute();

            // Redirect back to the page displaying the advertisements
            header("Location: approveequip.php");
            exit();
        } catch (PDOException $e) {
            // Handle any database errors here
            die("Error updating equip status: " . $e->getMessage());
        }
    }
}
?>