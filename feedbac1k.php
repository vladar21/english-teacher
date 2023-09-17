<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
  // Get the user's input from the form
  $name = htmlspecialchars($_POST['name']); // Escape user input to prevent XSS
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize user input to prevent header injection
  $feedback = htmlspecialchars($_POST['feedback']); // Escape user input to prevent XSS

  // Validate the user's input
  // You can add more validation rules here
  if (empty($name) || empty($email) || empty($feedback)) {
    // Display an error message if any field is empty
    echo "Please fill in all the fields.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Display an error message if the email is not valid
    echo "Please enter a valid email address.";
  } else if (!isset($_SESSION['token']) || $_POST['token'] != $_SESSION['token']) {
    // Display an error message if the form token is missing or invalid to prevent CSRF
    echo "Invalid form submission. Please try again.";
  } else {
    // Prepare the email headers and body
    $to = "office@improve-english.com.uf"; // The email address you want to receive the feedback
    $subject = "Feedback from $name"; // The email subject
    $message = "Name: $name\nEmail: $email\nFeedback: $feedback"; // The email body
    $headers = "From: your_email@example.com"; // The email sender (use your own domain to prevent email spoofing)
    $headers .= "\r\nReply-To: $email"; // The email reply-to address

    // Send the email using the mail() function
    if (mail($to, $subject, $message, $headers)) {
      // Display a success message if the email is sent
      echo "Thank you for your feedback. We appreciate it.";
      // You can also send a copy of the feedback to the user's email
      mail($email, "Your feedback", $message, "From: $to");
    } else {
      // Display an error message if the email is not sent
      echo "Sorry, something went wrong. Please try again later.";
    }
  }
}
?>