<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset Request</h2>
    <p>You requested a password reset for your account.</p>
    <p>Click the link below to reset your password:</p>
    <a href="{{ url('/reset-password?email='.$email) }}">Reset Password</a>
</body>
</html>
