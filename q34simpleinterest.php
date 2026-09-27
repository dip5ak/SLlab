 <?php
$principal = $rate = $time = "";
$result = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $principal = filter_input(INPUT_POST, "principal", FILTER_VALIDATE_FLOAT);
    $rate = filter_input(INPUT_POST, "rate", FILTER_VALIDATE_FLOAT);
    $time = filter_input(INPUT_POST, "time", FILTER_VALIDATE_FLOAT);

    if ($principal === false || $rate === false || $time === false ||
        $principal === null || $rate === null || $time === null ||
        $principal < 0 || $rate < 0 || $time < 0) {
        $result = "Enter valid non-negative values.";
    } else {
        $si = ($principal * $rate * $time) / 100;
        $amount = $principal + $si;
        $result = "Simple Interest = " . number_format($si, 2) .
                  "<br>Total Amount = " . number_format($amount, 2);
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Simple Interest</h2>
<form method="post">
    Principal: <input type="number" name="principal" step="any" min="0" required><br><br>
    Rate (%): <input type="number" name="rate" step="any" min="0" required><br><br>
    Time (years): <input type="number" name="time" step="any" min="0" required><br><br>
    <button>Calculate</button>
</form>
<p><?= $result ?></p>
</body>
</html>