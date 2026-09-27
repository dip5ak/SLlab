<?php
function sameLength(string $first, string $second): bool {
    return strlen($first) === strlen($second);
}

var_dump(sameLength("Hello", "World"));
?>