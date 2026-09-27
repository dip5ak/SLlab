<?php
function calculateArea(float $base, float $height, string $shape): ?float {
    if ($shape === "triangle") {
        return ($base * $height) / 2;
    }

    if ($shape === "parallelogram") {
        return $base * $height;
    }

    return null;
}

echo "Triangle area = " . calculateArea(10, 6, "triangle") . "<br>";
echo "Parallelogram area = " . calculateArea(10, 6, "parallelogram");
?>