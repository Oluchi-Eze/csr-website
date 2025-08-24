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

$result = $conn->query("SELECT * FROM readers_members ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CSR Admin Dashboard</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
    h2 { color: #28a745; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ddd; }
    th { background: #28a745; color: white; }
    tr:nth-child(even) { background: #f2f2f2; }
    a.btn { display: inline-block; margin-top: 15px; padding: 8px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; }
    a.btn:hover { background: #218838; }
  </style>
</head>
<body>
  <h2>Readers Alliance - Membership List</h2>
  <a href="export.php" class="btn">Download CSV</a>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Membership</th>
      <th>Location</th>
      <th>Message</th>
      <th>Date</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= htmlspecialchars($row['name']); ?></td>
        <td><?= htmlspecialchars($row['email']); ?></td>
        <td><?= htmlspecialchars($row['membership_type']); ?></td>
        <td><?= htmlspecialchars($row['location']); ?></td>
        <td><?= nl2br(htmlspecialchars($row['message'])); ?></td>
        <td><?= $row['created_at']; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>