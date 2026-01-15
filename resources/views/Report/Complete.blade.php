@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')
<div class="page-wrapper">
    <div class="page-content">
<div class="container mt-4">
    <div class="ms-auto">
        <div class="d-flex justify-content-start mt-4">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; max-width: 320px;">
                <a href="{{ route('Research.Home') }}" class="prev-btn">Previous</a>
                <button id="nextButton" class="next-btn" onclick="validateConfirmation()">Next</button>
            </div>
            
            <style>
                /* Button General Styling */
                .prev-btn, .next-btn {
                    width: 150px; /* Ensures both buttons are the same width */
                    height: 45px; /* Uniform height */
                    font-size: 16px;
                    padding: 10px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    text-align: center;
                    transition: background-color 0.3s, color 0.3s, border 0.3s;
                }
            
                /* Previous Button Styling */
                .prev-btn {
                    background-color: rgb(127, 98, 44);
                    color: white;
                    text-decoration: none;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            
                .prev-btn:hover {
                    background-color: white;
                    color: rgb(127, 98, 44);
                    border: 2px solid rgb(127, 98, 44);
                }
            
                /* Next Button Styling */
                .next-btn {
                    background-color: rgb(203, 211, 0);
                    color: black;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            
                .next-btn:hover {
                    background-color: white;
                    color: black;
                    border: 2px solid rgb(203, 211, 0);
                }
            </style>
            
            
            </div>
        </div>
        <br>
        <br>
        <div class="card shadow-lg">
            <div class="card-header text-center" style="background-color: rgb(203, 211, 0); color: rgb(127, 98, 44);">
                <h4 class="mb-0">User Report</h4>
            </div>
            
            
            <div class="card-body">
                <!-- User Information -->
                <h5 class="mb-3" style="color: rgb(127, 98, 44); font-weight: bold;"><i class="bi bi-person-circle"></i> User Bio Data</h5>
                <div class="mt-4 p-4 border rounded bg-light hover-shadow">
                    <div class="form-check" id="confirmationSection">
                        <input class="form-check-input brown-radio" type="checkbox" id="confirmDataCheckbox">
                        <label class="form-check-label brown-text" for="confirmDataCheckbox">
                            <i class="bi bi-check-circle-fill brown-icon me-2"></i>
                            I confirm that the data I have updated is correct. I wish to release my profile in order to proceed with job application.
                        </label>
                    </div>
                    <hr style="border-color: rgba(127, 98, 44, 0.2);">

        <!-- Data Privacy Header -->
        <h6 class="fw-bold mb-3" style="color: rgb(127, 98, 44);">
            <i class="bi bi-shield-lock-fill me-2"></i>
            Data Privacy Statement
        </h6>
        
        <!-- Privacy Statement -->
        <p class="mb-3" style="font-style: italic;">
            We endeavour to ensure that the data you submit to us remains confidential 
            and is used only for the purposes stated in the data privacy statement.
        </p>
        
        <!-- Data Privacy Link -->
        <div class="mb-3">
            <a href="" target="_blank" 
               style="color: rgb(127, 98, 44); text-decoration: underline;"
               class="d-flex align-items-center">
                <i class="bi bi-file-text-fill me-2"></i>Data Privacy Statement
            </a>
        </div>
        
        <!-- Privacy Acceptance Checkbox (Now Second) -->
        <div class="form-check">
            <input class="form-check-input brown-radio" type="checkbox" id="acceptPrivacyCheckbox">
            <label class="form-check-label brown-text" for="acceptPrivacyCheckbox">
                <i class="bi bi-check-circle-fill brown-icon me-2"></i>
                Yes, I have read the data privacy statement and I accept it.
            </label>
        </div>
                </div>
                 <div id="customAlert" class="alert alert-danger" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                    <strong>Error!</strong> You must confirm that all your data is correct before proceeding.
                </div>
                <script>
                    function validateConfirmation() {
                        const privacyCheckbox = document.getElementById('acceptPrivacyCheckbox');
                        const dataCheckbox = document.getElementById('confirmDataCheckbox');
                        const confirmationSection = document.getElementById('confirmationSection');
                        const customAlert = document.getElementById('customAlert');
                        let errorMessage = '';
                    
                        // Check which checkboxes are not checked
                        if (!dataCheckbox.checked && !privacyCheckbox.checked) {
                            errorMessage = 'You must confirm your data and accept the privacy statement before proceeding.';
                        } else if (!dataCheckbox.checked) {
                            errorMessage = 'You must confirm your data is correct before proceeding.';
                        } else if (!privacyCheckbox.checked) {
                            errorMessage = 'You must accept the data privacy statement before proceeding.';
                        }
                    
                        // If any checkbox is not checked
                        if (errorMessage) {
                            customAlert.innerHTML = `<strong>Error!</strong> ${errorMessage}`;
                            customAlert.style.display = 'block';
                            confirmationSection.classList.add('blink-red');
                    
                            // Hide the alert and remove the blinking effect after 5 seconds
                            setTimeout(() => {
                                customAlert.style.display = 'none';
                                confirmationSection.classList.remove('blink-red');
                            }, 5000);
                    
                            return; // Stop further execution
                        }
                    
                        // If all checkboxes are checked, proceed to the next page
                        location.href = "{{ route('JOB.applicants') }}";
                    }
                    </script>
                    
                    <style>
                    /* Blinking effect for the confirmation section */
                    @keyframes blink {
                        0% { border-color: red; }
                        50% { border-color: transparent; }
                        100% { border-color: red; }
                    }
                    
                    .blink-red {
                        border: 2px solid red;
                        animation: blink 1s linear infinite;
                        padding: 10px;
                        border-radius: 5px;
                    }
                    
                    /* Hover effects */
                    .hover-shadow:hover {
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        transition: box-shadow 0.3s ease;
                    }
                    
                    /* Brown color styles */
                    .brown-radio { accent-color: brown; }
                    .brown-text { color: brown; }
                    .brown-icon { color: brown; }
                    
                    /* Link styling */
                    a {
                        color: rgb(127, 98, 44);
                        text-decoration: none;
                        transition: color 0.3s;
                    }
                    a:hover {
                        color: rgb(203, 211, 0);
                        text-decoration: underline;
                    }
                    
                    /* Divider styling */
                    hr {
                        margin: 1.5rem 0;
                        opacity: 0.5;
                    }
                    </style>
                <br>
                <br>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->name }}" readonly />
                            <label>Full Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->upn_no }}" readonly />
                            <label>Payroll  Number</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->job_group }}" readonly />
                            <label>Job  Group</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->campus }}" readonly />
                            <label>Campus</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->email }}" readonly />
                            <label>Email</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->idnumber }}" readonly />
                            <label>ID/Passport No</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->phone }}" readonly />
                            <label>Phone Contact</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->gender }}" readonly />
                            <label>Gender</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->disability }}" readonly />
                            <label>Any Disability</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->ethnicity }}" readonly />
                            <label>Ethnicity</label>
                        </div>
                    </div>
