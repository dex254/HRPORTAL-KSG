<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KSG HR Admin Portal – Temporary Password</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f7f6; padding: 30px;">

<div style="max-width: 650px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border:1px solid #e1e6e1;">

    <!-- Header -->
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #004d00; margin-bottom:5px;">
            Kenya School of Government (KSG)
        </h1>
        <p style="color: #555; font-size:15px;">
            HR Administration Portal
        </p>
    </div>

    <!-- Greeting -->
    <h2 style="color: #333;">
        Dear {{ $admin->name ?? $admin->email }},
    </h2>

    <!-- Message -->
    <p style="font-size: 16px; color:#444;">
        Your <strong>HR Administrator account</strong> for the Kenya School of Government has been successfully created.
        A temporary password has been generated for your initial login.
    </p>

    <!-- Temporary Password -->
    <p style="background:#e9f7ef; padding:12px 20px; font-size:18px; display:inline-block; border-left:5px solid #00a651; border-radius:6px; font-weight:bold; letter-spacing:1px;">
        {{ $tempPassword }}
    </p>

    <!-- Reset Instruction -->
    <p style="font-size: 16px; color:#444; margin-top:20px;">
        For security purposes, please click the button below to set your own password.
        This link will expire in <strong>30 minutes</strong>.
    </p>

    <!-- CTA Button -->
    <div style="text-align:center; margin:30px 0;">
        <a href="{{ url('/admin/set-password/' . $resetToken) }}"
           style="background:#5A381E; color:#ffffff; padding:14px 30px; border-radius:8px; text-decoration:none; font-size:16px; font-weight:600;">
            Set New Password
        </a>
    </div>

    <!-- Security Note -->
    <p style="font-size:15px; color:#555;">
        If you did not expect this email, please contact the ICT Directorate immediately.
    </p>

    <!-- Signature -->
    <p style="margin-top:30px; font-size:16px; color:#333;">
        Kind regards,<br>
        <strong style="color:#004d00;">KSG ICT Directorate</strong><br>
        <small style="color:#5A381E;">
            HR Systems Support
        </small>
    </p>
</div>

<!-- Footer -->
<p style="text-align:center; color:#999; margin-top:30px; font-size:13px;">
    © {{ date('Y') }} Kenya School of Government (KSG). All Rights Reserved.<br>
    <span style="color:#777;">Developed by Denis</span>
</p>

</body>
</html>
