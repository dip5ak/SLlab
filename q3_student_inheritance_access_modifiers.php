<?php
class Student {
    public $name;
    public $surname;
    public $country;

    private $tuition = 50000;
    protected $indexNumber = "BCA001";

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function helloWorld() {
        return "Hello World";
    }

    protected function helloFamily() {
        return "Hello Family";
    }

    private function helloMe() {
        return "Hello me!";
    }

    private function getTuition() {
        echo "Tuition: " . $this->tuition . "<br>";
    }

    public function callPrivateMethods() {
        echo $this->helloMe() . "<br>";
        $this->getTuition();
    }

    public function callProtectedMethod() {
        echo $this->helloFamily() . "<br>";
    }

    public function showIndexNumber() {
        echo "Index Number: " . $this->indexNumber . "<br>";
    }
}

class PartTimeStudent extends Student {
    public function helloParent() {
        return $this->helloFamily();
    }
}

$student = new Student();
$student->name = "Dipak";
$student->surname = "Shrestha";
$student->country = "Nepal";

echo $student->getName() . " " . $student->getSurname() . "<br>";
echo $student->helloWorld() . "<br>";
$student->callProtectedMethod();
$student->callPrivateMethods();
$student->showIndexNumber();

echo "<hr>";

$partTime = new PartTimeStudent();
$partTime->name = "Ram";
$partTime->surname = "Sharma";
$partTime->country = "Nepal";

echo $partTime->getName() . " " . $partTime->getSurname() . "<br>";
echo $partTime->helloWorld() . "<br>";
echo $partTime->helloParent() . "<br>";
$partTime->callPrivateMethods();
$partTime->showIndexNumber();
?>