<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        echo "Please fill in the form correctly.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';       // Your SMTP server (can be Gmail, SendGrid, etc.)
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  // Your email
        $mail->Password = 'your-app-password';     // App password or SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('info@csrwork.org', 'CSR Team'); // Where to send the messages

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message from $name";
        $mail->Body    = "<strong>Name:</strong> $name <br>
                          <strong>Email:</strong> $email <br><br>
                          <strong>Message:</strong><br>" . nl2br($message);

        $mail->send();
        header("Location: thank-you.html");
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>