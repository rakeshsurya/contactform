<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {

  // Get the form data
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $type = $_POST['type'];
  $enquiry = $_POST['enquiry'];

  // Validate the form data
  if (empty($fname) || empty($lname) || empty($phone) || empty($email) || empty($type) || empty($enquiry)) {
    die("Please fill all the fields");
  }

  // Sanitize the form data
  $fname = filter_var($fname, FILTER_SANITIZE_STRING);
  $lname = filter_var($lname, FILTER_SANITIZE_STRING);
  $phone = filter_var($phone, FILTER_SANITIZE_STRING);
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $type = filter_var($type, FILTER_SANITIZE_STRING);
  $enquiry = filter_var($enquiry, FILTER_SANITIZE_STRING);

  // Prepare the email message
  $subject = "New contact form submission";
  $message = "You have received a new contact form submission from $fname $lname.\n\n";
  $message .= "Phone number: $phone\n";
  $message .= "Email address: $email\n";
  $message .= "Wholesale or dropshipping: $type\n";
  $message .= "Enquiry: $enquiry\n";

  // Set the email headers
  $headers = "From: $email\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Set the admin email address
  $admin_email = "rakeshsurya3@gmail.com";

  // Send the email to the admin
  mail($admin_email, $subject, $message, $headers);

  // Prepare the thank you email message
  $subject = "Thank you for contacting us";
  $message = "Dear $fname,\n\n";
  $message .= "Thank you for contacting us. We have received your enquiry and will get back to you soon.\n\n";
  $message .= "Best regards,\n";
  $message .= "The Admin Team";

  // Set the email headers
  $headers = "From: $admin_email\r\n";
  $headers .= "Reply-To: $admin_email\r\n";

  // Send the email to the customer
  mail($email, $subject, $message, $headers);

  // Redirect to a thank you page
  header("Location: thank_you.html");
  exit();
}
?>
