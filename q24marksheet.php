<?php

// ---- Student data stored in a PHP multidimensional array ----
$students = [
    ["sn" => 1, "name" => "Rajesh", "roll" => 25, "webtech2" => 56, "dbms" => 89, "economics" => 57, "dsa" => 64, "account" => 98],
    ["sn" => 2, "name" => "hari",   "roll" => 5,  "webtech2" => 56, "dbms" => 89, "economics" => 57, "dsa" => 64, "account" => 98],
    ["sn" => 3, "name" => "Shyam",  "roll" => 6,  "webtech2" => 54, "dbms" => 79, "economics" => 57, "dsa" => 69, "account" => 98],
    ["sn" => 4, "name" => "Rita",   "roll" => 10, "webtech2" => 16, "dbms" => 89, "economics" => 56, "dsa" => 64, "account" => 98],
    ["sn" => 5, "name" => "Gita",   "roll" => 4,  "webtech2" => 56, "dbms" => 89, "economics" => 57, "dsa" => 69, "account" => 98],
    ["sn" => 6, "name" => "Sita",   "roll" => 24, "webtech2" => 56, "dbms" => 99, "economics" => 57, "dsa" => 24, "account" => 98],
    ["sn" => 7, "name" => "Sita",   "roll" => 24, "webtech2" => 56, "dbms" => 99, "economics" => 57, "dsa" => 24, "account" => 98],
    ["sn" => 8, "name" => "Sita",   "roll" => 24, "webtech2" => 56, "dbms" => 99, "economics" => 57, "dsa" => 24, "account" => 98],
];

$passMark = 40; // minimum marks needed in EACH subject to pass

// ---- Calculate Total and Result for every student ----
foreach ($students as &$row) {
    $row["total"] = $row["webtech2"] + $row["dbms"] + $row["economics"] + $row["dsa"] + $row["account"];

    $row["result"] = ($row["webtech2"]   >= $passMark &&
                       $row["dbms"]      >= $passMark &&
                       $row["economics"] >= $passMark &&
                       $row["dsa"]       >= $passMark &&
                       $row["account"]   >= $passMark) ? "pass" : "fail";
}
unset($row);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Mark Sheet</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 95%; margin: 20px auto; }
        th, td { border: 1px solid #333; padding: 8px 12px; text-align: center; }
        th { background: #ddd; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>Mark Ledger</h2>
<table>
    <tr>
        <th>SN</th><th>Name</th><th>Roll</th><th>Web Tech II</th><th>DBMS</th>
        <th>Economics</th><th>DSA</th><th>Account</th><th>Total</th><th>Result</th>
    </tr>
    <?php foreach ($students as $row): ?>
        <?php $bg = ($row["result"] == "pass") ? "#2ecc71" : "#e74c3c"; ?>
        <tr style="background-color: <?= $bg ?>;">
            <td><?= $row["sn"] ?></td>
            <td style="text-align:left;"><?= $row["name"] ?></td>
            <td><?= $row["roll"] ?></td>
            <td><?= $row["webtech2"] ?></td>
            <td><?= $row["dbms"] ?></td>
            <td><?= $row["economics"] ?></td>
            <td><?= $row["dsa"] ?></td>
            <td><?= $row["account"] ?></td>
            <td><?= $row["total"] ?></td>
            <td><?= $row["result"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Alternate Color</h2>
<table>
    <tr>
        <th>SN</th><th>Name</th><th>Roll</th><th>Web Tech II</th><th>DBMS</th>
        <th>Economics</th><th>DSA</th><th>Account</th><th>Total</th><th>Result</th>
    </tr>
    <?php foreach ($students as $i => $row): ?>
        <?php
            $rowBg   = ($i % 2 == 0) ? "#1c1c1c" : "#aaaaaa";
            $rowText = ($i % 2 == 0) ? "#ffffff" : "#000000";
            $resBg   = ($row["result"] == "pass") ? "#2ecc71" : "#e74c3c";
        ?>
        <tr style="background-color: <?= $rowBg ?>; color: <?= $rowText ?>;">
            <td><?= $row["sn"] ?></td>
            <td style="text-align:left;"><?= $row["name"] ?></td>
            <td><?= $row["roll"] ?></td>
            <td><?= $row["webtech2"] ?></td>
            <td><?= $row["dbms"] ?></td>
            <td><?= $row["economics"] ?></td>
            <td><?= $row["dsa"] ?></td>
            <td><?= $row["account"] ?></td>
            <td><?= $row["total"] ?></td>
            <td style="background-color: <?= $resBg ?>; color:#fff; font-weight:bold;"><?= $row["result"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>