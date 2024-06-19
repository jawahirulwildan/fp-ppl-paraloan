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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        .container-med {
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

        form input,
        form select {
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
            width: 30%;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="card mb-3 p-3" style="width: 32rem;">
        <div class="card-body">
            <h3 class="card-title">Loan Confirmation</h3>
            <h5>Summary</h5>
            <form action="<?php echo base_url('/confirmation-loan'); ?>" method="post">
                <div class="mb-1">
                    <label for="nominal" class="form-label">Loan Nominal</label>
                    <input type="number" class="form-control" id="nominal" name="nominal" value="<?= $userChoice['loan_amount']; ?>" readonly>
                </div>
                <div class="mb-1">
                    <label for="period" class="form-label">Period</label>
                    <input type="text" class="form-control" id="period" name="period" value="<?= $userChoice['installment_period']; ?>" readonly>
                </div>
                <div class="mb-1">
                    <label for="interest" class="form-label">Interest</label>
                    <input type="text" class="form-control" id="interest" name="interest" value="<?= $interest; ?>" readonly>
                </div>
                <div class="mb-1">
                    <label for="bank" class="form-label">Bank Destination</label>
                    <input type="text" class="form-control" id="bank" name="bank" value="<?= $userData['bank']; ?>" readonly>
                </div>
                <div class="mb-1">
                    <label for="accountnum" class="form-label">Account Number</label>
                    <input type="text" class="form-control" id="accountnum" name="accountnum" value="<?= $userData['account_number']; ?>" readonly>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="" class="btn px-5" style="background: #ff5f6d; color: white;">Return</a>
                    <button type="submit" class="btn btn-primary px-5">Apply</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>