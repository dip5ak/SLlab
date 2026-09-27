<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["cv"])) {
    $file = $_FILES["cv"];
    $allowed = ["pdf", "doc", "docx"];
    $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if ($file["error"] !== UPLOAD_ERR_OK) {
        $message = "File upload failed.";
    } elseif (!in_array($extension, $allowed, true)) {
        $message = "Only PDF and DOC/DOCX files are allowed.";
    } elseif ($file["size"] >= 1024 * 1024) {
        $message = "File size must be less than 1 MB.";
    } else {
        $uploadDir = __DIR__ . "/uploads/cv/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $safeName = uniqid("cv_", true) . "." . $extension;
        move_uploaded_file($file["tmp_name"], $uploadDir . $safeName);
        $message = "CV uploaded successfully.";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Upload CV</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="cv" accept=".pdf,.doc,.docx" required>
    <button type="submit">Upload</button>
</form>
<p><?= htmlspecialchars($message) ?></p>
</body>
</html>