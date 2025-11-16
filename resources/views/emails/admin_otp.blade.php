<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin OTP Verification</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8f6f2;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 650px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0dcd2;
        }

        .header {
            background: linear-gradient(90deg, #006400, #39FF14);
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

        .otp-box {
            background-color: #f0fff0;
            border: 2px dashed #39FF14;
            border-radius: 10px;
            padding: 15px 20px;
            margin: 25px 0;
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: #006400;
            letter-spacing: 4px;
            user-select: all;
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
            background-color: #39FF14;
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
            color: #006400;
        }

        @media only screen and (max-width: 600px) {
            .content {
                padding: 20px;
            }
            .header h1 {
                font-size: 22px;
            }
            .otp-box {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <h1>🔐 Admin OTP Verification</h1>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $admin->name }}</strong>,</p>

        <p>We have generated a one-time verification code for your admin login to the
        <strong>Kenya School of Government Platform</strong>.</p>

        <h2>🔑 Your OTP Code</h2>
        <div class="otp-box">{{ $otp }}</div>

        <p>You can also verify your admin login directly by clicking the button below:</p>
        <div class="button-container">
            <a href="{{ $quickVerifyUrl }}" class="button">Quick Verify Admin Account</a>
        </div>

        <p>If the button does not work, copy and paste this URL in your browser:</p>
        <p><a href="{{ $quickVerifyUrl }}">{{ $quickVerifyUrl }}</a></p>

        <p><strong>Note:</strong> This OTP expires in <span class="highlight">10 minutes</span>. Make sure to complete the verification within this period.</p>

        <p>Thank you for supporting digital transformation and governance excellence.</p>

        <p>Warm regards,<br>
        <strong>The Kenya School of Government Team</strong></p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} <strong>Kenya School of Government</strong> — Admin Verification System
    </div>
</div>

</body>
</html>
