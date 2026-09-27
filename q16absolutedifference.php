<?php
function differenceFrom51(int $n): int {
    $difference = abs($n - 51);
    return ($n > 51) ? $difference * 3 : $difference;
}

echo differenceFrom51(60);
?>