<?php
// session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Loan</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #DC5C5C, #26498D);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            margin: 0;
        }
        .container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .container h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }
        .balance {
            background: #fff4f4;
            border: 1px solid #ff5f6d;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        .balance .amount {
            color: #ff5f6d;
            font-size: 1.5rem;
            font-weight: bold;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form label {
            text-align: left;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
        }
        form input, form select {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        .buttons .btn {
            padding: 0.75rem 1.5rem;
            border: 1px solid #ff5f6d;
            border-radius: 5px;
            background: none;
            color: #ff5f6d;
            cursor: pointer;
            transition: background 0.3s;
            width: 48%;
        }
        .buttons .btn:hover {
            background: #ff5f6d;
            color: white;
        }
        .buttons .btn-primary {
            background: #ff5f6d;
            color: white;
        }
        .buttons .btn-primary:hover {
            background: #e0545d;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Request Loan</h1>
    <div class="balance">
        Balance limit to request
        <div class="amount">Rp 7.000.000,00</div>
    </div>
    <form action="request_loan.php" method="post">
        <label for="loan-amount">Loan Nominal to Request</label>
        <input type="number" id="loan-amount" name="loan_amount" required value="2200000">
        <small>Please input without comma (,) and period (.), example: 1500000</small>

        <label for="installment-period">Installment Period</label>
        <select id="installment-period" name="installment_period" required>
            <option value="3">3 Month</option>
            <option value="6">6 Month</option>
            <option value="12">12 Month</option>
        </select>

        <div class="buttons">
            <button type="button" class="btn" onclick="window.location.href='<?php echo base_url('/dashboard'); ?>'">Return</button>
            <button type="submit" class="btn btn-primary">Continue</button>
        </div>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loan_amount = $_POST['loan_amount'];
    $installment_period = $_POST['installment_period'];

    // Simpan permintaan pinjaman ke database
    // Contoh: $mysqli->query("INSERT INTO loans (username, loan_amount, installment_period) VALUES ('{$_SESSION['username']}', '$loan_amount', '$installment_period')");

    echo "Loan requested successfully!";
}
?>
</body>
</html>
