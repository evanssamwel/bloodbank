<?php
require 'functions/functions.php';
session_start();

if (!isset($_SESSION['user'])) {
    // Email validation function
    function validateEmail($email) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    $to_email = 'adones@gmail.com';
    $subject = 'Blood Bank Mail';
    $message = 'This mail is sent using the PHP mail function.';
    $headers = 'From: admin@gmail.com';

    // Validate the email address before sending
    if (!validateEmail($to_email)) {
        echo "Invalid email address.";
    } else {
        // Send email
        if (mail($to_email, $subject, $message, $headers)) {
            echo "This email was sent successfully using PHP Mail.";
        } else {
            echo "Failed to send email.";
        }
    }
} else {
    echo "User session is active. Email functionality skipped.";
}
?>
