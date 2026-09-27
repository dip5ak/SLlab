<?php
function findStringIndex(array $array, string $value): int|false {
    return array_search($value, $array, true);
}

$items = ["Apple", "Banana", "Mango", "Orange"];
$result = findStringIndex($items, "Mango");

echo $result === false ? "String not found" : "Index = $result";
?>