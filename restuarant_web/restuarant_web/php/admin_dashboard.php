<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'login_db');

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_GET['action'] == 'delete') {
        $conn->query("DELETE FROM users WHERE id=$id");
        header("Location: admin_dashboard.php");
    } elseif ($_GET['action'] == 'block') {
        $conn->query("UPDATE users SET status='blocked' WHERE id=$id");
        header("Location: admin_dashboard.php");
    } elseif ($_GET['action'] == 'unblock') {
        $conn->query("UPDATE users SET status='active' WHERE id=$id");
        header("Location: admin_dashboard.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Admin Dashboard</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a href="admin_dashboard.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete user?')">Delete</a> |
                        <?php if ($row['status'] == 'active') { ?>
                            <a href="admin_dashboard.php?action=block&id=<?php echo $row['id']; ?>">Block</a>
                        <?php } else { ?>
                            <a href="admin_dashboard.php?action=unblock&id=<?php echo $row['id']; ?>">Unblock</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a href="admin_logout.php">Logout</a>
    </div>
</body>
</html>
