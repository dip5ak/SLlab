<?php
function recursiveLength(string $text): int {
    if ($text === "") {
        return 0;
    }
    return 1 + recursiveLength(substr($text, 1));
}

$text = "Hello";
echo "Length of '$text' = " . recursiveLength($text);
?>