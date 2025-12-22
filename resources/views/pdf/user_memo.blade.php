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
            background-color: rgb(203, 211, 0); /* Updated header background */
            color: rgb(127, 98, 44); /* Updated header text color */
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
        }

        .sub-header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
            color: rgb(127, 98, 44); /* Updated sub-header text color */
        }

        /* Table Styling */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th {
            background-color: rgb(203, 211, 0); /* Header background */
            color: rgb(127, 98, 44); /* Header text */
            padding: 10px;
            text-align: left;
            border: 1px solid black;
        }

        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        .section-title {
            background-color: #f0f0f0;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: rgb(127, 98, 44); /* Updated section title text color */
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
            background-color: rgb(203, 211, 0); /* Updated footer background */
            color: rgb(127, 98, 44); /* Updated footer text color */
        }

        /* Additional Message Styling */
        .requirements {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .requirements h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: rgb(127, 98, 44); /* Updated requirements heading text color */
        }

        .requirements ul {
            margin-left: 20px;
        }

        .requirements ul li {
            margin-bottom: 5px;
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
        INTERVIEW SCHEDULING MEMO
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
            <tr>
                <th>Email</th>
                <td>{{ $application->email }}</td>
            </tr>
        </table>

        <div class="section-title">Interview Details</div>
        <table>
            <tr>
                <th>Interview Date</th>
                <td>{{ $application->intervew }}</td>
            </tr>
            <tr>
                <th>Venue</th>
                <td>{{ $application->venue }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $application->status }}</td>
            </tr>
        </table>

        <!-- Additional Requirements Section -->
        <div class="requirements">
            <h3>Requirements for the Interview:</h3>
            <ul>
                <li>Present your original academic and professional certificates, transcripts, and testimonials.</li>
                <li>Present a letter of recognition from the Commission for University Education (CUE) for any qualification acquired outside Kenya.</li>
                <li>Demonstrate compliance with the provisions of Chapter Six of the Constitution.</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        KSG APPLICATION - MEMO | Generated on {{ date('d M Y, H:i A') }}
    </div>
</body>
</html>