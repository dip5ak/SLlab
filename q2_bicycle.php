<?php
class Bicycle {
    public $brand;
    public $model;
    public $year;
    public $description = "Used bicycle";
    public $weight; // stored in grams

    public function getInfo() {
        return "{$this->brand} {$this->model} ({$this->year})";
    }

    public function getWeight($inKg = false) {
        return $inKg ? $this->weight / 1000 : $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }
}

$bike1 = new Bicycle();
$bike1->brand = "Giant";
$bike1->model = "Escape 3";
$bike1->year = 2023;
$bike1->description = "Used bicycle";
$bike1->setWeight(12000);

$bike2 = new Bicycle();
$bike2->brand = "Trek";
$bike2->model = "Marlin 5";
$bike2->year = 2024;
$bike2->description = "Mountain bicycle";
$bike2->setWeight(14000);

foreach ([$bike1, $bike2] as $bike) {
    echo "Bike: " . $bike->getInfo() . "<br>";
    echo "Description: " . $bike->description . "<br>";
    echo "Weight in kilograms: " . $bike->getWeight(true) . " kg<br>";
    echo "Weight in grams: " . $bike->getWeight() . " g<br><hr>";
}
?>