<?php
header("Content-Type: text/plain");

$validUser = "admin";
$validPassword = "Admin@123";

$userid = $_POST["userid"] ?? "";
$password = $_POST["password"] ?? "";

if ($userid === $validUser && $password === $validPassword) {
    echo "success";
} else {
    echo "failed";
}
?>