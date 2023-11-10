<?php

require_once"../db/pdo.php";
require_once"../db/util.php";
session_start();

//Check if the sid token is in the url
if (isset( $_GET["did"] )) {
    try {
    //add the delete statement with a where clause
    $sql = " update tbldonator set d_status = 0 where d_id=:did";
    $stmt = $pdo->prepare($sql);
    //retrieve the sid from the url
    $stmt->execute(array(':did' => $_GET["did"] ));
    $_SESSION['successmsg'] = 'Donator Blocked';
    header('Location: blockdonator.php');
    return;
    } catch (Exception $e) {

        $_SESSION['errormsg']=$e->getMessage();
    // $_SESSION['errormsg'] = 'Cannot delete this record!';
    header('Location: blockdonator.php');
    return;
    }
    }

    if (isset( $_GET["aid"] )) {
        try {
        //add the delete statement with a where clause
        $sql = " update tbladopter set a_status = 0 where a_id=:aid";
        $stmt = $pdo->prepare($sql);
        //retrieve the sid from the url
        $stmt->execute(array(':aid' => $_GET["aid"] ));
        $_SESSION['successmsg'] = 'Adopter Blocked';
        header('Location: blockadopter.php');
        return;
        } catch (Exception $e) {
    
            $_SESSION['errormsg']=$e->getMessage();
        // $_SESSION['errormsg'] = 'Cannot delete this record!';
        header('Location: blockadopter.php');
        return;
        }
        }
?>


