<?php

header("Content-Type: application/json");

// Check if the form is submitted
// Check if the form is submitted
if (isset($_POST['submit'])) {

  // Get the user's input from the form
  $name = htmlspecialchars($_POST['name_feedback']); // Escape user input to prevent XSS
  $email = filter_var($_POST['email_feedback'], FILTER_SANITIZE_EMAIL); // Sanitize user input to prevent header injection
  $feedback = htmlspecialchars($_POST['message_feedback']); // Escape user input to prevent XSS

  // Validate the user's input
  // You can add more validation rules here
  if (empty($name) || empty($email) || empty($feedback)) {
    // Display an error message if any field is empty
    // Use json_encode to return a JSON object with status and message properties
    echo json_encode(array("status" => "error", "message" => "Please fill in all the fields. You sent: name - ".$name.", and email - ".$email.", and message - ".$feedback));
  } else {
    // Prepare the email headers and body
    $to = "vlad.rastvorov@aol.com"; // The email address you want to receive the feedback
    $subject = "Feedback from $name"; // The email subject
    $message = "Name: $name\nEmail: $email\nFeedback: $feedback"; // The email body
    $headers = "From: office@improve-english.com.ua"; // The email sender (use your own domain to prevent email spoofing)
    $headers .= "\r\nReply-To: $email"; // The email reply-to address

    // Send the email using the mail() function
    if (mail($to, $subject, $message, $headers)) {
      // Display a success message if the email is sent
      // Use json_encode to return a JSON object with status and message properties
      echo json_encode(array("status" => "success", "message" => "Thank you for your feedback. We appreciate it."));
    } else {
      // Display an error message if the email is not sent
      // Use json_encode to return a JSON object with status and message properties
      echo json_encode(array("status" => "error", "message" => "Sorry, something went wrong. Please try again later."));
    }
  }
} else {
  // Display an error message if the form is not submitted
  // Use json_encode to return a JSON object with status and message properties
  echo json_encode(array("status" => "error", "message" => "Please submit the form."));
}
?>
