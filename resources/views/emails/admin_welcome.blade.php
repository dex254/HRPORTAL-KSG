<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Account Created</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8f6f2;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 700px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0dcd2;
        }

        .header {
            background: linear-gradient(90deg, #006400, #8B6B4A);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }

        .header h1 {
            font-size: 26px;
            margin: 0;
            letter-spacing: 1px;
        }

        .content {
            padding: 30px 40px;
            line-height: 1.7;
        }

        .content h2 {
            color: #006400;
            font-size: 22px;
        }

        .highlight {
            color: #D4AF37;
            font-weight: bold;
        }

        .details {
            background-color: #f7f3e9;
            border: 1px solid #e4d6b8;
            border-radius: 10px;
            padding: 15px 20px;
            margin: 20px 0;
        }

        .details p {
            margin: 6px 0;
        }

        .notice {
            background-color: #fff4d6;
            border: 1px solid #f1ca7f;
            padding: 15px 20px;
            border-radius: 10px;
            margin-top: 25px;
            font-size: 15px;
            color: #7a6000;
        }

        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            background-color: #006400;
            color: #fff !important;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .button:hover {
            background-color: #D4AF37;
            color: #1b1b1b !important;
        }

        .footer {
            background-color: #f1ede8;
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #555;
            border-top: 1px solid #e0dcd2;
        }

        .footer strong {
            color: #8B6B4A;
        }

        @media only screen and (max-width: 600px) {
            .content {
                padding: 20px;
            }

            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <h1>🎉 Admin Account Created</h1>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $admin->name }}</strong>,</p>

        <p>Your administrative account for the 
        <strong>Kenya School of Government Platform</strong>
        has been <span class="highlight">successfully created</span>.</p>

        <h2>🔐 Your Account Details</h2>

        <div class="details">
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Phone:</strong> {{ $admin->phone }}</p>
            <p><strong>Role:</strong> {{ ucfirst($admin->role) }}</p>
            <p><strong>Dashboard:</strong> {{ ucfirst($admin->dash) }}</p>
            <p><strong>Digital Signature:</strong> <code>{{ $admin->digitalsignature }}</code></p>
        </div>

        <div class="notice">
            ⚠️ <strong>Important:</strong> To access your admin dashboard, you must first 
            <strong>reset your password</strong>.<br><br>
            Go to the login page and click <strong>"Forgot Password"</strong>.  
            A reset link will be sent to your email.  
            Once you set a new password, you will be able to log in successfully.
        </div>

        <div class="button-container">
            <a href="{{ route('admin') }}" class="button">Go to Admin Login</a>
        </div>

        <p>If the button doesn’t work, click or copy this link:</p>
        <p><a href="{{ route('admin') }}">{{ route('admin') }}</a></p>

        <p>We’re excited to have you on board as we continue strengthening digital governance and service excellence.</p>

        <p>Warm regards,<br>
        <strong>The Kenya School of Government Team</strong></p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} <strong>Kenya School of Government</strong> — Admin Access
    </div>
</div>

</body>
</html>
