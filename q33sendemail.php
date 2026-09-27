<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $to = filter_var($_POST["email"] ?? "", FILTER_VALIDATE_EMAIL);
    $subject = trim($_POST["subject"] ?? "");
    $body = trim($_POST["message"] ?? "");

    if (!$to || $subject === "" || $body === "") {
        $message = "Please provide a valid email, subject, and message.";
    } else {
        $headers = "From: noreply@example.com\r\n";
        if (mail($to, $subject, $body, $headers)) {
            $message = "Email notification sent.";
        } else {
            $message = "Email could not be sent. Configure the mail server first.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Send Email Notification</h2>
<form method="post">
    Email: <input type="email" name="email" required><br><br>
    Subject: <input type="text" name="subject" required><br><br>
    Message:<br>
    <textarea name="message" required></textarea><br><br>
    <button>Send</button>
</form>
<p><?= htmlspecialchars($message) ?></p>
</body>
</html>