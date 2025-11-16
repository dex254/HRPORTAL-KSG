<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KSG Innovations Password Reset</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f7f6; padding: 30px;">

<div style="max-width: 650px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border:1px solid #e1e6e1;">

    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #004d00;">Kenya School of Government (KSG)</h1>
        <p style="color: #444;">Innovations Portal</p>
    </div>

    <h2 style="color: #333;">Dear {{ $invent->name ?? $invent->email }},</h2>

    <p style="color: #4a4a4a; font-size: 16px; line-height: 1.6;">
        A <strong>temporary password</strong> has been generated for your KSG Innovations Portal account:
    </p>

    <p style="display:inline-block; background-color:#e9f7ef; padding:10px 18px; border-left:5px solid #00cc44; border-radius:6px; font-size:18px; font-weight:bold; color:#004d00;">
        {{ $tempPassword }}
    </p>

    <p style="color: #4a4a4a; font-size:16px; line-height:1.6; margin-top: 20px;">
        Please click the button below to set your new password. This link will expire in <strong>30 minutes</strong>.
    </p>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ url('/invent/set-password/' . $resetToken) }}" 
           style="display:inline-block; background-color:#5A381E; color:#fff; text-decoration:none; padding:14px 28px; border-radius:8px; font-size:18px; font-weight:600;">
            Set New Password
        </a>
    </div>

    <div style="margin:30px 0; background-color:#f1f9f2; border-left:6px solid #00cc44; padding:20px 25px; border-radius:8px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);">
        <h3 style="margin:0 0 10px 0; font-size:18px; color:#004d00;">Action Required</h3>
        <p style="margin:0; font-size:16px; color:#000;">
            For security reasons, please reset your password before logging in to the Innovations Portal.
        </p>
    </div>

    <p style="color: #555; font-size: 15px; line-height:1.5;">
        If you did not request this password reset, please contact KSG ICT support immediately.
    </p>

    <p style="color:#333; font-size:16px; margin-top:30px;">
        Kind regards,<br>
        <strong style="color:#004d00;">KSG ICT Team</strong><br>
        <small style="color:#5A381E;">(Developed by Denis & Allan)</small>
    </p>
</div>

<p style="text-align:center; color:#999; font-size:12px; margin-top:30px;">
    © {{ date('Y') }} Kenya School of Government (KSG) — All Rights Reserved.
</p>
</body>
</html>
