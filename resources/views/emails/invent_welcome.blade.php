<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Innovation Challenge</title>
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
        <h1>🎉 Welcome to the Innovation Challenge</h1>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $invent->email }}</strong>,</p>

        <p>We are thrilled to confirm that you have <span class="highlight">successfully registered</span> for the 
        <strong>Innovation Challenge</strong> organized by the <strong>Kenya School of Government</strong>.</p>

        <h2>🔐 Your Registration Details</h2>

        <div class="details">
            <p><strong>Email:</strong> {{ $invent->email }}</p>
            <p><strong>Security Key:</strong> <code>{{ $securityKey }}</code></p>
        </div>

        <p>Please keep your security key safe — you’ll need it for verification and login purposes.</p>

        <div class="button-container">
            <a href="{{ $loginUrl }}" class="button">Go to Login</a>
        </div>

        <p>If the button above doesn’t work, copy and paste this link in your browser:</p>
        <p><a href="{{ $loginUrl }}">{{ $loginUrl }}</a></p>

        <p>Thank you for being part of this journey to inspire and showcase innovation across the public service.</p>

        <p>Warm regards,<br>
        <strong>The Kenya School of Government Team</strong></p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} <strong>Kenya School of Government</strong> — Innovation Challenge Program
    </div>
</div>

</body>
</html>
