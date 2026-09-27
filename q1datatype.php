<?php
// Q1: Different PHP datatypes
$name = "Nabin";
$age = 20;
$marks = 85.5;
$isStudent = true;
$subjects = ["PHP", "DBMS", "Java"];
$nothing = null;

echo "<h2>PHP Datatypes</h2>";
echo "Using echo:<br>";
echo "Name: $name<br>";
echo "Age: $age<br>";
echo "Marks: $marks<br>";
echo "Student: " . ($isStudent ? "true" : "false") . "<br>";

print "Using print: $name<br>";

echo "<h3>Array using print_r()</h3>";
echo "<pre>";
print_r($subjects);
echo "</pre>";

echo "<h3>Array using var_dump()</h3>";
echo "<pre>";
var_dump($subjects);
echo "</pre>";

echo "<h3>Datatype Checking</h3>";
var_dump(is_string($name));
var_dump(is_int($age));
var_dump(is_float($marks));
var_dump(is_bool($isStudent));
var_dump(is_array($subjects));
var_dump(is_null($nothing));
?>