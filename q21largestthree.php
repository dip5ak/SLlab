<?php
function largestOfThree(int $a, int $b, int $c): int {
    return max($a, $b, $c);
}

echo "Largest = " . largestOfThree(25, 48, 31);
?>