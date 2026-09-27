<?php
$info = [
    "name" => "Ram Bahadur",
    "address" => "Lalitpur",
    "email" => "info@ram.com",
    "phone" => 98454545,
    "website" => "www.ram.com"
];
?>
<!DOCTYPE html>
<html>
<body>
<h2>Information</h2>
<table border="1" cellpadding="8">
<?php foreach ($info as $key => $value): ?>
<tr>
    <th><?= htmlspecialchars(ucfirst($key)) ?></th>
    <td><?= htmlspecialchars((string)$value) ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>