<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$dbname = "csr_db";
$username = "csr_user";
$password = "your_password";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) die("DB connection failed: " . $conn->connect_error);

header("Content-Type: text/csv");
header("Content-Disposition: attachment;filename=readers_members.csv");

$output = fopen("php://output", "w");
fputcsv($output, ["ID", "Name", "Email", "Membership", "Location", "Message", "Created At"]);

$result = $conn->query("SELECT * FROM readers_members ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
exit;
?>