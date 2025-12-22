<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        /* Watermark */
        body::before {
            content: "KSG APPLICATION";
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
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
    <div class="header">Complete User Report</div>
    <div class="sub-header"><div class="random-number">
        KSG/{{ Auth::guard('HR')->user()->id }}/{{ Auth::guard('HR')->user()->idnumber }}/{{ Auth::guard('HR')->user()->email }}/{{ rand(1000, 9999) }}
    </div>
    
    <style>
        .random-number {
            position: fixed;
            bottom: 10px;
            left: 10px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
    </div>

    <div class="container">
        <!-- User Details -->
        <div class="section-title">User Details</div>
        <table>
            <tr>
                <th>Full Name</th>
                <td>{{ Auth::guard('HR')->user()->name }}</td>
                <th>Campus</th>
                <td>{{ Auth::guard('HR')->user()->campus }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ Auth::guard('HR')->user()->email }}</td>
                <th>ID/Passport No</th>
                <td>{{ Auth::guard('HR')->user()->idnumber }}</td>
            </tr>
            <tr>
                <th>Phone Contact</th>
                <td>{{ Auth::guard('HR')->user()->phone }}</td>
                <th>Gender</th>
                <td>{{ Auth::guard('HR')->user()->gender }}</td>
            </tr>
            <tr>
                <th>Any Disability</th>
                <td>{{ Auth::guard('HR')->user()->disability }}</td>
                <th>Ethnicity</th>
                <td>{{ Auth::guard('HR')->user()->ethnicity }}</td>
            </tr>
        </table>

        <!-- Academic Qualifications -->
        <div class="section-title">Academic Qualifications</div>
        <table>
            <tr>
                <th>#</th>
                <th>Institution</th>
                <th>Course</th>
                <th>Level</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Grade</th>
            </tr>
            @foreach($academics as $index => $academic)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $academic->institution }}</td>
                <td>{{ $academic->course }}</td>
                <td>{{ $academic->level }}</td>
                <td>{{ date('d M Y', strtotime($academic->stdate)) }}</td>
                <td>{{ date('d M Y', strtotime($academic->enddate)) }}</td>
                <td>{{ $academic->grade }}</td>
            </tr>
            @endforeach
        </table>

        <!-- Work Experience -->
        <div class="section-title">Work Experience</div>
        <table>
            <tr>
                <th>Employer</th>
                <th>Job Title</th>
                <th>Country</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Location</th>
                <th>Expertise</th>
            </tr>
            @foreach($experiences as $experience)
            <tr>
                <td>{{ $experience->employer }}</td>
                <td>{{ $experience->job_title }}</td>
                <td>{{ $experience->country }}</td>
                <td>{{ date('d M Y', strtotime($experience->stdate)) }}</td>
                <td>{{ date('d M Y', strtotime($experience->enddate)) }}</td>
                <td>{{ $experience->location }}</td>
                <td>{{ $experience->expartise }}</td>
            </tr>
            @endforeach
        </table>

        <!-- Application History -->
        <div class="section-title">Application History</div>
        <table>
            <tr>
                <th>Ref No</th>
                <th>Designation</th>
                <th>Status</th>
                <th>Applied On</th>
                <th>CV</th>
                <th>Cover Letter</th>
                <th>Action</th>
            </tr>
            @foreach ($applications as $application)
            <tr>
                <td>{{ $application->Ref_No }}</td>
                <td>{{ $application->designation }}</td>
                <td>
                    <span class="badge badge-{{ $application->status == 'Applied' ? 'success' : 'secondary' }}">
                        {{ $application->status }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($application->datetime)->format('d M Y, h:i A') }}</td>
                <td>
                    @if ($application->cv)
                        <a href="{{ asset($application->cv) }}" target="_blank">View CV</a>
                    @else
                        <span class="text-danger">No CV</span>
                    @endif
                </td>
                <td>
                    @if ($application->cover_letter)
                        <a href="{{ asset($application->cover_letter) }}" target="_blank">View Cover Letter</a>
                    @else
                        <span class="text-danger">No Cover Letter</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('JOB.Applicationdetails', ['ref_no' => $application->Ref_No]) }}">View Details</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        KSG APPLICATION - User Report | Generated on {{ date('d M Y, H:i A') }}
    </div>

</body>
</html>
