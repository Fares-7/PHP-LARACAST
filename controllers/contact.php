<?php

$header= "Contact Page";
$errors = [];
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if (!$name) $errors[] = 'Name is required.';
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (!$message) $errors[] = 'Message is required.';
    if (empty($errors)) {
        $to = 'your@email.com'; // Change to your email address
        $subject = 'Contact Form Submission';
        $body = "Name: $name\nEmail: $email\nMessage:\n$message";
        $headers = "From: $email";
        if (mail($to, $subject, $body, $headers)) {
            $success = 'Thank you for contacting us! We will get back to you soon.';
            $_POST = [];
        } else {
            $errors[] = 'Failed to send email. Please try again later.';
        }
    }
}
require_once'views/contact.view.php';
