<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminUsername = 'shruti';
    $adminPassword = '2004';

    if ($_POST['username'] === $adminUsername && $_POST['password'] === $adminPassword) {
        $_SESSION['admin'] = $adminUsername;
        header("Location: admin_dashboard.php");
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Admin Login</h2>
        <form method="POST" action="admin_login.php">
            <input type="text" name="username" placeholder="Admin Username" required><br>
            <input type="password" name="password" placeholder="Admin Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
