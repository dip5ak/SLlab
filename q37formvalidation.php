<?php
$errors = [];
$success = "";
$data = [
    "name" => "", "address" => "", "username" => "", "email" => "",
    "website" => "", "phone" => "", "gender" => "", "course" => ""
];

$courses = ["BCA", "BIM", "BBS", "BSc CSIT"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($data as $key => $_) {
        $data[$key] = trim($_POST[$key] ?? "");
    }

    $password = $_POST["password"] ?? "";

    if ($data["name"] === "" || !preg_match("/^[A-Za-z ]+$/", $data["name"])) {
        $errors[] = "Name must contain only alphabetic characters and spaces.";
    }

    if ($data["address"] === "") {
        $errors[] = "Address is required.";
    }

    if ($data["username"] === "" || !preg_match("/^[A-Za-z0-9_]+$/", $data["username"])) {
        $errors[] = "Username can contain only letters, numbers, and underscores.";
    }

    if ($data["email"] === "" || !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter a valid email address.";
    }

    if ($password === "" ||
        strlen($password) < 8 ||
        !preg_match("/[A-Z]/", $password) ||
        !preg_match("/[a-z]/", $password) ||
        !preg_match("/\d/", $password) ||
        !preg_match("/[^A-Za-z0-9]/", $password)) {
        $errors[] = "Password must be at least 8 characters and contain uppercase, lowercase, digit, and special character.";
    }

    if ($data["website"] === "" || !filter_var($data["website"], FILTER_VALIDATE_URL)) {
        $errors[] = "Enter a valid website URL.";
    }

    if ($data["phone"] === "" || !preg_match("/^(96|97|98)\d{8}$/", $data["phone"])) {
        $errors[] = "Phone must contain 10 digits and start with 96, 97, or 98.";
    }

    if (!in_array($data["gender"], ["male", "female", "other"], true)) {
        $errors[] = "Select a valid gender.";
    }

    if (!in_array($data["course"], $courses, true)) {
        $errors[] = "Select a valid course.";
    }

    if (!$errors) {
        $success = "Form submitted and validated successfully.";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Complete Registration Form</h2>
<form method="post">
    Name: <input type="text" name="name" value="<?= htmlspecialchars($data["name"]) ?>" required><br><br>
    Address: <input type="text" name="address" value="<?= htmlspecialchars($data["address"]) ?>" required><br><br>
    Username: <input type="text" name="username" value="<?= htmlspecialchars($data["username"]) ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($data["email"]) ?>" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Website: <input type="url" name="website" value="<?= htmlspecialchars($data["website"]) ?>" placeholder="https://example.com" required><br><br>
    Phone: <input type="text" name="phone" value="<?= htmlspecialchars($data["phone"]) ?>" required><br><br>

    Gender:
    <select name="gender" required>
        <option value="">Select</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select><br><br>

    Course:
    <select name="course" required>
        <option value="">Select</option>
        <?php foreach ($courses as $course): ?>
            <option value="<?= htmlspecialchars($course) ?>"><?= htmlspecialchars($course) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button>Submit</button>
</form>

<?php foreach ($errors as $error): ?>
<p><?= htmlspecialchars($error) ?></p>
<?php endforeach; ?>

<p><?= htmlspecialchars($success) ?></p>
</body>
</html>