<!DOCTYPE html>
<html>
<head>
    <title>Job Application Confirmation</title>
</head>
<body>
    <h2>Hello {{ $applicationData['name'] }},</h2>
    <p>You have successfully applied for the position of <strong>{{ $applicationData['designation'] }}</strong>.</p>
    <p>Your application reference number is <strong>{{ $applicationData['Ref_No'] }}</strong>.</p>
    <p>We will review your application and get back to you soon.</p>
    <br>
    <p>Best Regards,</p>
    <p><strong>HR Job Applications Team</strong></p>
</body>
</html>
