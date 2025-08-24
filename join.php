<?php
// Database connection
$host = "localhost";
$dbname = "csr_db";   // replace with your database name
$username = "csr_user"; // replace with your DB user
$password = "your_password"; // replace with DB password

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Sanitize input
$name       = $conn->real_escape_string($_POST['name']);
$email      = $conn->real_escape_string($_POST['email']);
$membership = $conn->real_escape_string($_POST['membership']);
$location   = $conn->real_escape_string($_POST['location']);
$message    = $conn->real_escape_string($_POST['message']);

// Insert into database
$sql = "INSERT INTO readers_members (name, email, membership_type, location, message) 
        VALUES ('$name', '$email', '$membership', '$location', '$message')";

if ($conn->query($sql) === TRUE) {
    // Send notification email (using PHP mail for now, later switch to SendGrid SMTP)
    $to = "info@csrwork.org";
    $subject = "New Reader Membership Application";
    $body = "Name: $name\nEmail: $email\nMembership: $membership\nLocation: $location\nMessage: $message";
    $headers = "From: noreply@csrwork.org";

    mail($to, $subject, $body, $headers);

    echo "Thank you for your application. We will contact you soon.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>