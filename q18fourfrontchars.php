<?php
function fourFrontChars(string $text): string {
    if (strlen($text) < 2) {
        return $text;
    }
    return str_repeat(substr($text, 0, 2), 4);
}

echo fourFrontChars("C Sharp") . "<br>";
echo fourFrontChars("JS") . "<br>";
echo fourFrontChars("a");
?>