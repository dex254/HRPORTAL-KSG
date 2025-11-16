<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KSG Admin Portal Password Reset</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f7f6; padding: 30px;">

<div style="max-width: 650px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border:1px solid #e1e6e1;">

    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #004d00;">Kenya School of Government (KSG)</h1>
        <p style="color: #444;">Admin Management Portal</p>
    </div>

    <h2 style="color: #333;">Dear {{ $admin->name ?? $admin->email }},</h2>

    <p style="font-size: 16px; color:#444;">
        A <strong>temporary password</strong> has been generated for your Admin Portal account:
    </p>

    <p style="background:#e9f7ef; padding:10px 18px; font-size:18px; display:inline-block; border-left:5px solid #00cc44; border-radius:6px; font-weight:bold;">
        {{ $tempPassword }}
    </p>

    <p style="font-size: 16px; color:#444; margin-top:20px;">
        Click the button below to set your new password. The link will expire in <strong>30 minutes</strong>.
    </p>

    <div style="text-align:center; margin:30px 0;">
        <a href="{{ url('/admin/set-password/' . $resetToken) }}"
           style="background:#5A381E; color:#fff; padding:14px 28px; border-radius:8px; text-decoration:none; font-size:17px;">
            Set New Password
        </a>
    </div>

    <p style="font-size:15px; color:#555;">
        If you did not request this reset, please contact ICT support immediately.
    </p>

    <p style="margin-top:30px; font-size:16px; color:#333;">
        Kind regards,<br>
        <strong style="color:#004d00;">KSG ICT Team</strong><br>
        <small style="color:#5A381E;">(Developed by Denis)</small>
    </p>
</div>

<p style="text-align:center; color:#999; margin-top:30px;">
    © {{ date('Y') }} Kenya School of Government (KSG) — All Rights Reserved.
</p>

</body>
</html>
