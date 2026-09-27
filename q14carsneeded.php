<?php
function carsNeeded(int $people): int {
    if ($people <= 0) {
        return 0;
    }
    return (int)ceil($people / 5);
}

$people = 13;
echo "Cars needed for $people people = " . carsNeeded($people);
?>