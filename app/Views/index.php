<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container label {
            text-align: left;
            margin-bottom: 0.5rem;
            color: #333;
        }
        .container input {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        .container button {
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            background: #ff5f6d;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        .container button:hover {
            background: #e0545d;
        }
        .container .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .container .options a {
            color: #ff5f6d;
            text-decoration: none;
            font-size: 0.875rem;
        }
        .container .options a:hover {
            text-decoration: underline;
        }
        .container .social-login {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .container .social-login button {
            background: white;
            color: #555;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .container .social-login button img {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Paraloan" style="width: 150px; margin-bottom: 1rem;">
    <form action="<?php echo base_url('/') ?>" method="post">
        <label for="email">Email or Phone number</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <div class="options">
            <div>
                <input type="checkbox" id="remember" name="remember">
                <label for="remember" style="display: inline;">Remember me</label>
            </div>
            <a href="#">Forget password?</a>
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="options" style="justify-content: center;">
        <span>New to Paraloan? <a href="<?= base_url('/register') ?>">Register</a></span>
    </div>

    <div class="social-login">
        <hr style="margin: 1rem 0;">
        <span>or login with</span>
        <button type="button"><img src="<?php echo base_url('assets/images/qr_code.svg'); ?>" alt="QR Code">QR Code Scan</button>
        <button type="button"><img src="<?php echo base_url('assets/images/google_logo.svg'); ?>" alt="Google">Sign in with Google</button>
    </div>
</div>
</body>
</html>
