<?php
$subjects = ["PHP", "DBMS", "Java", "Web Technology", "Math"];
$marks = [];
$error = "";
$total = 0;
$percentage = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($subjects as $subject) {
        $key = strtolower(str_replace(" ", "_", $subject));
        $value = filter_input(INPUT_POST, $key, FILTER_VALIDATE_INT);
        if ($value === false || $value === null || $value < 0 || $value > 100) {
            $error = "Each mark must be an integer from 0 to 100.";
            break;
        }
        $marks[$subject] = $value;
    }

    if ($error === "") {
        $total = array_sum($marks);
        $percentage = $total / count($subjects);
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Student Mark Sheet</h2>
<form method="post">
<?php foreach ($subjects as $subject):
    $key = strtolower(str_replace(" ", "_", $subject)); ?>
    <?= htmlspecialchars($subject) ?>:
    <input type="number" name="<?= $key ?>" min="0" max="100" required><br><br>
<?php endforeach; ?>
<button type="submit">Generate Mark Sheet</button>
</form>

<p><?= htmlspecialchars($error) ?></p>

<?php if (!$error && $marks): ?>
<table border="1" cellpadding="8">
<tr><th>Subject</th><th>Marks</th></tr>
<?php foreach ($marks as $subject => $mark): ?>
<tr><td><?= htmlspecialchars($subject) ?></td><td><?= $mark ?></td></tr>
<?php endforeach; ?>
<tr><th>Total</th><th><?= $total ?></th></tr>
<tr><th>Percentage</th><th><?= number_format($percentage, 2) ?>%</th></tr>
</table>
<?php endif; ?>
</body>
</html>