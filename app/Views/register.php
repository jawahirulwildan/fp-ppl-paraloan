<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
            max-width: 900px;
            width: 100%;
            margin: 1rem;
        }
        .container h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
            text-align: center;
        }
        .container form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .container form .section {
            width: 48%;
        }
        .container form label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
        }
        .container form input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        .container form .full-width {
            width: 100%;
        }
        .container form button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            background: #ff5f6d;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        .container form button:hover {
            background: #e0545d;
        }
        .container .additional-docs {
            margin-top: 2rem;
            text-align: center;
        }
        .container .additional-docs hr {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 1rem 0;
        }
        .container .additional-docs .docs {
            display: flex;
            justify-content: space-between;
        }
        .container .additional-docs .docs .doc {
            width: 32%;
            text-align: center;
        }
        .container .additional-docs .docs .doc input[type="file"] {
            display: none;
        }
        .container .additional-docs .docs .doc label {
            display: block;
            background: #ff5f6d;
            color: white;
            padding: 0.75rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .container .additional-docs .docs .doc label:hover {
            background: #e0545d;
        }
        .container .additional-docs .docs .doc .file-info {
            margin-top: 0.5rem;
            color: #555;
            font-size: 0.875rem;
        }
        .container .login-link {
            text-align: center;
            margin-top: 1rem;
        }
        .container .login-link a {
            color: #ff5f6d;
            text-decoration: none;
            font-weight: 600;
        }
        .container .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="Paraloan" style="width: 150px; margin-bottom: 1rem; display: block; margin-left: auto; margin-right: auto;">
    <h1>Registration</h1>
    <form action="<?php echo base_url('register') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
        <div class="section">
            <label for="email">Email*</label>
            <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
            
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" value="<?= old('password') ?>" required>
            
            <label for="full-name">Full Name*</label>
            <input type="text" id="full-name" name="full_name" value="<?= old('full_name') ?>" required>
            
            <label for="nik">NIK*</label>
            <input type="text" id="nik" name="nik" value="<?= old('nik') ?>" required>
            
            <label for="phone-number">Phone Number*</label>
            <input type="text" id="phone-number" name="phone_number" value="<?= old('phone_number') ?>" required>
            
            <label for="address">Address*</label>
            <input type="text" id="address" name="address" value="<?= old('address') ?>" required>
            
            <label for="occupation">Occupation</label>
            <input type="text" id="occupation" name="occupation" value="<?= old('occupation') ?>" required>
            
            <label for="salary">Salary</label>
            <input type="text" id="salary" name="salary" value="<?= old('salary') ?>" required>
        </div>
        <div class="section">
            <label for="bank">Bank*</label>
            <input type="text" id="bank" name="bank" value="<?= old('bank') ?>" required>
            
            <label for="account-number">Account Number*</label>
            <input type="text" id="account-number" name="account_number" value="<?= old('account_number') ?>" required>
            
            <label for="emergency-phone-number">Emergency Phone Number*</label>
            <input type="text" id="emergency-phone" name="emergency_phone" value="<?= old('emergency_phone') ?>" required>
            
            <label for="relation">Relation to*</label>
            <input type="text" id="emergency-relation" name="emergency_relation" value="<?= old('emergency_relation') ?>" required>

            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="additional-docs full-width">
            <hr>
            <span>Additional Documents</span>
            <div class="docs">
                <div class="doc">
                    <label for="id-card">Upload File..</label>
                    <input type="file" id="id-card" name="id_card">
                    <span class="file-info">No file selected</span>
                    <small>Please upload a proper scan of your ID Card</small>
                </div>
                <div class="doc">
                    <label for="npwp">Upload File..</label>
                    <input type="file" id="npwp" name="npwp">
                    <span class="file-info">No file selected</span>
                    <small>Please upload your NPWP document if you have one</small>
                </div>
                <div class="doc">
                    <label for="selfie-id">Upload File..</label>
                    <input type="file" id="selfie-id" name="selfie_id">
                    <span class="file-info">No file selected</span>
                    <small>Take a brief selfie, press hint icon to see the proper example of selfie</small>
                </div>
            </div>
        </div>
        <button type="submit">Register</button>
    </form>
    <div class="login-link">
        Already have an account? <a href="<?php echo base_url('/') ?>">Login</a>
    </div>
</div>
</body>
</html>
