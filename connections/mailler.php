<!-- Terminal >>>> composer require phpmailer/phpmailer -->

<?php
include "../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // just pour show errors

$mail->IsSMTP();
$mail->SMTPAuth = true;

$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->Username = 'djoumoihassan59@gmail.com';
$mail->Password = 'nxjwpeqztywaxykl'; // 
$mail->IsHTML(true);

return $mail;