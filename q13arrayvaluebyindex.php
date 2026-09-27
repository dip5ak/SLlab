<?php
function valueAtIndex(array $array, int $index): mixed {
    return $array[$index] ?? null;
}

$items = ["PHP", "Java", "Python"];
$index = 1;

echo valueAtIndex($items, $index);
?>