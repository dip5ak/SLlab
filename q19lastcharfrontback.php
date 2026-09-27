<?php
function lastCharFrontBack(string $text): string {
    if ($text === "") {
        return $text;
    }

    $last = substr($text, -1);
    return $last . $text . $last;
}

echo lastCharFrontBack("Red") . "<br>";
echo lastCharFrontBack("Green") . "<br>";
echo lastCharFrontBack("1");
?>