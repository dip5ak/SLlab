<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["profile"])) {
    $file = $_FILES["profile"];
    $allowed = ["png", "jpg", "jpeg"];
    $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if ($file["error"] !== UPLOAD_ERR_OK) {
        $message = "Image upload failed.";
    } elseif (!in_array($extension, $allowed, true)) {
        $message = "Only PNG and JPEG/JPG images are allowed.";
    } elseif ($file["size"] >= 500 * 1024) {
        $message = "Image size must be less than 500 KB.";
    } elseif (@getimagesize($file["tmp_name"]) === false) {
        $message = "Invalid image file.";
    } else {
        $uploadDir = __DIR__ . "/uploads/profile/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $safeName = uniqid("profile_", true) . "." . $extension;
        move_uploaded_file($file["tmp_name"], $uploadDir . $safeName);
        $message = "Profile image uploaded successfully.";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Upload Profile Image</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="profile" accept=".png,.jpg,.jpeg" required>
    <button type="submit">Upload</button>
</form>
<p><?= htmlspecialchars($message) ?></p>
</body>
</html>