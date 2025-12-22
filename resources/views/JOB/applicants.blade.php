@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')
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
                    <a href="{{ route('Report.Complete') }}" class="previous-btn">Previous</a>
                
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
                                    <th>Job  Title</th>
                                    <th>Job Group</th>
                                    
                                    
                                    <th>Start Date</th>
                                    <th>Deadline</th>
                                    <th>qualifications</th>
                                    <th>Status</th>
                                    <th>Number  of  Positions</th>
                                    <th>Apply</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $index =>$record)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                  
   <td>{{ $record->Designation }}</td>
   

                                    <td>{{ $record->Job_Group }}</td>
                                    
                                    <td>{{ $record->datefrom }}</td>
                                    <td>{{ $record->deadline }}</td>
                                    <td>
    @php
        $output = [];

        // Split by comma
        $items = explode(',', $record->qualifications);

        foreach ($items as $item) {
            // Extract key and value inside brackets
            if (preg_match('/(.*?)\[(.*?)\]/', trim($item), $matches)) {
                $key = trim($matches[1]);
                $value = trim($matches[2]);

                // Academic qualification (always show)
                if (stripos($key, 'Academic') !== false && $value !== '') {
                    $output[] = "<strong>Minimum Academic Qualification:</strong> {$value}";
                }

                // Professional Bodies
                if ($key === 'Professional Bodies' && $value == 1) {
                    $output[] = "Membership to a professional body is required";
                }

                // Association
                if ($key === 'Association' && $value == 1) {
                    $output[] = "Membership to a relevant association is required";
                }

                // Practising License
                if ($key === 'Practising License' && $value == 1) {
                    $output[] = "Valid practising license is required";
                }

                // Food Handlers Certificate
                if ($key === 'Food Handlers Certificate' && $value == 1) {
                    $output[] = "Food Handlers Certificate is required";
                }

                // Experience
                if ($key === 'Experience' && $value == 1) {
                    $output[] = "Relevant work experience is required";
                }
            }
        }
    @endphp

    {!! implode('<br>', $output) !!}
