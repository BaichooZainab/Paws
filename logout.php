<?php
session_start();
//delete the two session variables “fn” and “cid”
unset($_SESSION['dn']);
unset($_SESSION['did']);

unset($_SESSION['an']);
unset($_SESSION['aid']);

unset($_SESSION['on']);
unset($_SESSION['oid']);
 //destroy the session variable
 session_destroy();
 //redirect to home page
header("Location: index.php");
?>