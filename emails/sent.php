<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require_once '../backend/helper.php';
$mail = new PHPMailer(true);
try {
    // Configurare server SMTP
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'arbaselum10@gmail.com';
    $mail->Password   = 'twpwqxsmosnaiipp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Set sender and recipient
    $mail->setFrom($FromEmail, $FromName);
    $mail->addAddress($email);

    // Configure email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $htmlContent;

    // Send email
    $mail->send();
    //echo 'Message has been sent successfully!';
} catch (Exception $e) {
    // Log error message
    error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    exit();
}
?>
