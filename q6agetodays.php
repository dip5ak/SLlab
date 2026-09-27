<?php
function ageInDays(int $age): int {
    return $age * 365;
}

$age = 20;
echo "$age years = " . ageInDays($age) . " days";
?>