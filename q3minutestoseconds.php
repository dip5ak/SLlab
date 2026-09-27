<?php
function minutesToSeconds(int $minutes): int {
    return $minutes * 60;
}

$minutes = 5;
echo "$minutes minutes = " . minutesToSeconds($minutes) . " seconds";
?>