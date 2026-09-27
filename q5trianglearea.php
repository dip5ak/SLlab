<?php
function triangleArea(float $base, float $height): float {
    return ($base * $height) / 2;
}

echo "Area of triangle = " . triangleArea(10, 8);
?>