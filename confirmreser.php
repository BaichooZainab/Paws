<?php

require_once "./db/pdo.php";
require "./db/util.php";

session_start();

//if(!isset($_SESSION['did'])){
// header("Location: index.php");
//}
if ( !isset($_GET['adoid']) ) {
$_SESSION['errormsg'] = "Missing id";
header('Location: ./admin/viewadoption.php');
return;
}
$sql = "UPDATE tbladoption SET adopt_status = :adopted where adopt_id= :adoid";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':adoid' => $_GET['adoid'],
':adopted' => "2"
)
);
$_SESSION["successmsg"] = "Adoption confirmed";
header( 'Location: ./admin/viewadoption.php' );
return;
?>