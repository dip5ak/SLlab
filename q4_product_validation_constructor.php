<?php
class Product {
    private $description;
    private $quantity;
    private $price;

    public function __construct($description, $quantity, $price) {
        if (!is_string($description)) {
            echo "Error: Description must be a string.<br>";
            $description = "";
        }
        if (!is_numeric($quantity)) {
            echo "Error: Quantity must be a number.<br>";
            $quantity = 0;
        }
        if (!is_numeric($price)) {
            echo "Error: Price must be a number.<br>";
            $price = 0;
        }

        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getQuantity() { return $this->quantity; }
    public function setQuantity($quantity) { $this->quantity = $quantity; }

    public function getPrice() { return $this->price; }
    public function setPrice($price) { $this->price = $price; }

    public function calculatePrice() {
        return $this->quantity * $this->price;
    }
}

$product = new Product("Laptop", 2, 85000);

echo "Description: " . $product->getDescription() . "<br>";
echo "Quantity: " . $product->getQuantity() . "<br>";
echo "Price: Rs. " . $product->getPrice() . "<br>";
echo "Total Price: Rs. " . $product->calculatePrice() . "<br>";
?>