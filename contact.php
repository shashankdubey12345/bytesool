<?php
// Contact form handler for Bytesool using PHPMailer with SMTP
// Make sure this file is deployed on a PHP-enabled server.

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic sanitization
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Simple validation
    if ($name === '' || $email === '' || $phone === '' || $subject === '' || $message === '') {
        header('Location: contact.html?error=1');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: contact.html?error=1');
        exit;
    }

    // Prevent header injection
    $name  = str_replace(array("\r", "\n"), array(' ', ' '), $name);
    $email = str_replace(array("\r", "\n"), array(' ', ' '), $email);
    $subject = str_replace(array("\r", "\n"), array(' ', ' '), $subject);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtpout.secureserver.net';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@bytesool.com';
        $mail->Password   = '#SilverGold@301';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('info@bytesool.com', 'Bytesool Contact');
        $mail->addAddress('info@bytesool.com');
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Submission - Bytesool';
        $mail->Body    = "You have received a new contact form submission from Bytesool website:\n\n"
                        . "Name: {$name}\n"
                        . "Email: {$email}\n"
                        . "Phone: {$phone}\n"
                        . "Subject: {$subject}\n\n"
                        . "Message:\n{$message}\n";

        $mail->send();
        header('Location: contact.html?success=1');
        exit;
    } catch (Exception $e) {
        header('Location: contact.html?error=1');
        exit;
    }
}

// Fallback redirect
header('Location: contact.html');
exit;

