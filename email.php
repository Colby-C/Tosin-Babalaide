<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['first-name']);
    $lastName = htmlspecialchars($_POST['last-name']);
    $company = htmlspecialchars($_POST['company']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io'; // Mailtrap SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'your_mailtrap_username'; // From Mailtrap
        $mail->Password = 'your_mailtrap_password'; // From Mailtrap
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('noreply@example.com', 'Your Name');
        $mail->addAddress('Austin@prolifiqsports.com');

        $mail->Subject = "New Message from $firstName $lastName";
        $mail->Body = "Name: $firstName $lastName\nCompany: $company\nPhone: $phone\nEmail: $email\nMessage: $message";

        $mail->send();
        echo "Message sent!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>