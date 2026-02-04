<?php
session_start();
require 'users.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user = User::findById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome, <?php echo $user->username; ?>!</h1>
<p>Email: <?php echo $user->email; ?></p>

<a href="logout.php">Logout</a>

</body>
</html>
