<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // SMTP Configuration
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server (e.g., smtp.sendgrid.net)
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Your SMTP username
        $mail->Password = 'your-email-password'; // Your SMTP password or App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption (TLS/SSL)
        $mail->Port = 587; // SMTP port (TLS: 587, SSL: 465)

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Your Name'); // Sender
        $mail->addAddress('sunerasandasiri@gmail.com', 'Sunera Sandasiri'); // Recipient

        // Content
        $mail->isHTML(false); // Email format (plain text)
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "Name: $name\nEmail: $email\nMessage:\n$message";

        // Send Email
        $mail->send();
        echo "Thank you, $name! Your message has been sent.";
    } catch (Exception $e) {
        echo "There was an issue sending your message. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
