<?php
function addIf(string $text): string {
    return str_starts_with($text, "if") ? $text : "if " . $text;
}

echo addIf("if else") . "<br>";
echo addIf("else") . "<br>";
echo addIf("if");
?>