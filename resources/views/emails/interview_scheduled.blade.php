<!DOCTYPE html>
<html>
<head>
    <title>Interview Scheduled</title>
</head>
<body>
    <h2>Interview Scheduled</h2>
    <p>Dear {{ $name }},</p>
    <p>Your application status has been updated to <strong>{{ $status }}</strong>.</p>
    <p>Your interview has been scheduled as follows:</p>
    <ul>
        <li><strong>Reference Number:</strong> {{ $refNo }}</li>
        <li><strong>ID Number:</strong> {{ $idnumber }}</li>
        <li><strong>Designation:</strong> {{ $designation }}</li>
        <li><strong>Interview Date:</strong> {{ $interviewDate }}</li>
        <li><strong>Venue:</strong> {{ $venue }}</li>
    </ul>
    <h3>Requirements for the Interview:</h3>
    <ul>
        <li>Present your original academic and professional certificates, transcripts, and testimonials.</li>
        <li>Present a letter of recognition from the Commission for University Education (CUE) for any qualification acquired outside Kenya.</li>
        <li>Demonstrate compliance with the provisions of Chapter Six of the Constitution.</li>
    </ul>
    <p>Please find attached the memo for your interview details.</p>
    <p>Best regards,</p>
    <p>HR Team</p>
</body>
</html>