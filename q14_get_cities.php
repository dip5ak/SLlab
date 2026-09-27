<?php
header("Content-Type: application/json");

$cities = [
    "Nepal" => ["Kathmandu", "Pokhara", "Lalitpur", "Biratnagar"],
    "India" => ["Delhi", "Mumbai", "Kolkata", "Bangalore"],
    "USA" => ["New York", "Los Angeles", "Chicago", "Houston"]
];

$country = $_GET["country"] ?? "";
echo json_encode($cities[$country] ?? []);
?>