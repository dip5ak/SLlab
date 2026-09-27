<?php
$income = "";
$gender = "";
$slabs = [];
$totalTaxBeforeDiscount = 0;
$discount = 0;
$totalTax = 0;
$netIncome = 0;
$error = "";

function calculateTax(float $income): array {
    $slabs = [];
    $remaining = $income;

    $ranges = [
        [1000000, 0.01, "Up to NPR 1,000,000"],
        [500000, 0.10, "Next NPR 500,000 (1,000,001–1,500,000)"],
        [1000000, 0.20, "Next NPR 1,000,000 (1,500,001–2,500,000)"],
        [1500000, 0.27, "Next NPR 1,500,000 (2,500,001–4,000,000)"],
        [INF, 0.29, "Income above NPR 4,000,000"]
    ];

    foreach ($ranges as [$limit, $rate, $label]) {
        if ($remaining <= 0) break;

        $taxable = min($remaining, $limit);
        $tax = $taxable * $rate;
        $slabs[] = [
            "label" => $label,
            "taxable" => $taxable,
            "rate" => $rate,
            "tax" => $tax
        ];

        $totalTaxBeforeDiscount += $tax;
        $remaining -= $taxable;
    }

    return $slabs;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $income = filter_input(INPUT_POST, "income", FILTER_VALIDATE_FLOAT);
    $gender = $_POST["gender"] ?? "";

    if ($income === false || $income === null || $income < 0) {
        $error = "Enter a valid non-negative taxable income.";
    } elseif (!in_array($gender, ["male", "female"], true)) {
        $error = "Select a valid gender.";
    } else {
        $remaining = $income;
        $totalTaxBeforeDiscount = 0;
        $slabs = [];

        $ranges = [
            [1000000, 0.01, "Up to NPR 1,000,000"],
            [500000, 0.10, "Next NPR 500,000 (1,000,001–1,500,000)"],
            [1000000, 0.20, "Next NPR 1,000,000 (1,500,001–2,500,000)"],
            [1500000, 0.27, "Next NPR 1,500,000 (2,500,001–4,000,000)"],
            [INF, 0.29, "Income above NPR 4,000,000"]
        ];

        foreach ($ranges as [$limit, $rate, $label]) {
            if ($remaining <= 0) break;

            $taxable = min($remaining, $limit);
            $tax = $taxable * $rate;

            $slabs[] = [
                "label" => $label,
                "taxable" => $taxable,
                "rate" => $rate,
                "tax" => $tax
            ];

            $totalTaxBeforeDiscount += $tax;
            $remaining -= $taxable;
        }

        $discount = ($gender === "female") ? $totalTaxBeforeDiscount * 0.10 : 0;
        $totalTax = $totalTaxBeforeDiscount - $discount;
        $netIncome = $income - $totalTax;
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Nepal Income Tax Calculator FY 2083/84</h2>
<form method="post">
    Annual Taxable Income:
    <input type="number" name="income" min="0" step="0.01" required><br><br>

    Gender:
    <select name="gender" required>
        <option value="">Select</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br><br>

    <button>Calculate Tax</button>
</form>

<p><?= htmlspecialchars($error) ?></p>

<?php if ($slabs && $error === ""): ?>
<h3>Tax Details</h3>
<p>Annual taxable income: NPR <?= number_format($income, 2) ?></p>

<table border="1" cellpadding="8">
<tr><th>Tax Slab</th><th>Taxable Amount</th><th>Rate</th><th>Tax</th></tr>
<?php foreach ($slabs as $slab): ?>
<tr>
<td><?= htmlspecialchars($slab["label"]) ?></td>
<td>NPR <?= number_format($slab["taxable"], 2) ?></td>
<td><?= $slab["rate"] * 100 ?>%</td>
<td>NPR <?= number_format($slab["tax"], 2) ?></td>
</tr>
<?php endforeach; ?>
</table>

<p>Tax before female discount: NPR <?= number_format($totalTaxBeforeDiscount, 2) ?></p>
<p>Female discount: NPR <?= number_format($discount, 2) ?></p>
<p><strong>Total tax payable: NPR <?= number_format($totalTax, 2) ?></strong></p>
<p><strong>Net income after tax: NPR <?= number_format($netIncome, 2) ?></strong></p>
<?php endif; ?>
</body>
</html>