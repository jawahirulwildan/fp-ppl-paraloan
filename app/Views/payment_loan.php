<?php
// session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }

// // Contoh mendapatkan informasi pembayaran dari database berdasarkan loan_id
// $loan_id = $_GET['loan_id'];
// $loan_info = [
//     'loan_id' => $loan_id,
//     'amount' => 'Rp 1.250.000',
//     'due_date' => '32-01-2078',
//     'status' => 'Overdue',
// ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Information</title>
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
        .info {
            text-align: left;
            margin-bottom: 1rem;
        }
        .info p {
            display: flex;
            justify-content: space-between;
            margin: 0.5rem 0;
            font-size: 1rem;
            color: #333;
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
    <h1>Payment Information</h1>
    <div class="info">
        <p><strong>Details</strong></p>
        <p><span>Order no. </span><span><?= $invoiceData['order']; ?> of <?= $invoiceData['period']?> </span></p>
        <p><span>Monthly Charge</span><span>Rp <?= number_format($loan['amount']/$loan['period'], 2, ',', '.'); ?></span></p>
        <p><span>Interest</span><span><?= $loan['interest']*100 ?>% </span></p>
        <p><span>Admin fee</span><span>Rp 2.500,00</span></p>
        <p><span>Penalty fee</span><span>Rp <?= number_format($invoiceData['penalty'], 2, ',', '.'); ?></span></p>
        <hr>
        <p><span>Total</span><span>Rp <?= number_format($invoiceData['bill_nominal'] + 2500 + $invoiceData['penalty'], 2, ',', '.'); ?></span></p>
    </div>
    <form action="payment_loan.php" method="post">
        <input type="hidden" name="loan_id" value="10000">
        
        <div class="buttons">
            <button type="button" class="btn" onclick="window.location.href='<?php echo base_url('/dashboard'); ?>'">Return</button>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </div>
    </form>
</div>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loan_id = $_POST['loan_id'];

    // Proses pembayaran
    // Contoh: $mysqli->query("UPDATE loans SET status='Paid' WHERE loan_id='$loan_id'");

    echo "<script>alert('Payment successful!'); window.location.href='" . base_url('dashboard') . "';</script>";
}
?>
</body>
</html>
