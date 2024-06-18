<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/debug.css') ?>">
</head>
<body>
<div class="container">
    <h1>Dashboard</h1>
    <nav>
        <ul class="tabs" id="tabs">
            <li><a href="#request-loan" class="active">Request Loan</a></li>
            <li><a href="#payment-loan">Payment Loan</a></li>
        </ul>
    </nav>
    <div id="request-loan" class="tab-content">
        <div class="container">
            <h2>Request Loan</h2>
            <form action="request_loan.php" method="post">
                <label for="amount">Loan Amount</label>
                <input type="number" id="amount" name="amount" required>
                <br>
                <label for="duration">Loan Duration (months)</label>
                <input type="number" id="duration" name="duration" required>
                <br>
                <button type="submit">Request Loan</button>
            </form>
        </div>
    </div>
    <div id="payment-loan" class="tab-content hide">
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
    </div>
</div>
<script src="debug.js"></script>
<script>
    init();
</script>
</body>
</html>
