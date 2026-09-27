<?php
class User {
    protected $name;
    protected $surname;
    protected $username;
    protected $is_admin = false;

    public function __construct($name, $surname, $username) {
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
    }

    public function isAdmin() {
        return $this->is_admin;
    }

    public function fullName() {
        $suffix = $this->is_admin ? " (admin)" : "";
        return $this->name . " " . $this->surname . $suffix;
    }
}

class Customer extends User {
    private $city;
    private $state;
    private $country;

    public function __construct($name, $surname, $username) {
        parent::__construct($name, $surname, $username);
    }

    public function setCity($city) { $this->city = $city; }
    public function getCity() { return $this->city; }

    public function setState($state) { $this->state = $state; }
    public function getState() { return $this->state; }

    public function setCountry($country) { $this->country = $country; }
    public function getCountry() { return $this->country; }

    public function location() {
        return "{$this->city}, {$this->state}, {$this->country}";
    }
}

class AdminUser extends User {
    public function __construct($name, $surname, $username) {
        parent::__construct($name, $surname, $username);
        $this->is_admin = true;
    }
}

$user = new User("Dipak", "Shrestha", "dipak10");

$customer = new Customer("Ram", "Sharma", "ram01");
$customer->setCity("Kathmandu");
$customer->setState("Bagmati");
$customer->setCountry("Nepal");

$admin = new AdminUser("Admin", "User", "admin01");

echo "User: " . $user->fullName() . " | is_admin: " . ($user->isAdmin() ? "true" : "false") . "<br>";
echo "Customer: " . $customer->fullName() . " | is_admin: " . ($customer->isAdmin() ? "true" : "false") . "<br>";
echo "Location: " . $customer->location() . "<br>";
echo "Admin: " . $admin->fullName() . " | is_admin: " . ($admin->isAdmin() ? "true" : "false") . "<br>";
?>