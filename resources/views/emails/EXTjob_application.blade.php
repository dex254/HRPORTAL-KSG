<!DOCTYPE html>
<html>
<head>
    <title>Job Application Confirmation</title>
</head>
<body>
    <p>Dear {{ $name }},</p>

    <p>Thank you for applying for the <strong>{{ $designation }}</strong> position.</p>

    <p>Your application has been received successfully. Below are your details:</p>
    <ul>
        <li><strong>Full Name:</strong> {{ $name }}</li>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Phone:</strong> {{ $phone }}</li>
        <li><strong>ID Number:</strong> {{ $idnumber }}</li>
        <li><strong>Reference Number:</strong> {{ $Ref_No }}</li>
    </ul>

    <p>Your CV, Cover Letter, and Bio Report are attached to this email.</p>

    <p>We will review your application and get back to you soon.</p>

    <p>Best regards,<br>
    HR Team</p>
</body>
</html>
