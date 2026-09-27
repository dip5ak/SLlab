<?php
function footballPoints(int $wins, int $draws, int $losses): array {
    $games = $wins + $draws + $losses;
    $points = ($wins * 3) + ($draws * 1);
    return [$games, $points];
}

$wins = $draws = $losses = "";
$result = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $wins = filter_input(INPUT_POST, "wins", FILTER_VALIDATE_INT);
    $draws = filter_input(INPUT_POST, "draws", FILTER_VALIDATE_INT);
    $losses = filter_input(INPUT_POST, "losses", FILTER_VALIDATE_INT);

    if ($wins === false || $draws === false || $losses === false ||
        $wins === null || $draws === null || $losses === null ||
        $wins < 0 || $draws < 0 || $losses < 0) {
        $result = "Wins, draws, and losses must be non-negative integers.";
    } else {
        [$games, $points] = footballPoints($wins, $draws, $losses);
        $result = "Total games played: $games<br>Total points obtained: $points";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Football Team Points</h2>
<form method="post">
    Wins: <input type="number" name="wins" min="0" required><br><br>
    Draws: <input type="number" name="draws" min="0" required><br><br>
    Losses: <input type="number" name="losses" min="0" required><br><br>
    <button type="submit">Calculate</button>
</form>
<p><?= $result ?></p>
</body>
</html>