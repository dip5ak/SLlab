<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filename = basename(trim($_POST["filename"] ?? ""));
    $operation = $_POST["operation"] ?? "";
    $text = $_POST["text"] ?? "";
    $newFilename = basename(trim($_POST["new_filename"] ?? ""));

    if ($filename === "") {
        $message = "Filename is required.";
    } else {
        $filePath = __DIR__ . "/" . $filename;

        switch ($operation) {
            case "check":
                $message = file_exists($filePath) ? "File exists." : "File does not exist.";
                break;

            case "open":
                $handle = fopen($filePath, "a+");
                $message = $handle ? "File opened successfully." : "Unable to open file.";
                if ($handle) fclose($handle);
                break;

            case "write":
                $handle = fopen($filePath, "w");
                if ($handle) {
                    fwrite($handle, $text);
                    fclose($handle);
                    $message = "File written successfully.";
                } else {
                    $message = "Unable to write file.";
                }
                break;

            case "read":
                if (file_exists($filePath)) {
                    $handle = fopen($filePath, "r");
                    $message = fread($handle, filesize($filePath));
                    fclose($handle);
                } else {
                    $message = "File does not exist.";
                }
                break;

            case "close":
                // A file opened in a previous HTTP request cannot remain open.
                $message = "Any handle opened during this request is closed after use.";
                break;

            case "rename":
                $newPath = __DIR__ . "/" . $newFilename;
                if ($newFilename !== "" && file_exists($filePath)) {
                    $message = rename($filePath, $newPath) ? "File renamed successfully." : "Rename failed.";
                } else {
                    $message = "Existing file and new filename are required.";
                }
                break;

            case "permissions":
                if (file_exists($filePath)) {
                    $message = "Permissions (octal): " . substr(sprintf("%o", fileperms($filePath)), -4);
                } else {
                    $message = "File does not exist.";
                }
                break;

            case "chmod":
                if (file_exists($filePath)) {
                    $message = chmod($filePath, 0644)
                        ? "Permissions changed. New permissions: " . substr(sprintf("%o", fileperms($filePath)), -4)
                        : "Unable to change permissions.";
                } else {
                    $message = "File does not exist.";
                }
                break;

            default:
                $message = "Select an operation.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>File Handling Operations</h2>
<form method="post">
    Filename: <input type="text" name="filename" placeholder="example.txt" required><br><br>
    Operation:
    <select name="operation" required>
        <option value="check">Check File</option>
        <option value="open">Open File</option>
        <option value="write">Write File</option>
        <option value="read">Read File</option>
        <option value="close">Close File</option>
        <option value="rename">Rename File</option>
        <option value="permissions">Check Permissions</option>
        <option value="chmod">Change Permissions</option>
    </select><br><br>
    Text for write:<br>
    <textarea name="text"></textarea><br><br>
    New filename for rename: <input type="text" name="new_filename"><br><br>
    <button>Perform Operation</button>
</form>
<hr>
<pre><?= htmlspecialchars($message) ?></pre>
</body>
</html>