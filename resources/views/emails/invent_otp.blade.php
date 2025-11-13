<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
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
            user-select: all; /* allows easy copy */
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
        <h1>🔐 OTP Verification</h1>
    </div>

    <div class="content">
        <h2>Hello {{ $invent->email }},</h2>
        <p>Your one-time verification code is below:</p>

        <div class="otp-box">{{ $otp }}</div>

        <p>Or click the button below to verify your account:</p>

        <div class="button-container">
            <a href="{{ route('invent.otp.quick.verify', ['email' => $invent->email, 'otp' => $otp]) }}" class="button">Verify Account</a>
        </div>

        <p>If the button doesn’t work, copy and paste this link in your browser:</p>
        <p><a href="{{ route('invent.otp.quick.verify', ['email' => $invent->email, 'otp' => $otp]) }}">{{ route('invent.otp.quick.verify', ['email' => $invent->email, 'otp' => $otp]) }}</a></p>

        <p><strong>Note:</strong> This OTP expires in <span style="color:#006400;">10 minutes</span>.</p>

        <p>Warm regards,<br>
        <strong>The Kenya School of Government Team</strong></p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} <strong>Kenya School of Government</strong> — Verification System
    </div>
</div>

</body>
</html>