<div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->dob }}" readonly />
                            <label>Date of  Birth</label>
                        </div>
                    </div>

                </div>
        
                <!-- Confirmation Checkbox -->
                
        
                <!-- Next Button (Hidden by Default) -->
                
            </div>
        </div>
        
        <script>
            // JavaScript to show/hide the Next button based on checkbox state
            document.getElementById('confirmDataCheckbox').addEventListener('change', function () {
                const nextButtonContainer = document.getElementById('nextButtonContainer');
                if (this.checked) {
                    nextButtonContainer.style.display = 'block'; // Show the Next button
                } else {
                    nextButtonContainer.style.display = 'none'; // Hide the Next button
                }
            });
        </script>

            <!-- Academic Qualifications -->
            <h5 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;"><i class="bi bi-mortarboard"></i> Academic Qualifications</h5>
            <div class="table-responsive">
                <table id="example" class="table mb-0">
                    
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Education Type</th>
                            <th>Institution</th>
                            <th>Course</th>
                            <th>Level</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Grade</th>
                            <th>Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($academics as $index => $academic)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $academic->Education_type }}</td>
                            <td>{{ $academic->institution }}</td>
                            <td>{{ $academic->course }}</td>
                            <td>{{ $academic->level }}</td>
                            <td>{{ date('d M Y', strtotime($academic->stdate)) }}</td>
                            <td>{{ date('d M Y', strtotime($academic->enddate)) }}</td>
                            <td>{{ $academic->grade }}</td>
                            <td>
                                @if($academic->document_name)
    <a href="{{ asset('uploads/Academic/' . $academic->document_name) }}" 
       target="_blank" 
       class="btn btn-sm btn-success">
       <i class="bi bi-book"></i> View
    </a>
