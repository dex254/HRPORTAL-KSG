<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>HR Record Updated</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f4f7; padding: 40px;">

    <div style="max-width:650px; margin:auto; background:#ffffff; padding:35px; border-radius:12px; box-shadow: 0 6px 20px rgba(0,0,0,0.1); border:1px solid #e0e6e6;">

        <!-- Header -->
        <div style="text-align:center; margin-bottom:30px;">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/3/35/Kenya_School_of_Government_logo.png/220px-Kenya_School_of_Government_logo.png" 
                 alt="KSG Logo" style="width:120px; margin-bottom:10px;">
            <h1 style="color:#004d00; margin:0; font-size:24px;">Kenya School of Government</h1>
            <p style="color:#555; font-size:14px; margin-top:5px;">HR Portal – Record Update Notification</p>
        </div>

        <!-- Greeting -->
        <h2 style="color:#2c3e50; font-size:20px; margin-bottom:15px;">Hello {{ $hr->name }},</h2>

        <p style="font-size:16px; color:#555;">
            Your HR record has been <strong>successfully updated</strong>. Below are your updated details for your reference:
        </p>

        <!-- Details Table -->
        <table style="width:100%; margin-top:20px; border-collapse: collapse; font-size:15px;">
            <tr style="background:#f0f9f4;">
                <td style="padding:10px; font-weight:bold;">UPN Number:</td>
                <td style="padding:10px;">{{ $hr->upn_no }}</td>
            </tr>
            <tr>
                <td style="padding:10px; font-weight:bold;">Name:</td>
                <td style="padding:10px;">{{ $hr->name }}</td>
            </tr>
            <tr style="background:#f0f9f4;">
                <td style="padding:10px; font-weight:bold;">Email:</td>
                <td style="padding:10px;">{{ $hr->email }}</td>
            </tr>
            <tr>
                <td style="padding:10px; font-weight:bold;">Phone:</td>
                <td style="padding:10px;">{{ $hr->phone }}</td>
            </tr>
            <tr style="background:#f0f9f4;">
                <td style="padding:10px; font-weight:bold;">Job Group:</td>
                <td style="padding:10px;">{{ $hr->job_group }}</td>
            </tr>
            <tr>
                <td style="padding:10px; font-weight:bold;">Campus:</td>
                <td style="padding:10px;">{{ $hr->campus }}</td>
            </tr>
            <tr style="background:#f0f9f4;">
                <td style="padding:10px; font-weight:bold;">Home County:</td>
                <td style="padding:10px;">{{ $hr->home_county }}</td>
            </tr>
        </table>

        <!-- Security Note -->
        <p style="margin-top:20px; font-size:14px; color:#555;">
            <strong>Important:</strong> Please do not share your UPN number with anyone to maintain account security.
        </p>

        <!-- CTA Button -->
        <div style="text-align:center; margin-top:30px;">
            <a href="{{ route('HR.Login') }}" 
               style="background:#27ae60; color:#ffffff; padding:14px 28px; border-radius:8px; text-decoration:none; font-size:16px; font-weight:bold; display:inline-block; box-shadow:0 4px 8px rgba(0,0,0,0.1);">
               Login to Portal
            </a>
            <p style="margin-top:8px; color:#777; font-size:13px;">{{ route('HR.Login') }}</p>
        </div>

        <!-- Footer -->
        <p style="margin-top:30px; font-size:14px; color:#555;">
            Warm regards,<br>
            <strong style="color:#004d00;">KSG HR Team</strong>
        </p>

    </div>

    <p style="text-align:center; color:#999; margin-top:30px; font-size:12px;">
        © {{ date('Y') }} Kenya School of Government (KSG). All Rights Reserved.
    </p>

</body>
</html>
