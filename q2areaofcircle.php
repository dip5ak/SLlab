<?php
const PI_VALUE = 3.141592653589793;

$radius = "";
$result = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $radius = trim($_POST["radius"] ?? "");

    if ($radius === "" || !is_numeric($radius) || $radius < 0) {
        $result = "Please enter a valid non-negative radius.";
    } else {
        $area = PI_VALUE * $radius * $radius;
        $result = "Area of circle = " . number_format($area, 2);
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Area of Circle</h2>
<form method="post">
    Radius: <input type="number" name="radius" step="any" min="0"
                   value="<?= htmlspecialchars($radius) ?>" required>
    <button type="submit">Calculate</button>
</form>
<p><?= htmlspecialchars($result) ?></p>
</body>
</html>