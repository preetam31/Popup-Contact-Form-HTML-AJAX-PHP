<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validation (you can customize this as needed)
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo "Invalid phone number format.";
        exit;
    }

    // Email recipient (change to your email address)
    $to = "admin@yourdoman.com"; // Replace with your email

    // Subject of the email
    $subject = "New Contact Form Submission";

    // Email content
    $email_content = "You have received a new message from the contact form:\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Success";
    } else {
        echo "There was an error sending the email.";
    }
} else {
    echo "Invalid request.";
}
?>