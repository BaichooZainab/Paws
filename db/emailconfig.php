<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor\autoload.php';
function sendEmail()
{
    $mail = new PHPMailer(TRUE);

    try {
        $mail->setFrom('baichoozainab21@gmail.com', 'Zainab');
        $mail->addAddress($_POST["txtemail"], 'Username');
        //$mail->addAddress($_POST["txtdemail"], 'User');

        $mail->Subject = 'Welcome to PAWS';
        $mail->isHTML(TRUE);
        $mail->Body = '<html>Your account has been activated, you may now join PAWS. Click on the link to <strong><a href="http://localhost/oswt/pawcopy/login.php">login</a></strong>.</html>';
        $mail->AltBody = 'In case the HTML does not work.';

       // $fn = $_FILES['d_profile']['name'];
        $fn = $_FILES['a_profile']['name'];
        $mail->addAttachment("upload" . DIRECTORY_SEPARATOR. $fn);

        // SMTP parameters
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'baichoozainab21@gmail.com';
        $mail->Password = 'neeqwjhrvhvffulx';
        $mail->Port = 587;

        // Add the following SMTP options
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );

        $retval = $mail->send();
        if ($retval == true) {
            $_SESSION['successmsg'] = "Register succesfull Email sent successfully";
        } else {
            $_SESSION['errormsg'] = "Email could not be sent...";
        }
    } catch (Exception $e) {
        echo $e->errorMessage();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

?>


