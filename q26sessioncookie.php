<?php
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");

    if ($username === "") {
        $message = "Username is required.";
    } else {
        $_SESSION["username"] = $username;
        setcookie("username", $username, time() + 3600, "/");
        $message = "Session and cookie created.";
    }
}

$cookieValue = $_COOKIE["username"] ?? "Cookie not set";
$sessionValue = $_SESSION["username"] ?? "Session not set";
?>
<!DOCTYPE html>
<html>
<body>
<h2>Session and Cookie</h2>
<form method="post">
    Username: <input type="text" name="username" required>
    <button type="submit">Login</button>
</form>
<p>Session username: <?= htmlspecialchars($sessionValue) ?></p>
<p>Cookie username: <?= htmlspecialchars($cookieValue) ?></p>
</body>
</html>