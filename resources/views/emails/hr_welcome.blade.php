<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to KSG</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f2f6f5; padding: 30px;">

<div style="max-width: 650px; margin: auto; background-color: #ffffff; padding: 35px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border:1px solid #e0e5e0;">

    <!-- Header -->
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #004d00; margin-bottom:5px; font-size:28px; font-weight:700;">
            Kenya School of Government (KSG)
        </h1>
        <p style="color: #555; font-size:14px; margin:0;">Career Portal</p>
    </div>

    <!-- Greeting -->
    <h2 style="color: #333; font-size:20px; margin-bottom:15px;">
        Dear {{ $name }},
    </h2>

    <!-- Welcome Message -->
    <p style="font-size:16px; color:#444; line-height:1.6;">
        Welcome to the <strong>Kenya School of Government Career Portal</strong>! Your UPN Number is: 
        <strong>{{ $upn_no }}</strong>.
    </p>

    <p style="font-size:16px; color:#444; line-height:1.6;">
        You can now apply for jobs that have been internally advertised by the School of Government.
    </p>

    <p style="font-size:16px; color:#444; line-height:1.6;">
        <strong>Important:</strong> Please do not share your UPN number with anyone to protect your account security.
    </p>

    <p style="font-size:16px; color:#444; line-height:1.6;">
        We wish you all the best in your career development!
    </p>

    <!-- CTA Button -->
    <div style="text-align:center; margin:30px 0;">
        <a href="{{ route('HR.Login') }}"
           style="background:#2E8B57; color:#ffffff; padding:14px 32px; border-radius:8px; text-decoration:none; font-size:16px; font-weight:600; display:inline-block;">
            Login to Your Account
        </a>
    </div>

    <!-- Link Below Button -->
    <p style="text-align:center; font-size:14px; color:#555;">
        Or click this link: <a href="{{ route('HR.Login') }}" style="color:#2E8B57; text-decoration:underline;">
        {{ route('HR.Login') }}</a>
    </p>

    <!-- Signature -->
    <p style="margin-top:30px; font-size:16px; color:#333; line-height:1.6;">
        Warm Regards,<br>
        <strong style="color:#004d00;">Kenya School of Government HR Team</strong>
    </p>
</div>

<!-- Footer -->
<p style="text-align:center; color:#999; margin-top:30px; font-size:13px; line-height:1.5;">
    © {{ date('Y') }} Kenya School of Government (KSG). All Rights Reserved.
</p>

</body>
</html>
