<?php
    $to = "office@improve-english.com.ua"; // The email address you want to receive the test email
    $subject = "Test email from PHP"; // The email subject
    $message = "This is a test email to check if PHP mail() function works"; // The email body
    $headers = "From:office@improve-english.com.ua"; // The email sender

    if (mail($to, $subject, $message, $headers)) {
        echo "Test email sent";
    } else {
        echo "Failed to send";
    }
?>