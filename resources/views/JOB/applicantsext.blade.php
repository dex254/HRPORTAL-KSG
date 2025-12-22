@include('HRPU.Dashboard.header')
@include('HRPU.Dashboard.Status')
<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Career  Opportunities</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                    </nav>
                </div>
                
            </div> <!--end breadcrumb-->
            <style>
                /* Previous Button */
                .previous-btn {
                    background-color: rgb(127, 98, 44);
                    color: white;
                    border: none;
                    padding: 12px 24px;
                    font-size: 16px;
                    cursor: pointer;
                    transition: background-color 0.3s ease, color 0.3s ease;
                    text-decoration: none;
                    display: inline-block;
                    margin: 10px;
                    border-radius: 5px;
                }
                
                .previous-btn:hover {
                    background-color: white;
                    color: rgb(127, 98, 44);
                    border: 1px solid rgb(127, 98, 44);
                }
                
                /* Next Button */
                .next-btn {
                    background-color: rgb(203, 211, 0);
                    color: black;
                    border: none;
                    padding: 12px 24px;
                    font-size: 16px;
                    cursor: pointer;
                    transition: background-color 0.3s ease, color 0.3s ease;
                    text-decoration: none;
                    display: inline-block;
                    margin: 10px;
                    border-radius: 5px;
                }
                
                .next-btn:hover {
                    background-color: white;
                    color: black;
                    border: 1px solid black;
                }
                </style>
                
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Report.Ext') }}" class="previous-btn">Previous</a>
                
                    <button onclick="location.href='{{ route('JOB.Myapplicants') }}'" class="next-btn">
                        Next
                    </button>
                </div>
                
            <br>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            
                        </div>
                    </div>
                    @if ($errors->any() || session('success') || session('error'))
    <div class="alert alert-{{ $errors->any() ? 'danger' : (session('error') ? 'danger' : 'success') }}" role="alert">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @elseif (session('error'))
            {{ session('error') }} <!-- Display custom error message -->
        @else
            {{ session('success') }}
        @endif
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success" id="success-message">
        {{ session('status') }}
    </div>
@endif

<!-- General Error Message (For form errors or custom validation errors) -->
@if ($errors->any() || session('error'))
    <div class="alert alert-danger" id="error-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @if (session('error'))
                <li>{{ session('error') }}</li> <!-- Display "already applied" error -->
            @endif
        </ul>
    </div>
@endif

<!-- Style for alert boxes -->
<style>
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: block;
    }

    .alert-success {
        background-color: yellow;
        color: #333;
        border: 1px solid #ccc;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<!-- Flickering effect using JavaScript -->
<script>
    function flickerEffect(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            let visible = true;
            setInterval(() => {
                element.style.visibility = visible ? 'hidden' : 'visible';
                visible = !visible;
            }, 470);
        }
    }

    if (document.getElementById('success-message')) {
        flickerEffect('success-message');
    }

    if (document.getElementById('error-message')) {
        flickerEffect('error-message');
    }
</script>

                    <div class="table-responsive">
                        <table id="example" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>S/NO.</th>
                                    <th>Area</th>
                                    <th>Specific Area of Specialization</th>
                                    
                                    
                                    <th>Start Date</th>
                                    <th>Deadline</th>
                                    <th>Status</h>
                                    <th>Number  of  Positions</th>
                                    <th>Apply</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobexts as $index =>$record)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $record->area }}</td>
                                    <td>{{ $record->Specialization }}</td>
                                    
                                    <td>{{ $record->datefrom }}</td>
                                    <td>{{ $record->deadline }}</td>
                                    <td>{{ $record->status }}</td>
                                    <td>{{ $record->Proposed_No_of_Positions }}</td>
                                    
                                   <td>
    @php
        $user = Auth::guard('HRPU')->user();
        $userUpn = $user->upn_no;

        // Define academic levels in ascending order
        $levels = [
            'O level',
            'A level',
            'Certificate',
            'Diploma',
            "Bachelor's Degree",
            "Master's Degree",
            "Doctorate (PhD)",
            "Other"
        ];

        $jobLevel = $record->level;
        $jobLevelIndex = array_search($jobLevel, $levels);

        // Fetch all academic levels for this user
        $userLevels = \App\Models\Academic::where('upn_no', $userUpn)->pluck('level')->toArray();

        $isQualified = false;

        if ($jobLevelIndex !== false) {
            // If job requires "O level", everyone is qualified
            if ($jobLevel === 'O level') {
                $isQualified = true;
            } else {
                // Check if any user level is equal or higher
                foreach ($userLevels as $level) {
                    $userIndex = array_search($level, $levels);
                    if ($userIndex !== false && $userIndex >= $jobLevelIndex) {
                        $isQualified = true;
                        break;
                    }
                }
            }
        }

        // Check if already applied
        $existingApplication = \App\Models\Application::where('Ref_No', $record->Ref_NO)
            ->where('upn_no', $userUpn)
            ->whereIn('status', ['Applied', 'Not Qualified', 'Qualified'])
            ->first();
    @endphp

    @if ($existingApplication)
        <button class="btn btn-sm" disabled 
                style="background-color: rgb(127, 98, 44); color: white; cursor: not-allowed;">
            <i class="fa fa-check"></i> Already Applied
        </button>
    @else
        <button class="btn btn-sm" 
                style="background-color: rgb(203, 211, 0); color: black; border-color: rgb(180, 188, 0);"
                onclick="checkAcademicQualification({{ $isQualified ? 'true' : 'false' }}, '{{ route('JOB.Applyext', ['id' => $record->id]) }}')">
            <i class="fa fa-check"></i> Apply
        </button>
    @endif

    <script>
        function checkAcademicQualification(isQualified, applyUrl) {
            if (!isQualified) {
                alert("You are not qualified to apply for this job based on your academic level.");
            } else {
                window.location.href = applyUrl;
            }
        }
    </script>
</td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                     <th>S/NO.</th>
                                    <th>Designation</th>
                                    <th>Job Group</th>
                                    
                                    
                                    <th>Start Date</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Number  of  Positions</th>
                                    <th>Apply</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HRPU.Dashboard.footer')

