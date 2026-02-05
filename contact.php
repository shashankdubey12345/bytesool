<?php
// Simple contact form handler for Bytesool
// Make sure this file is deployed on a PHP-enabled server.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic sanitization
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Simple validation
    if ($name === '' || $email === '' || $phone === '' || $service === '' || $message === '') {
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

    // Configure admin email here
    $to      = 'info@bytesool.com'; // change to your real admin email
    $subject = 'New Contact Form Submission - Bytesool';

    $body = "You have received a new contact form submission from Bytesool website:\n\n"
          . "Name: {$name}\n"
          . "Email: {$email}\n"
          . "Phone: {$phone}\n"
          . "Service Required: {$service}\n\n"
          . "Message:\n{$message}\n";

    $headers   = "From: noreply@bytesool.com\r\n";
    $headers  .= "Reply-To: {$email}\r\n";

    // Send email
    if (@mail($to, $subject, $body, $headers)) {
        header('Location: contact.html?success=1');
        exit;
    } else {
        header('Location: contact.html?error=1');
        exit;
    }
}

// Fallback redirect
header('Location: contact.html');
exit;

