<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=paws_db', 'king', 'waren');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    error_log("pdo.php, SQL error=" . $e->getMessage()); // <-- Added semicolon at the end
    include('database_error.php');
    exit();
}
?>
