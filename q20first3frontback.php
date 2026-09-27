<?php
function firstThreeFrontBack(string $text): string {
    $firstThree = substr($text, 0, 3);
    return $firstThree . $text . $firstThree;
}

echo firstThreeFrontBack("Python") . "<br>";
echo firstThreeFrontBack("JS") . "<br>";
echo firstThreeFrontBack("Code");
?>