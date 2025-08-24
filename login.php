<?php
session_start();

// Replace with your chosen login credentials
$admin_user = "csradmin";
$admin_pass = "securePassword123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION["loggedin"] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CSR Admin Login</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f0f0; }
    .login-box { max-width: 400px; margin: 100px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
    input { width: 100%; padding: 10px; margin: 10px 0; }
    button { background: #28a745; color: white; border: none; padding: 10px; width: 100%; border-radius: 5px; font-weight: bold; }
    button:hover { background: #218838; }
    .error { color: red; }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>CSR Admin Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>