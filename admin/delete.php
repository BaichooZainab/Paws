<?php
require_once "../db/pdo.php";
require_once "../db/util.php";
session_start();

//Check if the pid token is in the url
if (isset( $_GET["pid"] )) {
try {
//add the delete statement with a where clause
$sql = " delete from tblpet_type where species_id=:ptypeid";
$stmt = $pdo->prepare($sql);
//retrieve the sid from the url
$stmt->execute(array(':ptypeid' => $_GET["pid"] ));
$_SESSION['successmsg'] = 'Record deleted';
header('Location: view_del_pet_type.php');
return;
} catch (Exception $e) {
    
    $_SESSION['errormsg']=$e->getMessage();
// $_SESSION['errormsg'] = 'Cannot delete this record!';
header('Location: view_del_pet_type.php');
return;
}
}

//Check if the pid token is in the url
if (isset( $_GET["nid"] )) {
    try {
    //add the delete statement with a where clause
    $sql = " delete from tblnotice where d_id=:d_id";
    $stmt = $pdo->prepare($sql);
    //retrieve the sid from the url
    $stmt->execute(array(':did' => $_GET["did"] ));
    $_SESSION['successmsg'] = 'Record deleted';
    header('Location: view_allnotice.php');
    return;
    } catch (Exception $e) {
        
        $_SESSION['errormsg']=$e->getMessage();
    // $_SESSION['errormsg'] = 'Cannot delete this record!';
    header('Location: view_allnotice.php');
    return;
    }
    }

//Check if the did token is in the url
if (isset( $_GET["did"] )) {
    try {
    //add the delete statement with a where clause
    $sql = " delete from tbldonator where d_id=:doid";
    $stmt = $pdo->prepare($sql);
    //retrieve the sid from the url
    $stmt->execute(array(':doid' => $_GET["did"] ));
    $_SESSION['successmsg'] = 'Record deleted';
    header('Location: deletedonator.php');
    return;
    } catch (Exception $e) {
        
        $_SESSION['errormsg']=$e->getMessage();
    // $_SESSION['errormsg'] = 'Cannot delete this record!';
    header('Location: deletedonator.php');
    return;
    }
    }
    

    //Check if the did token is in the url
if (isset( $_GET["aid"] )) {
    try {
    //add the delete statement with a where clause
    $sql = " delete from tbladopter where a_id=:adoid";
    $stmt = $pdo->prepare($sql);
    //retrieve the sid from the url
    $stmt->execute(array(':adoid' => $_GET["aid"] ));
    $_SESSION['successmsg'] = 'Record deleted';
    header('Location: d_adopter.php');
    return;
    } catch (Exception $e) {
        
        $_SESSION['errormsg']=$e->getMessage();
    // $_SESSION['errormsg'] = 'Cannot delete this record!';
    header('Location: d_adopter.php');
    return;
    }
    }



?>