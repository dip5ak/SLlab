<?php
function specialSum(int $a, int $b): int {
    $sum = $a + $b;
    return ($a === $b) ? $sum * 3 : $sum;
}

echo specialSum(5, 5);
?>