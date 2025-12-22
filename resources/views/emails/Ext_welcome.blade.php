<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Confirmation</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f3ef; padding: 30px;">

    <div style="max-width: 650px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border: 1px solid #e6e0d4;">

        <!-- Header -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #bfa100; font-size: 26px; margin: 0;">Kenya School of Government(KSG)</h1>
            <p style="color: #444; font-size: 14px; margin-top: 6px;">KSG Careers Portal</p>
        </div>

        <!-- Greeting -->
        <h2 style="color: #333333;">Dear {{ $ext->name ?? 'User' }},</h2>

        <!-- Message Body -->
        <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6;">
            You have been successfully registered to the <strong>KSG Careers Portal</strong> powered by  KSG.
        </p>

        <p style="color: #4a4a4a; font-size: 16px;">Your unique login details are:</p>

        <ul style="color: #4a4a4a; font-size: 16px; line-height: 1.6;">
            <li><strong>Email:</strong> {{ $ext->email }}</li>
            <li><strong> (Security Key):</strong> 
                <span style="color: #1e5631; font-weight: bold; font-size: 18px;">{{ $ext->upn_no }}</span>
            </li>
        </ul>

        <div style="margin: 30px 0; background-color: #f9f7f2; border-left: 6px solid #bfa100; padding: 20px 25px; border-radius: 8px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);">
            <h3 style="margin: 0 0 10px 0; font-size: 18px; color: #333;">Important Notice</h3>
            <p style="margin: 0; font-size: 16px; color: #000;">
                For your security, do <strong>not share your Security Key</strong> with anyone. This code uniquely identifies your account.
            </p>
        </div>

        <!-- Action Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('EXT.Login') }}"
               style="display: inline-block; background-color: #bfa100; color: #fff; text-decoration: none; padding: 12px 24px; border-radius: 6px; font-size: 16px;">
                Login and Update Profile
            </a>
        </div>

        <!-- Footer -->
        <p style="color: #555; font-size: 15px; line-height: 1.5;">
            If you need assistance, please contact the system administrator or ICT support team.
        </p>

        <p style="color: #333; font-size: 16px; margin-top: 30px;">
            Kind regards,<br>
            <strong style="color: #bfa100;">KSG  Hr Team</strong>
        </p>
    </div>

    <!-- Footer Background -->
    <p style="text-align: center; color: #999; font-size: 12px; margin-top: 30px;">
        © {{ date('Y') }} Kenya School of Government. All rights reserved.
    </p>

</body>
</html>
