<?php

require_once "./db/pdo.php";
require_once "./db/util.php";
session_start();

//Check if the pid token is in the url
if (isset( $_GET["nid"] )) {
    try {
    //add the delete statement with a where clause
    $sql = " delete from tblnotice where notice_id=:noid";
    $stmt = $pdo->prepare($sql);
    //retrieve the nid from the url
    $stmt->execute(array(':noid' => $_GET["nid"] ));
    $_SESSION['successmsg'] = 'Record deleted';
    header('Location: del_notice.php');
    return;
    } catch (Exception $e) {
        
        $_SESSION['errormsg']=$e->getMessage();
    // $_SESSION['errormsg'] = 'Cannot delete this record!';
    header('Location: del_notice.php');
    return;
    }
    }


    //Check if the pid token is in the url
if (isset( $_GET["pid"] )) {
    try {
    //add the delete statement with a where clause
    $sql = " delete from tblpet where pet_id=:pid";
    $stmt = $pdo->prepare($sql);
    //retrieve the nid from the url
    $stmt->execute(array(':pid' => $_GET["pid"] ));
    $_SESSION['successmsg'] = 'Pet deleted';
    header('Location: del_pet.php');
    return;
    } catch (Exception $e) {
        
        $_SESSION['errormsg']=$e->getMessage();
    // $_SESSION['errormsg'] = 'Cannot delete this pet!';
    header('Location: del_pet.php');
    return;
    }
    }

    if (isset( $_GET["eid"] )) {
        try {
        //add the delete statement with a where clause
        $sql = " delete from tblequipments where equip_id=:eid";
        $stmt = $pdo->prepare($sql);
        //retrieve the nid from the url
        $stmt->execute(array(':eid' => $_GET["eid"] ));
        $_SESSION['successmsg'] = 'Equipment deleted';
        header('Location: del_equip.php');
        return;
        } catch (Exception $e) {
            
            $_SESSION['errormsg']=$e->getMessage();
        // $_SESSION['errormsg'] = 'Cannot delete this equipment!';
        header('Location: del_equip.php');
        return;
        }
        }

    ?>