<?php
require('settings.php'); //Please specify FROM address in this file!
error_reporting(E_ERROR | E_PARSE);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/Exception.php');$email = $_POST["email"];
$mail = new PHPMailer;
$mail->setFrom($MAIL_SERVER_FROM, 'SilicaAndPina');
$mail->addAddress($email, 'You');
$mail->Subject  = 'Run "Package Installer" (NPXS10031)';
$mail->Body = $MAIL_BODY;
$mail->isHTML(true); 
$mail->addAttachment("pkg.ics");
$mail->send();
?> 

<h1>pkg.ics has been sent to: <?php echo htmlspecialchars($email); ?></h1><br>
<b>Please make sure to check the SPAM folder!</b><br>
<a href="index.html">Return to homepage</a>
