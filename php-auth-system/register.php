

<?php
require 'config.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    }

    // Username length check
    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters.";
    }

    // Email format validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Password length check
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    //Check if username or email already exists
    $stmt = $pdo->prepare(
        "SELECT id FROM users WHERE email = ? OR username = ?"
    );
    $stmt->execute([$email, $username]);

    if ($stmt->fetch()) {
        $errors[] = "Username or email already exists.";
    }

    // If no errors, insert user
    if (empty($errors)) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
        );
        $stmt->execute([$username, $email, $hashedPassword]);

        header("Location: login.php");
        exit;
    }
}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>User Registration</h2>

<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>

<form method="POST" action="">
    <input type="text" name="username" placeholder="Username"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Register</button>
</form>

</body>
</html>
