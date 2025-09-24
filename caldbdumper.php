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
$mail->Subject  = 'Dump Calendar.db';
$mail->Body = '<b>1. Press ... > "Add To Calendar"<br>2. Find The Event In Calendar<br>3. Press ... > Send By Email</b>';
$mail->isHTML(true); 
$mail->addAttachment("caldbdumper.ics");
$mail->send();
?> 

<h1>caldbdumper.ics has been sent to: <?php echo htmlspecialchars($email); ?></h1><br>
<b>Please make sure to check the SPAM folder!</b><br>
<a href="index.html">Return to homepage</a>

