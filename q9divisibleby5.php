<?php
function divisibleBy5(int $number): bool {
    return $number % 5 === 0;
}

var_dump(divisibleBy5(25));
?>