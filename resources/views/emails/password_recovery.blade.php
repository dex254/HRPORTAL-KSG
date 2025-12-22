<!DOCTYPE html>
<html>
<head>
    <title>Password Recovery</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f6fa;
            font-family: Arial, Helvetica, sans-serif;
        }

        .email-wrapper {
            width: 100%;
            padding: 20px;
            background: #f5f6fa;
        }

        .email-container {
            max-width: 600px;
            background: #ffffff;
            margin: 0 auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .email-header {
            background: #003366;
            padding: 25px;
            text-align: center;
            color: #ffffff;
        }

        .email-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .email-body {
            padding: 30px;
            color: #333333;
        }

        .email-body p {
            font-size: 15px;
            margin-bottom: 15px;
        }

        .otp-box {
            background: #eef3f8;
            border-left: 4px solid #003366;
            padding: 18px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            font-family: monospace;
            margin: 20px 0;
            border-radius: 5px;
        }

        .verify-button {
            display: inline-block;
            background: #007bff;
            color: #ffffff !important;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
            margin: 25px 0;
        }

        .verify-button:hover {
            background: #0056b3;
        }

        .security-box {
            background: #fff7e6;
            border-left: 4px solid #ff9900;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .email-footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777777;
        }

    </style>
</head>

<body>
<div class="email-wrapper">

    <div class="email-container">

        <!-- Header -->
        <div class="email-header">
            <h2>KSG Career Portal</h2>
            <p style="margin: 0; font-size: 14px; color: #cfd9e5;">Password / OTP Recovery</p>
        </div>

        <!-- Content -->
        <div class="email-body">
            <p>Hello {{ $hr->name ?? 'User' }},</p>

            <p>Your temporary login password (OTP) for accessing the KSG Career Portal is:</p>

            <div class="otp-box">
                {{ $otp }}
            </div>

            <p>You can verify automatically and proceed to your dashboard using the button below:</p>

            <div style="text-align: center;">
                <a href="{{ $verifyUrl }}" class="verify-button">Verify & Login</a>
            </div>

            <div class="security-box">
                <strong>Security Notice:</strong>
                <ul style="padding-left: 18px;">
                    <li>This password is temporary — do not share it with anyone.</li>
                    <li>Use it immediately to log in.</li>
                    <li>If you did not request this login, please ignore the email.</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            This is an automated email. Please do not reply.<br>
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>

    </div>

</div>
</body>
</html>