@else
    <span class="text-danger">No Document</span>
@endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No academic records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            

            <!-- Work Experience -->
            <h5 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;"><i class="bi bi-briefcase"></i> Work Experience</h5>
            <div class="table-responsive">
                <table id="example" class="table mb-0">
                    
                    <thead class="table-light">
                        <tr>
                            
                            <th>Employer</th>
                            <th>Job Title</th>
                            <th>Country</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <th>Job Description</th>
                            <th>Duties  and  Responsibilities</th>
                            <th>Special Activity Under Undertaken</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($experiences as $experience)
                        <tr>
                            <td>{{ $experience->employer }}</td>
                            <td>{{ $experience->job_title }}</td>
                            <td>{{ $experience->country }}</td>
                            <td>{{ date('d M Y', strtotime($experience->stdate)) }}</td>
                            <td>{{ date('d M Y', strtotime($experience->enddate)) }}</td>
                            <td>{{ $experience->location }}</td>
                            <td>{{ $experience->expartise }}</td>
                            <td>{{ $experience->duties }}</td>
                        <td>{{ $experience->special }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No work experience records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                 <h5 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;"><i class="bi bi-briefcase"></i> Teaching  Experience</h5>
                 <div class="table-responsive">
                        <table id="example" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Teaching </th>
                                    <th>Employer</th>
                                    <th>Designation</th>
                                    <th>Country</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Location</th>
                                    <th>Job Description</th>
                                    <th>Duties  and  Responsibilities</th>
                                   <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachings as $experience)
                    <tr>
                        <td>{{ $experience->teaching_areas }}</td>
                        <td>{{ $experience->employer }}</td>
                        <td>{{ $experience->job_title }}</td>
                        <td>{{ $experience->country }}</td>
                        <td>{{ $experience->stdate }}</td>
                        <td>{{ $experience->enddate }}</td>
                        <td>{{ $experience->location }}</td>
                        <td>{{ $experience->duties}}</td>
                        
                        <td>{{ $experience->achievements }}</td>
                        
                       <td>
    @if($experience->teaching_path)
        <a href="{{ asset('/' . $experience->teaching_path) }}" 
           class="btn btn-outline-primary btn-sm animate-download" 
           download>
            <i class="fas fa-download"></i> 
        </a>
    @else
        <span class="text-muted">No file</span>
    @endif
</td>

<style>
    .animate-download {
        position: relative;
        transition: all 0.3s ease;
    }

    .animate-download:hover {
        background-color: #007bff;
        color: white;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
        transform: scale(1.05);
    }

    .animate-download i {
        margin-right: 5px;
    }
