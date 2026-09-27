<?php
function lastThreeUpper(string $text): string {
    $length = strlen($text);

    if ($length <= 3) {
        return strtoupper($text);
    }

    return substr($text, 0, $length - 3) . strtoupper(substr($text, -3));
}

echo lastThreeUpper("Nepal") . "<br>";
echo lastThreeUpper("Npl") . "<br>";
echo lastThreeUpper("Bca") . "<br>";
echo lastThreeUpper("Bachelor");
?>