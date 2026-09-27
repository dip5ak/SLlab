<?php
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $dob = trim($_POST["dob"] ?? "");
    $phone = trim($_POST["phone"] ?? "");

    if (strlen($username) < 8) {
        $errors[] = "Username must contain at least 8 characters.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter a valid email address.";
    }

    $date = DateTime::createFromFormat("Y-m-d", $dob);
    if (!$date || $date->format("Y-m-d") !== $dob || $date > new DateTime("today")) {
        $errors[] = "Enter a valid date of birth.";
    }

    if (!preg_match("/^\d{10}$/", $phone)) {
        $errors[] = "Phone must contain exactly 10 digits.";
    }

    if (!$errors) {
        $success = "User validated successfully.";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>User Registration Validation</h2>
<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Date of Birth: <input type="date" name="dob" required><br><br>
    Phone: <input type="text" name="phone" required><br><br>
    <button type="submit">Register</button>
</form>

<?php foreach ($errors as $error): ?>
<p><?= htmlspecialchars($error) ?></p>
<?php endforeach; ?>

<p><?= htmlspecialchars($success) ?></p>
</body>
</html>