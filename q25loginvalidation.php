<?php
session_start();

$validUsername = "admin";
$validPasswordHash = password_hash("Admin@123", PASSWORD_DEFAULT);
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $message = "Username and password are required.";
    } elseif ($username === $validUsername && password_verify($password, $validPasswordHash)) {
        $_SESSION["username"] = $username;
        $message = "Login successful.";
    } else {
        $message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Login Form</h2>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
<p><?= htmlspecialchars($message) ?></p>
<p>Demo username: admin | password: Admin@123</p>
</body>
</html>