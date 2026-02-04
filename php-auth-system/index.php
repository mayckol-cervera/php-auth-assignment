<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

<h1>Simple PHP Auth System</h1>

<?php if (isset($_SESSION['user_id'])): ?>
    <p>You are logged in.</p>
    <a href="dashboard.php">Go to Dashboard</a><br>
    <a href="logout.php">Logout</a>
<?php else: ?>
    <a href="register.php">Register</a><br>
    <a href="login.php">Login</a>
<?php endif; ?>

</body>
</html>