</td>

                                    
                                    <td>{{ $record->status }}</td>
                                    <td>{{ $record->Proposed_No_of_Positions }}</td>
                                    
                                  <td>
    @php
        $user = Auth::guard('HR')->user();

        /* ------------------ 1. ALREADY APPLIED CHECK ------------------ */
        $existingApplication = \App\Models\Application::where('Ref_No', $record->Ref_NO)
            ->where('upn_no', $user->upn_no)
            ->whereIn('status', ['Applied', 'Not Qualified', 'Qualified'])
            ->first();

        /* ------------------ 2. PRIORITY CHECK ------------------ */
        $hasPriority = ($user->job_code === $record->Ref_NO);

        /* ------------------ 3. PARSE QUALIFICATIONS STRING ------------------ */
        $qualString = $record->qualifications ?? '';
        $requirements = [];

        foreach (explode(',', $qualString) as $part) {
            if (preg_match('/(.*?)\[(.*?)\]/', trim($part), $matches)) {
                $requirements[trim($matches[1])] = trim($matches[2]);
            }
        }

        /* ------------------ 4. ACADEMIC RANKING ------------------ */
        $ranks = [
            'All' => 0,
            'O level' => 1,
            'A level' => 2,
            'Certificate' => 3,
            'Diploma' => 4,
            "Bachelor's Degree" => 5,
            "Master's Degree" => 6,
            "Doctorate" => 7,
        ];

        /* ------------------ 5. FETCH ALL USER RECORDS ------------------ */
        $userAcademics = \App\Models\Academic::where('upn_no', $user->upn_no)->pluck('level')->toArray();
        $userProfBodies = \App\Models\Profecionalbody::where('upn_no', $user->upn_no)->count();
        $userAssociations = \App\Models\Association::where('upn_no', $user->upn_no)->count();
        $userLicenses = \App\Models\Licence::where('upn_no', $user->upn_no)->count();
        $userMedical = \App\Models\Medical::where('upn_no', $user->upn_no)->count();
        $userExperience = \App\Models\Experience::where('upn_no', $user->upn_no)->count();

        /* ------------------ 6. DEFAULT ------------------ */
        $canApply = true;
        $failMessages = [];

        /* ------------------ 7. ACADEMIC CHECK ------------------ */
        if (isset($requirements['Academic']) && $requirements['Academic'] !== "All") {
            $requiredLevel = $requirements['Academic'];
            $reqRank = $ranks[$requiredLevel] ?? 999;

            if (empty($userAcademics)) {
                $canApply = false;
                $failMessages[] = "Minimum Academic Qualification required: <b>$requiredLevel</b>. No academic record found.";
            } else {
                $qualified = false;
                foreach ($userAcademics as $lvl) {
                    if (($ranks[$lvl] ?? -1) >= $reqRank) {
                        $qualified = true;
                        break;
                    }
                }
                if (!$qualified) {
                    $canApply = false;
                    $failMessages[] = "Academic requirement not met. Required: <b>$requiredLevel</b>. Your levels: <i>" . implode(', ', $userAcademics) . "</i>";
                }
            }
        }

        /* ------------------ 8. PROFESSIONAL BODY CHECK ------------------ */
        if (($requirements['Professional Bodies'] ?? 0) == 1 && $userProfBodies == 0) {
            $canApply = false;
            $failMessages[] = "Membership to a professional body is required.";
        }

        /* ------------------ 9. ASSOCIATION CHECK ------------------ */
        if (($requirements['Association'] ?? 0) == 1 && $userAssociations == 0) {
            $canApply = false;
            $failMessages[] = "You must belong to a relevant professional association.";
        }

        /* ------------------ 10. PRACTICING LICENSE CHECK ------------------ */
        if (($requirements['Practising License'] ?? 0) == 1 && $userLicenses == 0) {
            $canApply = false;
            $failMessages[] = "A valid professional practicing license is required.";
        }

        /* ------------------ 11. FOOD HANDLERS CERTIFICATE CHECK ------------------ */
        if (($requirements['Food Handlers Certificate'] ?? 0) == 1 && $userMedical == 0) {
            $canApply = false;
            $failMessages[] = "A valid Food Handlers Certificate is required.";
        }

        /* ------------------ 12. EXPERIENCE CHECK ------------------ */
        if (($requirements['Experience'] ?? 0) == 1 && $userExperience == 0) {
            $canApply = false;
            $failMessages[] = "Relevant work experience is required.";
        }

    @endphp

    {{-- ------------------ 13. FINAL BUTTON OUTPUT ------------------ --}}

    @if ($existingApplication)
        <button class="btn btn-sm" disabled style="background:#7f622c;color:#fff;">
            <i class="fa fa-check"></i> Already Applied
        </button>

    @elseif(!$canApply)
        <button class="btn btn-sm" disabled style="background:#a94442;color:white;text-align:left;max-width:250px;">
            <i class="fa fa-info-circle"></i>
            {!! implode('<br>• ', array_map(fn($msg) => "• $msg", $failMessages)) !!}
        </button>

    @else
        <a href="{{ route('JOB.Apply', ['s_no' => $record->s_no]) }}"
           class="btn btn-sm"
           style="background:rgb(203,211,0);color:black;">
            <i class="fa fa-check"></i> Apply
        </a>
    @endif
</td>


                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                     <tr>
                                    <th>S/NO.</th>
                                    <th>Job  Title</th>
                                    <th>Job Group</th>
                                    
                                    
                                    <th>Start Date</th>
                                    <th>Deadline</th>
                                    <th>qualifications</th>
                                    <th>Status</th>
                                    <th>Number  of  Positions</th>
                                    <th>Apply</th>
                                </tr>
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

@include('HR.Dashboard.footer')

