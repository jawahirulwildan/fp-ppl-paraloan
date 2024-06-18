//TODO

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Loan</title>
    <link rel="stylesheet" href="debug.css">
</head>
<body>
<div class="container">
    <h2>Payment Loan</h2>
    <form action="payment_loan.php" method="post">
        <label for="loan_id">Loan ID</label>
        <input type="text" id="loan_id" name="loan_id" required>
        <br>
        <label for="amount">Payment Amount</label>
        <input type="number" id="amount" name="amount" required>
        <br>
        <button type="submit">Pay Loan</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loan_id = $_POST['loan_id'];
    $amount = $_POST['amount'];

    // Proses pembayaran pinjaman
    // Contoh: $mysqli->query("UPDATE loans SET paid_amount = paid_amount + '$amount' WHERE id = '$loan_id'");

    echo "Loan payment successful!";
}
?>
</body>
</html>
