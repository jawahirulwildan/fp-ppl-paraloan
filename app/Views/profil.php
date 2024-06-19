<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
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
        .profile-section {
            background: #fff;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .profile-section h3 {
            display: flex;
            align-items: center;
            color: #ff5f6d;
        }
        .profile-section h3 img {
            margin-right: 10px;
        }
        .profile-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .left-column, .right-column {
            flex: 1 1 50%;
            min-width: 300px;
        }
        button {
            padding: 10px;
            margin-top: 10px;
            color: white;
            background-color: #ff5f6d;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e54e4e;
        }
        .back-btn {
            display: block;
            margin-top: 20px;
            text-align: center;
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f5f5f5;
            color: #555;
            cursor: pointer;
        }
        .back-btn:hover {
            background: #ddd;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="Paraloan">
        <div class="icons">
            <img src="<?php echo base_url('assets/images/notification.svg') ?>" alt="Notifications">
            <img src="<?php echo base_url('assets/images/settings.svg') ?>" alt="Settings">
        </div>
    </div>
    <div class="welcome">Welcome back, <?php echo htmlspecialchars($userData['full_name']); ?></div>
    <div class="profile-info">
        <div class="profile-section left-column">
            <h3><img src="<?php echo base_url('assets/images/person_icon.svg') ?>" alt="Person Icon"> Personal Information</h3>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($userData['phone_number']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($userData['address']); ?></p>
            <p><strong>Occupation:</strong> <?php echo htmlspecialchars($userData['occupation']); ?></p>
            <p><strong>Salary:</strong> Rp <?= number_format($userData['salary'], 0, '', '.'); ?></p>
            <button onclick="logout()">Logout</button>
        </div>
        <div class="profile-section right-column">
            <h3><img src="<?php echo base_url('assets/images/bank_icon.svg') ?>" alt="Bank Icon"> Bank Information</h3>
            <p><strong>Bank Name:</strong> <?php echo htmlspecialchars($userData['bank']); ?></p>
            <p><strong>Account Number:</strong> <?php echo htmlspecialchars($userData['account_number']); ?></p>
            <h3><img src="<?php echo base_url('assets/images/emergency_icon.svg') ?>" alt="Emergency Icon"> Emergency Contacts</h3>
            <p><strong>Emergency Phone Number:</strong> <?php echo htmlspecialchars($userData['emergency_phone']); ?></p>
            <p><strong>Relation to:</strong> <?php echo htmlspecialchars($userData['emergency_relation']); ?></p>
        </div>
    </div>
    <div class="back-btn" onclick="location.href='<?php echo base_url('dashboard'); ?>'">Back</div>
</div>

<script>
    function logout() {
        // Clear session or perform other logout tasks here
        location.href = '<?php echo base_url('index.php'); ?>'; // Redirect to index.php
    }
</script>
</body>
</html>
