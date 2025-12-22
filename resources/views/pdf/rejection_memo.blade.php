<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Memo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        /* Watermark */
        body::before {
            content: "KSG";
            position: absolute;
            font-size: 60px;
            color: rgba(0, 0, 0, 0.1);
            top: 35%;
            left: 10%;
            transform: rotate(-30deg);
            z-index: -1;
            font-weight: bold;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        /* Logo Styling */
        .images-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo-icon {
            margin: 0 10px;
            vertical-align: middle;
        }

        .header {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
        }

        .sub-header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }
        table thead th {
        background-color: rgb(203, 211, 0); /* Header background */
        color: rgb(127, 98, 44); /* Header text */
        padding: 10px;
        text-align: left;
    }

    table {
    border-collapse: collapse;
    width: 100%;
}

th {
    background-color: rgb(203, 211, 0); /* Background color */
    color: rgb(127, 98, 44); /* Text color */
    border: 1px solid black;
    padding: 10px;
    text-align: left;
}

td {
    border: 1px solid black;
    padding: 10px;
    text-align: left;
}

        th {
            background-color: #007bff;
            color: white;
        }

        .section-title {
            background-color: #f0f0f0;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            padding: 10px;
            background-color: #007bff;
            color: white;
        }
    </style>
    
</head>
<body>
    <!-- Logo Section -->
    <div class="images-container">
        <img src="{{ public_path('assets/images/output-onlinepngtools (3).png') }}" class="logo-icon" alt="logo icon" height="66px" width="70px">
        <img src="{{ public_path('assets/images/COA_Line__1.png') }}" class="logo-icon" alt="logo icon" height="66px" width="5px">
        <img src="{{ public_path('assets/images/KSG Logo (1).png') }}" class="logo-icon" alt="logo icon" height="66px" width="90px">
    </div>

    <!-- Header -->
    <div class="header">
         
    </div>
    <div class="sub-header">
        Kenya School of Government
    </div>

    <!-- Application Details -->
    <div class="container">
        <div class="section-title">Applicant Information</div>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $application->name }}</td>
            </tr>
            <tr>
                <th>ID Number</th>
                <td>{{ $application->idnumber }}</td>
            </tr>
            <tr>
                <th>Reference Number</th>
                <td>{{ $application->Ref_No }}</td>
            </tr>
            <tr>
                <th>Designation</th>
                <td>{{ $application->designation }}</td>
            </tr>
           
        </table>

        <p>Thank you for your interest in the <span>{{ $application->designation }}</span> <span>with</span> <span>{{ $application->Ref_No }}</span> position at Kenya School of Government (KSG). We appreciate the time and effort you invested in your application.</p>
        <p>After careful consideration, we regret to inform you that your application has not been successful at this time. Please note that this decision was made after a thorough review of all applications received, and it does not reflect on your qualifications or potential.</p>
        <p><strong>Feedback:</strong> {{ $application->rejectionReason }}</p>
        <p>We encourage you to apply for future opportunities that align with your skills and experience. Your profile will remain in our database, and we will notify you if a suitable position becomes available.</p>
        <p>Thank you once again for considering KSG as a potential employer. We wish you the very best in your future endeavors.</p>
        <p>Best regards,</p>
        <p>HR Team<br>Kenya School of Government (KSG)</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        KSG APPLICATION - MEMO | Generated on {{ date('d M Y, H:i A') }}
    </div>
</body>
</html>