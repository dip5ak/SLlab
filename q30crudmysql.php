<?php
$host = "localhost";
$username = "root";
$password = "";

try {
    // Connect to MySQL without selecting a database first
    $pdo = new PDO(
        "mysql:host=$host;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS php_lab");
    $pdo->exec("USE php_lab");
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS records (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            `rank` VARCHAR(50) NOT NULL,
            status VARCHAR(30) NOT NULL,
            image VARCHAR(255),
            created_by VARCHAR(100) NOT NULL,
            updated_by VARCHAR(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ON UPDATE CURRENT_TIMESTAMP
        )
    ");
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $action = $_POST["action"] ?? "";
        if ($action === "add") {

            $stmt = $pdo->prepare("
                INSERT INTO records
                (name, `rank`, status, image, created_by)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $_POST["name"],
                $_POST["rank"],
                $_POST["status"],
                $_POST["image"],
                "admin"
            ]);
        }
        elseif ($action === "update") {

            $stmt = $pdo->prepare("
                UPDATE records
                SET name=?,
                    `rank`=?,
                    status=?,
                    image=?,
                    updated_by=?
                WHERE id=?
            ");

            $stmt->execute([
                $_POST["name"],
                $_POST["rank"],
                $_POST["status"],
                $_POST["image"],
                "admin",
                $_POST["id"]
            ]);
        }
        elseif ($action === "delete") {

            $stmt = $pdo->prepare("
                DELETE FROM records
                WHERE id=?
            ");

            $stmt->execute([
                $_POST["id"]
            ]);
        }
    }

    $records = $pdo->query("
        SELECT *
        FROM records
        ORDER BY id DESC
    ")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    die("Database Error: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Records CRUD</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input {
            padding: 6px;
            margin: 5px;
        }

        button {
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h2>Records CRUD</h2>

    <form method="post">

        <input type="hidden" name="action" value="add">

        Name:
        <input type="text" name="name" required>

        Rank:
        <input type="text" name="rank" required>

        Status:
        <input type="text" name="status" required>

        Image:
        <input type="text" name="image">

        <button type="submit">Add</button>

    </form>

    <table>

        <tr>

            <?php
            $fields = [
                "id",
                "name",
                "rank",
                "status",
                "image",
                "created_by",
                "updated_by",
                "created_at",
                "updated_at"
            ];
            ?>

            <?php foreach ($fields as $heading): ?>

                <th>
                    <?= htmlspecialchars($heading) ?>
                </th>

            <?php endforeach; ?>

            <th>Delete</th>

        </tr>

        <?php foreach ($records as $record): ?>

            <tr>

                <?php foreach ($fields as $field): ?>

                    <td>
                        <?= htmlspecialchars((string)$record[$field]) ?>
                    </td>

                <?php endforeach; ?>
                <td>

                    <form method="post">

                        <input
                            type="hidden"
                            name="action"
                            value="delete"
                        >

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $record["id"] ?>"
                        >

                        <button type="submit">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>
