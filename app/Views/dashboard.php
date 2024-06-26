<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f7f7f7;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            margin: 0;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            margin: 1rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header img {
            width: 150px;
        }

        .header .icons {
            display: flex;
            gap: 1rem;
        }

        .header .icons img {
            width: 24px;
            height: 24px;
        }

        .welcome {
            font-size: 1.5rem;
            color: #ff5f6d;
            margin-bottom: 1rem;
        }

        .balance {
            display: block;
            align-items: start;
            background: #fff4f4;
            padding: 1rem;
            border-radius: 5px;
            border: 1px solid #ff5f6d;
            margin-bottom: 1rem;
        }

        .balance img {
            width: 24px;
            height: 24px;
            margin-right: 0.5rem;
        }

        .balance .amount {
            display: block;
            color: #ff5f6d;
            font-size: 2rem;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            align-items: end;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .buttons .btn {
            padding: 0.75rem 1.5rem;
            border: 1px solid #ff5f6d;
            border-radius: 5px;
            background: none;
            color: #ff5f6d;
            cursor: pointer;
            transition: background 0.3s;
        }

        .buttons .btn:hover {
            background: #ff5f6d;
            color: white;
        }

        .buttons .btn-primary {
            background: #ff5f6d;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 0.75rem;
            text-align: left;
        }

        table th {
            background: #f5f5f5;
        }

        .status {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: white;
            text-align: center;
        }

        .status.paid {
            background: #4caf50;
        }

        .status.overdue {
            background: #f44336;
        }

        .status.unpaid {
            background: #DC5C5C;
        }

        .status.paid {
            background: #ff9800;
        }

        .pay-now-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #4caf50;
            border-radius: 5px;
            background: none;
            color: #4caf50;
            cursor: pointer;
            transition: background 0.3s;
        }

        .pay-now-btn:hover {
            background: #4caf50;
            color: white;
        }

        .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .footer {
            text-align: right;
            font-size: 0.875rem;
            color: #555;
        }

        .back-btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f5f5f5;
            color: #555;
            cursor: pointer;
            text-align: center;
        }

        .back-btn:hover {
            background: #ddd;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="header">
            <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="Paraloan">
            <div class="icons">
                <div style="display: flex; align-items: center;">
                    <div style="height: 24px;">
                        <img src="<?= base_url('assets/images/notification.svg') ?>" alt="Notifications" style="height: 100%;">
                    </div>
                    <div style="height: 24px; margin: 0 10px;">
                        <a href="<?= site_url('/profile'); ?>">
                            <img src="<?= base_url('assets/images/profile.svg'); ?>" alt="Profile" style="height: 100%;">
                        </a>
                    </div>
                    <div style="height: 24px;">
                        <img src="<?= base_url('assets/images/settings.svg') ?>" alt="Settings" style="height: 100%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="welcome">
            Welcome back, <?php echo htmlspecialchars($userData['full_name']); ?>
        </div>
        <div class="balance">
            <div>Your effective balance available: </div>
            <div class="amount">
                <img src="<?php echo base_url('assets/images/wallet.svg') ?>" alt="Balance">
                <span>Rp <?= number_format($userData['balance'], 0, '', '.'); ?></span>
            </div>

            <div class="buttons">
                <button class="btn" onclick="showHistory()">History</button>
                <button class="btn btn-primary" onclick="window.location.href='<?php echo base_url('/request-loan'); ?>'">Request Loan</button>
            </div>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif; ?>
        </div>
        <div id="dashboard" class="content">
            <div class="table-responsive" style="max-height: 300px; overflow-y: scroll;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Bill Nominal</th>
                            <th>Order</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userInvoicesData as $uid) : ?>
                            <tr>
                                <td>loanid<?= $uid['id']; ?><br>Rp <?= number_format($uid['bill_nominal'], 0, '', '.'); ?></td>
                                <td><?= $uid['order']; ?>/<?= $uid['period']; ?></td>
                                <td><?= date('d-m-Y', strtotime($uid['start_date'])); ?></td>
                                <td><?= date('d-m-Y', strtotime($uid['due_date'])); ?></td>
                                <td><span class="status <?= ($uid['status'] == 0) ? 'unpaid' : 'paid'; ?>"><?= ($uid['status'] == 0) ? 'Unpaid' : 'Paid'; ?></span></td>
                                <td><button class="pay-now-btn" onclick="window.location.href='<?= base_url('/pay/' . $uid['id']); ?>'">Pay Now</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="footer">Current Date: <?= date('d-m-Y'); ?></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php
// session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // Verifikasi pengguna terhadap database
//     // Misalnya: $result = $mysqli->query("SELECT * FROM users WHERE username = '$username'");
//     // if ($result->num_rows > 0) {
//     //     $user = $result->fetch_assoc();
//     //     if (password_verify($password, $user['password'])) {
//     //         $_SESSION['username'] = $username;
//     //         header("Location: request_loan.php");
//     //         exit();
//     //     } else {
//     //         echo "Password incorrect!";
//     //     }
//     // } else {
//     //     echo "Username not found!";
//     // }

//     // Untuk contoh ini, kita anggap verifikasi berhasil
//     $_SESSION['username'] = $username;
//     header("Location: request_loan.php");
//     exit();
// }
// 
?>