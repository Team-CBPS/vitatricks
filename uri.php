<?php
require('settings.php'); //Please specify FROM address in this file!

error_reporting(E_ERROR | E_PARSE);
$file = fopen("uri.ics", "rb");
$text = fread($file,filesize("uri.ics"));
fclose($file);

$uri = $_POST["uri"];

$toSend = str_replace("<URI-HERE>",$uri,$text);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/Exception.php');
$email = $_POST["email"];
$mail = new PHPMailer;
$mail->setFrom($MAIL_SERVER_FROM, 'SilicaAndPina');
$mail->addAddress($email, 'You');
$mail->Subject  = 'Run Custom URI-Schema';
$mail->Body = $MAIL_BODY;
$mail->isHTML(true); 
$mail->addStringAttachment($toSend,"uri.ics");
$mail->send();
?> 

<h1>uri.ics has been sent to: <?php echo htmlspecialchars($email); ?></h1><br>
<b>Please make sure to check the SPAM folder!</b><br>
<a href="index.html">Return to homepage</a>