</style>

                        
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('teaching.destroy', $experience->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>

                        </td>
                        
                    </tr>
                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                   
                <div class="container mt-5">
                    <!-- Core Mandate Section -->
                    <div class="mb-5">
                        <h2 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;">Consultancy and Research</h2>
                        <p class="text-muted">This is your Consultancy and Research achieved.</p>
                        <div class="table-responsive">
                            <table id="example" class="table mb-0">
                                
                                <thead class="table-light">
                                <tr>
                                    
                                <th>#</th>
       
        <th>Client</th>
        <th>Sector</th>
        <th>Completed</th>
        <th>Completion Date</th>
        <th>Amount</th>
        <th>File</th>
        
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @forelse($others as $index => $other)
        <tr>
            <td>{{ $index + 1 }}</td>
           
            <td>{{ $other->Client }}</td>
            <td>{{ $other->Sector }}</td>
            <td>{{ $other->completed }}</td>
            <td>{{ \Carbon\Carbon::parse($other->compedate)->format('d M Y') }}</td>
            <td>{{ $other->Amount ?? 'N/A' }}</td>
            <td>
                                        @if($other->document_name)
                                        <a href="{{ asset('uploads/Other/' . $other->document_name) }}" 
                                            target="_blank" 
                                            class="btn btn-sm view-button">
                                            <i class="bi bi-book"></i> View
                                         </a>
                                         
                                         <style>
                                             /* View Button */
                                             .view-button {
                                                 background-color: rgb(203, 211, 0); /* Yellowish-green color */
                                                 color: black; /* Default text color */
                                                 border: none;
                                                 border-radius: 5px;
                                                 cursor: pointer;
                                                 transition: background-color 0.3s ease, color 0.3s ease;
                                             }
                                         
                                             /* Hover effect */
                                             .view-button:hover {
                                                 background-color: white; /* Turns white on hover */
                                                 color: black; /* Black text on hover */
                                                 border: 1px solid black;
                                             }
                                         </style>
                                         
                                        @else
                                            <span class="text-danger">No Document</span>
                                        @endif
                                    </td>
            
            <td>
                <form action="{{ route('Experience.Researchdestroyother', $other->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center text-muted">No records found.</td>
        </tr>
    @endforelse
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Licenses Section -->
                    <div class="mb-5">
                        <h2 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;"> Practising Licences</h2>
                        <p class="text-muted">This is your licences data.</p>
                        <div class="table-responsive">
                            <table id="example" class="table mb-0">
                                
                                <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                   
                                    <th>Name</th>
                                    <th>I have a licence</th>
                                    <th>License Name</th>
                                    <th>License Date</th>
                                    <th>Document</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($licence as $licence)
                                    <tr>
                                        <td>{{ $licence->id }}</td>
                                        
                                        <td>{{ $licence->name }}</td>
                                        <td>{{ $licence->has_license ?? 'N/A' }}</td>
                                        <td>{{ $licence->license_name ?? 'N/A' }}</td>
                                        <td>{{ $licence->license_date ?? 'N/A' }}</td>
                                        <td>
                                            @if($licence->document_name)
                                                <a href="{{ asset('uploads/Licence/' . $licence->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    View Document
                                                </a>
                                            @else
                                                No Document
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('licence.destroy', $licence->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Professional Body Section -->
                    <div class="mb-5">
                        <h2  class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;">Professional Body</h2>
                        <p class="text-muted">This is your professional body data.</p>
                        <div class="table-responsive">
                        <table id="example1" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>I am a member</th>
                                    <th>Professional Body Name</th>
                                    <th>Regulating Law/Statute</th>
                                    <th>Status</th>
                                    <th>Certificate</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($profecionalbodies as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->is_member }}</td>
                                        <td>{{ $data->professional_body }}</td>
                                        <td>{{ $data->law }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                            @if($data->document_name)
                                                <a href="{{ asset('uploads/Profecionalbody/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    View Document
                                                </a>
                                            @else
                                                No Document
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('Profecionalbody.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Medical Section -->
                    <div class="mb-5">
                        <h2  class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;">Food handler  Certificate</h2>
                        <p class="text-muted">This is My Food handler  Certificate.</p>
                        <div class="table-responsive">
                        <table id="example" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    
                                    <th>Examination Name</th>
                                    <th>I have</th>
                                    
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Document</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medical as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                       
                                        <td>{{ $data->name_exam }}</td>
                                        <td>{{ $data->condition ?? 'N/A' }}</td>
                                        <td>{{ $data->date ?? 'N/A' }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                            @if($data->document_name)
                                                <a href="{{ asset('uploads/Medical/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    View Document
                                                </a>
                                            @else
                                                No Document
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('Medical.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Association Section -->
                    <div class="mb-5">
                        <h2 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;">Association</h2>
                        <p class="text-muted">This is your association data.</p>
                        <div class="table-responsive">
                        <table id="example" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                   
                                    <th>Am I a member</th>
                                    <th>Association Name</th>
                                    <th>Membership Status</th>
                                    <th>Document</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($associations as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        
                                        <td>{{ $data->condition }}</td>
                                        <td>{{ $data->association_name }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                            @if($data->document_name)
                                                <a href="{{ asset('uploads/Association/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    View Document
                                                </a>
                                            @else
                                                No Document
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('Association.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                {{-- ================= CONSULTANCY ASSIGNMENTS ================= --}}
<h5 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;">
    <i class="bi bi-briefcase-fill"></i> Consultancy Assignments
</h5>

<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Sector</th>
                <th>Completed</th>
                <th>Completion Date</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @forelse($other as $index => $record)
                @if(is_object($record))
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $record->Client ?? 'N/A' }}</td>
                    <td>{{ $record->Sector ?? 'N/A' }}</td>
                    <td>{{ $record->completed ?? 'N/A' }}</td>
                    <td>{{ !empty($record->compedate) ? \Carbon\Carbon::parse($record->compedate)->format('d M Y') : 'N/A' }}</td>
                    <td>
                        @if(!empty($record->document_name))
                            <a href="{{ asset('uploads/Other/' . $record->document_name) }}" target="_blank">View</a>
                        @else
                            <span class="text-muted">No Document</span>
                        @endif
                    </td>
                </tr>
                @endif
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ================= RESEARCH ASSIGNMENTS ================= --}}
<h5 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;">
    <i class="bi bi-journal-text"></i> Research Assignments
</h5>

<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Sector</th>
                <th>Completed</th>
                <th>Completion Date</th>
                <th>Amount</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @forelse($others as $index => $record)
                @if(is_object($record))
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $record->Client ?? 'N/A' }}</td>
                    <td>{{ $record->Sector ?? 'N/A' }}</td>
                    <td>{{ $record->completed ?? 'N/A' }}</td>
                    <td>{{ !empty($record->compedate) ? \Carbon\Carbon::parse($record->compedate)->format('d M Y') : 'N/A' }}</td>
                    <td>{{ $record->Amount ?? 'N/A' }}</td>
                    <td>
                        @if(!empty($record->document_name))
                            <a href="{{ asset('uploads/Other/' . $record->document_name) }}" target="_blank">View</a>
                        @else
                            <span class="text-muted">No Document</span>
                        @endif
                    </td>
                </tr>
                @endif
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ================= PUBLICATIONS ================= --}}
<h5 class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;">
    <i class="bi bi-book"></i> Publications
</h5>

<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Journal / Publisher</th>
                <th>Type / Title</th>
                <th>Publication Date</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @forelse($publications as $index => $pub)
                @if(is_object($pub))
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pub->Client ?? 'N/A' }}</td>
                    <td>{{ $pub->completed ?? 'N/A' }}</td>
                    <td>{{ !empty($pub->compedate) ? \Carbon\Carbon::parse($pub->compedate)->format('d M Y') : 'N/A' }}</td>
                    <td>
                        @if(!empty($pub->document_name))
                            <a href="{{ asset('uploads/Other/' . $pub->document_name) }}" target="_blank">View</a>
                        @else
                            <span class="text-muted">No Document</span>
                        @endif
                    </td>
                </tr>
                @endif
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No publications found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

                <div class="container mt-4">
                    <h4  class="mt-4" style="color: rgb(127, 98, 44); font-weight: bold;">User Report</h4>
                
                    <div class="card">
                        <div class="card-body">
                            <iframe src="{{ route('user.report') }}" width="100%" height="800px" style="border: none;"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('HR.Dashboard.footer')
