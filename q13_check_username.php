<?php

header("Content-Type: text/plain");
$host = "localhost";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS lab3";

if (!$conn->query($sql)) {
    die("Database creation failed: " . $conn->error);
}
if (!$conn->select_db("lab3")) {
    die("Database selection failed: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if (!$conn->query($sql)) {
    die("Table creation failed: " . $conn->error);
}
$stmt = $conn->prepare(
    "INSERT IGNORE INTO users (username, password)
     VALUES (?, ?)"
);

$username1 = "nabin01";
$password1 = "demo123";

$stmt->bind_param("ss", $username1, $password1);
$stmt->execute();

$username2 = "admin";
$password2 = "Admin@123";

$stmt->bind_param("ss", $username2, $password2);
$stmt->execute();

$stmt->close();
$username = $_GET["username"] ?? "";

if ($username == "") {
    echo "Database setup completed successfully.\n";
    echo "Usage: q_username_check.php?username=nabin01\n";
    echo "Example: q_username_check.php?username=test";
    exit;
}

$stmt = $conn->prepare(
    "SELECT id FROM users WHERE username = ? LIMIT 1"
);

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Username is not available.";
} else {
    echo "Username is available.";
}
$stmt->close();
$conn->close();
?>