<?php
$host = "localhost";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("
        CREATE DATABASE IF NOT EXISTS college
    ");

    $pdo->exec("
        USE college
    ");
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS courses (

            id INT AUTO_INCREMENT PRIMARY KEY,

            title VARCHAR(100) NOT NULL,

            duration VARCHAR(50) NOT NULL,

            status VARCHAR(30) NOT NULL,

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ON UPDATE CURRENT_TIMESTAMP
        )
    ");
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS students (

            id INT AUTO_INCREMENT PRIMARY KEY,

            name VARCHAR(100) NOT NULL,

            course_id INT NOT NULL,

            fee DECIMAL(10,2) NOT NULL,

            rollno VARCHAR(30) NOT NULL,

            phone VARCHAR(20) NOT NULL,

            address VARCHAR(200) NOT NULL,

            dob DATE NOT NULL,

            status VARCHAR(30) NOT NULL,

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ON UPDATE CURRENT_TIMESTAMP,

            FOREIGN KEY (course_id)
                REFERENCES courses(id)
        )
    ");
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $action = $_POST["action"] ?? "";
        if ($action === "add_course") {

            $stmt = $pdo->prepare("
                INSERT INTO courses
                (title, duration, status)
                VALUES (?, ?, ?)
            ");

            $stmt->execute([
                $_POST["title"],
                $_POST["duration"],
                $_POST["status"]
            ]);
        }
        elseif ($action === "add_student") {

            $stmt = $pdo->prepare("
                INSERT INTO students
                (
                    name,
                    course_id,
                    fee,
                    rollno,
                    phone,
                    address,
                    dob,
                    status
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->execute([

                $_POST["name"],

                $_POST["course_id"],

                $_POST["fee"],

                $_POST["rollno"],

                $_POST["phone"],

                $_POST["address"],

                $_POST["dob"],

                $_POST["status"]

            ]);
        }
        elseif ($action === "delete_course") {

            $stmt = $pdo->prepare("
                DELETE FROM courses
                WHERE id = ?
            ");

            $stmt->execute([
                $_POST["id"]
            ]);
        }

        elseif ($action === "delete_student") {

            $stmt = $pdo->prepare("
                DELETE FROM students
                WHERE id = ?
            ");

            $stmt->execute([
                $_POST["id"]
            ]);
        }
    }
    $courses = $pdo->query("
        SELECT *
        FROM courses
        ORDER BY id DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
    $students = $pdo->query("

        SELECT
            s.*,
            c.title AS course_title

        FROM students s

        JOIN courses c
            ON s.course_id = c.id

        ORDER BY s.id DESC

    ")->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {

    die("Database Error: " . $e->getMessage());

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>College Management System</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h2 {
            margin-top: 30px;
        }

        form {
            margin-bottom: 20px;
        }

        input,
        select {
            padding: 6px;
            margin: 5px;
        }

        button {
            padding: 6px 12px;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
            margin-bottom: 30px;
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

    </style>

</head>


<body>

<h2>Courses CRUD</h2>


<!-- Add Course Form -->

<form method="post">

    <input
        type="hidden"
        name="action"
        value="add_course"
    >

    Title:

    <input
        type="text"
        name="title"
        required
    >


    Duration:

    <input
        type="text"
        name="duration"
        required
    >


    Status:

    <input
        type="text"
        name="status"
        required
    >


    <button type="submit">
        Add Course
    </button>

</form>


<!-- Courses Table -->

<table>

    <tr>

        <th>ID</th>

        <th>Title</th>

        <th>Duration</th>

        <th>Status</th>

        <th>Delete</th>

    </tr>


    <?php foreach ($courses as $course): ?>

    <tr>

        <td>
            <?= $course["id"] ?>
        </td>


        <td>
            <?= htmlspecialchars($course["title"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($course["duration"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($course["status"]) ?>
        </td>


        <td>

            <form method="post">

                <input
                    type="hidden"
                    name="action"
                    value="delete_course"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?= $course["id"] ?>"
                >

                <button type="submit">
                    Delete
                </button>

            </form>

        </td>

    </tr>

    <?php endforeach; ?>

</table>
<h2>Students CRUD</h2>
<form method="post">

    <input
        type="hidden"
        name="action"
        value="add_student"
    >


    Name:

    <input
        type="text"
        name="name"
        required
    >


    Course:

    <select
        name="course_id"
        required
    >

        <option value="">
            Select Course
        </option>


        <?php foreach ($courses as $course): ?>

            <option
                value="<?= $course["id"] ?>"
            >

                <?= htmlspecialchars($course["title"]) ?>

            </option>

        <?php endforeach; ?>

    </select>


    Fee:

    <input
        type="number"
        step="1.00"
        name="fee"
        required
    >


    Roll No:

    <input
        type="text"
        name="rollno"
        required
    >


    Phone:

    <input
        type="text"
        name="phone"
        required
    >


    Address:

    <input
        type="text"
        name="address"
        required
    >


    DOB:

    <input
        type="date"
        name="dob"
        required
    >


    Status:

    <input
        type="text"
        name="status"
        required
    >


    <button type="submit">
        Add Student
    </button>

</form>

<table>

    <tr>

        <th>ID</th>

        <th>Name</th>

        <th>Course</th>

        <th>Fee</th>

        <th>Roll No</th>

        <th>Phone</th>

        <th>Address</th>

        <th>DOB</th>

        <th>Status</th>

        <th>Delete</th>

    </tr>


    <?php foreach ($students as $student): ?>

    <tr>

        <td>
            <?= $student["id"] ?>
        </td>


        <td>
            <?= htmlspecialchars($student["name"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($student["course_title"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($student["fee"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($student["rollno"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($student["phone"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($student["address"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($student["dob"]) ?>
        </td>


        <td>
            <?= htmlspecialchars($student["status"]) ?>
        </td>


        <td>

            <form method="post">

                <input
                    type="hidden"
                    name="action"
                    value="delete_student"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?= $student["id"] ?>"
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

