<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset Request</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f3ef; padding: 30px;">

    <div style="max-width: 650px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); border: 1px solid #e6e0d4;">

        <!-- Header -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #7f622c; font-size: 26px; margin: 0;">Kenya School of Government (KSG)</h1>
            <p style="color: #444; font-size: 14px; margin-top: 8px;">Human Resource System</p>
        </div>

        <!-- Greeting -->
        <h2 style="color: #333333;">Dear {{ $user->name }} {{ $user->oname }},</h2>

        <!-- Message Body -->
        <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6;">
            A temporary password has been generated for your account:
            <strong>{{ $tempPassword }}</strong>
        </p>

        <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6;">
            Please click the button below to set your new password. This link will expire in 30 minutes.
        </p>

        <!-- Reset Password Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('EXT.Set', $resetToken) }}"
               style="display: inline-block; background-color: #7f622c; color: #fff; text-decoration: none; padding: 14px 28px; border-radius: 8px; font-size: 18px; font-weight: 600;">
                Set New Password
            </a>
        </div>

        <!-- Security Notice -->
        <div style="margin: 30px 0; background-color: #f9f7f2; border-left: 6px solid #7f622c; padding: 20px 25px; border-radius: 8px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);">
            <h3 style="margin: 0 0 10px 0; font-size: 18px; color: #333;">Action Required</h3>
            <p style="margin: 0; font-size: 16px; color: #000;">
                For security reasons, please reset your password before logging in to the system.
            </p>
        </div>

        <!-- Footer -->
        <p style="color: #555; font-size: 15px; line-height: 1.5;">
            If you did not request this password reset, please contact the system administrator or ICT support immediately.
        </p>

        <p style="color: #333; font-size: 16px; margin-top: 30px;">
            Kind regards,<br>
            <strong style="color: #7f622c;">KSG ICT Support Team</strong>
        </p>
    </div>

    <!-- Footer Background -->
    <p style="text-align: center; color: #999; font-size: 12px; margin-top: 30px;">
        © {{ date('Y') }} Kenya School of Government. All rights reserved.
    </p>

</body>
</html>
