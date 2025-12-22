@include('admin.Dashboard.header')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Applicats  </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                           
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
                
            </div> <!--end breadcrumb-->

            
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            <a href="/" class="btn btn-light radius-30 mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i>
                            </a>
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

    <!-- User Information -->
    <h5 class="text-primary mb-3"><i class="bi bi-person-circle"></i> User Bio Data</h5>
   

    
    
    <style>
        /* Hover effect for the container */
        .hover-shadow:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle shadow on hover */
            transition: box-shadow 0.3s ease; /* Smooth transition */
        }
    
        /* Brown color for the checkbox */
        .brown-radio {
            accent-color: brown; /* Changes the color of the checkbox */
        }
    
        /* Brown color for the text */
        .brown-text {
            color: brown; /* Changes the text color to brown */
        }
    
        /* Brown color for the icon */
        .brown-icon {
            color: brown; /* Changes the icon color to brown */
        }
    </style>
    <br>
    <br>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" value="{{ $hr->name }}" readonly />
                <label>Full Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" value="{{$hr->campus }}" readonly />
                <label>Campus</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" value="{{ $hr->email }}" readonly />
                <label>Email</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" value="{{$hr->idnumber }}" readonly />
                <label>ID/Passport No</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" value="{{ $hr->phone }}" readonly />
                <label>Phone Contact</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" value="{{ $hr->gender }}" readonly />
                <label>Gender</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" value="{{ $hr->disability }}" readonly />
                <label>Any Disability</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" value="{{ $hr->ethnicity }}" readonly />
                <label>Ethnicity</label>
            </div>
        </div>
    </div>

    <!-- Confirmation Checkbox -->
    

    <!-- Next Button (Hidden by Default) -->
    
</div>
</div>
<button id="toggleTableBtn" class="btn btn-primary mb-3">
    <i class="bi bi-table"></i> Show Academic Qualifications
</button>
<button id="toggleWorkExperienceBtn" class="btn btn-warning mb-3">
    <i class="bi bi-table"></i> Show Work Experience
</button>
<button id="toggleCoreMandateBtn" class="btn btn-danger mb-3">
    <i class="bi bi-table"></i> Show Core Mandates
</button>
<button id="toggleLicenceTableBtn" class="btn btn-secondary mb-3">
    <i class="bi bi-table"></i> Show Licenses
</button>
<button id="toggleProfessionalBodyTableBtn" class="btn btn-dark mb-3">
    <i class="bi bi-table"></i> Show Professional Body Data
</button>
<button id="toggleMedicalTableBtn" class="btn btn-info mb-3">
    <i class="bi bi-table"></i> Pick Medical Data
</button>
<button id="toggleAssociationTableBtn" class="btn btn-success mb-3">
    <i class="bi bi-table"></i> Show Association Data
</button>
<div class="table-responsive">
    <table id="example2" class="table mb-0">
        <thead class="table-light">
            <tr>
                <th>Ref No</th>
                <th>Designation</th>
                <th>Job Group</th>
                <th>Status</th>
                <th>Advatised Group</th>
                <th>Applied On</th>
                <th>CV</th>
                <th>Bio Data</th>
                <th>Cover Letter</th>
                <th>Qualify</th>
                <th>Not Qualified</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
            <tr>
                <td>{{ $application->Ref_No }}</td>
    <td>{{ $application->designation }}</td>
    <td>{{ $application->job_group }}</td>
    <td>{{ $application->status }}</td>
    <td>{{ $application->Expected }}</td>
    <td>{{ \Carbon\Carbon::parse($application->datetime)->format('d M Y, h:i A') }}</td>
    <td>
        @if ($application->cv)
            <!-- Button to trigger the CV modal -->
            <button type="button" 
                    class="btn btn-info btn-sm" 
                    data-toggle="modal" 
                    data-target="#cvModal{{ $application->id }}">
                <i class="fa fa-file-pdf"></i> CV
            </button>
    
            <!-- CV Modal -->
            <div class="modal fade" id="cvModal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel{{ $application->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cvModalLabel{{ $application->id }}">CV Viewer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(pathinfo($application->cv, PATHINFO_EXTENSION) === 'pdf')
                                <!-- PDF Viewer using iframe -->
                                <iframe src="{{ asset($application->cv) }}" 
                                        width="100%" 
                                        height="500px" 
                                        style="border: none;">
                                </iframe>
                            @else
                                <!-- Display an image for non-PDF files -->
                                <img src="{{ asset($application->cv) }}" 
                                     alt="CV" 
                                     class="img-fluid">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <span class="text-danger">No CV</span>
        @endif
    </td>
    
    <td>
        @if ($application->my_bio)
            <!-- Button to trigger the Bio modal -->
            <button type="button" 
                    class="btn btn-dark btn-sm" 
                    data-toggle="modal" 
                    data-target="#bioModal{{ $application->id }}">
                <i class="fa fa-file-pdf"></i> Bio
            </button>
    
            <!-- Bio Modal -->
            <div class="modal fade" id="bioModal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="bioModalLabel{{ $application->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bioModalLabel{{ $application->id }}">Bio Viewer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(pathinfo($application->my_bio, PATHINFO_EXTENSION) === 'pdf')
                                <!-- PDF Viewer using iframe -->
                                <iframe src="{{ asset($application->my_bio) }}" 
                                        width="100%" 
                                        height="500px" 
                                        style="border: none;">
                                </iframe>
                            @else
                                <!-- Display an image for non-PDF files -->
                                <img src="{{ asset($application->my_bio) }}" 
                                     alt="Bio" 
                                     class="img-fluid">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <span class="text-danger">No Bio</span>
        @endif
    </td>
    
    <td>
        @if ($application->cover_letter)
            <!-- Button to trigger the Cover Letter modal -->
            <button type="button" 
                    class="btn btn-warning btn-sm" 
                    data-toggle="modal" 
                    data-target="#coverLetterModal{{ $application->id }}">
                <i class="fa fa-file-pdf"></i> Cover Letter
            </button>
    
            <!-- Cover Letter Modal -->
            <div class="modal fade" id="coverLetterModal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="coverLetterModalLabel{{ $application->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="coverLetterModalLabel{{ $application->id }}">Cover Letter Viewer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(pathinfo($application->cover_letter, PATHINFO_EXTENSION) === 'pdf')
                                <!-- PDF Viewer using iframe -->
                                <iframe src="{{ asset($application->cover_letter) }}" 
                                        width="100%" 
                                        height="500px" 
                                        style="border: none;">
                                </iframe>
                            @else
                                <!-- Display an image for non-PDF files -->
                                <img src="{{ asset($application->cover_letter) }}" 
                                     alt="Cover Letter" 
                                     class="img-fluid">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <span class="text-danger">No Cover Letter</span>
        @endif
    </td>
    <td>
        <!-- Green button to trigger the modal -->
        <button type="button" 
                class="btn btn-success btn-sm" 
                data-toggle="modal" 
                data-target="#interviewModal{{ $application->id }}">
            <i class="fa fa-calendar"></i> Schedule Interview
        </button>
    
        <!-- Interview Modal -->
        <div class="modal fade" id="interviewModal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel{{ $application->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="interviewModalLabel{{ $application->id }}">Schedule Interview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for interview details -->
                        <form action="{{ route('schedule.interview', $application->id) }}" method="POST">
                            @csrf
                            <!-- Venue Input -->
                            <div class="form-group">
                                <label for="interviewVenue{{ $application->id }}">Interview date</label>
                                <input type="datetime-local"
                                       class="form-control" 
                                       id="interviewVenue{{ $application->id }}" 
                                       name="intervew" 
                                       placeholder="date" 
                                       required>
                            </div>
                            <!-- Location Dropdown -->
                            <div class="form-group">
                                <label for="interviewVenue{{ $application->id }}">Interview Venue</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="interviewVenue{{ $application->id }}" 
                                       name="venue" 
                                       placeholder="Enter venue" 
                                       required>
                                <!-- Map Container -->
                               
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Schedule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </td>
    
  
        <!-- Red button to trigger the modal -->
        <td>
            <!-- Red button to trigger the Not Qualified modal -->
            <button type="button" 
                    class="btn btn-danger btn-sm" 
                    data-toggle="modal" 
                    data-target="#notQualifiedModal{{ $application->id }}">
                <i class="fa fa-times"></i> Not Qualified
            </button>
      
        <!-- Not Qualified Modal -->
<div class="modal fade" id="notQualifiedModal{{ $application->id }}" tabindex="-1" role="dialog" aria-labelledby="notQualifiedModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="notQualifiedModalLabel{{ $application->id }}">Not Qualified</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for rejection details -->
                <form action="{{ route('reject.application', $application->id) }}" method="POST">
                    @csrf
                    <!-- Rejection Reason Textarea -->
                    <div class="form-group">
                        <label for="rejectionReason{{ $application->id }}">Rejection Reason</label>
                        <textarea class="form-control" 
                                  id="rejectionReason{{ $application->id }}" 
                                  name="rejection_reason" 
                                  rows="4" 
                                  placeholder="Enter the reason for rejection" 
                                  required></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-right">
                        <button type="submit" class="btn btn-danger">Reject Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </td>
    
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Ref No</th>
                <th>Designation</th>
                <th>Job Group</th>
                <th>Status</th>
                <th>Advatised Group</th>
                <th>Applied On</th>
                <th>CV</th>
                <th>Bio Data</th>
                <th>Cover Letter</th>
                <th>Qualify</th>
                <th>Not Qualified</th>
                
            </tr>
        </tfoot>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggleTableBtn');
        const academicTable = document.getElementById('academicTable');

        toggleBtn.addEventListener('click', function () {
            if (academicTable.style.display === 'none') {
                academicTable.style.display = 'block';
                toggleBtn.innerHTML = '<i class="bi bi-table"></i> Hide Academic Qualifications';
            } else {
                academicTable.style.display = 'none';
                toggleBtn.innerHTML = '<i class="bi bi-table"></i> Show Academic Qualifications';
            }
        });
    });
</script>

<div class="table-responsive" id="academicTable" style="display: none;">
    <h5 class="text-primary mt-4"><i class="bi bi-mortarboard"></i> Academic Qualifications</h5>
    <table id="example2" class="table mb-0">
        
        <thead class="table-dark">
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
                        <!-- Button to trigger the document viewer modal -->
                        <button type="button" 
                                class="btn btn-sm btn-success" 
                                data-toggle="modal" 
                                data-target="#documentModal{{ $academic->id }}">
                            <i class="bi bi-book"></i> View
                        </button>
        
                        <!-- Modal for document viewer -->
                        <div class="modal fade" id="documentModal{{ $academic->id }}" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel{{ $academic->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="documentModalLabel{{ $academic->id }}">Document Viewer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if(pathinfo($academic->document_name, PATHINFO_EXTENSION) === 'pdf')
                                            <!-- PDF Viewer using iframe -->
                                            <iframe src="{{ asset('uploads/Academic/' . $academic->document_name) }}" 
                                                    width="100%" 
                                                    height="500px" 
                                                    style="border: none;">
                                            </iframe>
                                        @else
                                            <!-- Display a download link for non-PDF files -->
                                            <p>This document cannot be previewed. Please download it to view.</p>
                                            <a href="{{ asset('uploads/Academic/' . $academic->document_name) }}" 
                                               download 
                                               class="btn btn-primary">
                                                <i class="bi bi-download"></i> Download Document
                                            </a>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <span class="text-danger">No Document</span>
                    @endif
                </td>
            </tr>
        @empty
           
        @endforelse
        </tbody>
       
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggleWorkExperienceBtn');
        const workExperienceTable = document.getElementById('workExperienceTable');

        toggleBtn.addEventListener('click', function () {
            if (workExperienceTable.style.display === 'none') {
                workExperienceTable.style.display = 'block';
                toggleBtn.innerHTML = '<i class="bi bi-table"></i> Hide Work Experience';
            } else {
                workExperienceTable.style.display = 'none';
                toggleBtn.innerHTML = '<i class="bi bi-table"></i> Show Work Experience';
            }
        });
    });
</script>

<div class="table-responsive" id="workExperienceTable" style="display: none;">
    <h5 class="text-primary mt-4"><i class="bi bi-briefcase"></i> Work Experience</h5>
    <table id="example2" class="table mb-0">
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
               
                
            </tr>
        </thead>
        <tbody>
            @foreach($experiences as $experience)
<tr>
    <td>{{ $experience->employer }}</td>
    <td>{{ $experience->job_title }}</td>
    <td>{{ $experience->country }}</td>
    <td>{{ $experience->stdate }}</td>
    <td>{{ $experience->enddate }}</td>
    <td>{{ $experience->location }}</td>
    <td>{{ $experience->expartise }}</td>
    <td>{{ $experience->duties }}</td>
    
    
    
</tr>
@endforeach
        </tbody>
        
    </table>
</div><script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggleCoreMandateBtn');
        const coreMandateTable = document.getElementById('coreMandateTable');

        toggleBtn.addEventListener('click', function () {
            if (coreMandateTable.style.display === 'none') {
                coreMandateTable.style.display = 'block';
                toggleBtn.innerHTML = '<i class="bi bi-table"></i> Hide Core Mandates';
            } else {
                coreMandateTable.style.display = 'none';
                toggleBtn.innerHTML = '<i class="bi bi-table"></i> Show Core Mandates';
            }
        });
    });
</script>

                        <div class="table-responsive"  id="coreMandateTable" style="display: none;">
                            <p class="text-muted">This is your core mandates achieved.</p>
                            <table id="example2" class="table mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>UPN No</th>
                                    <th>Email</th>
                                    <th>Job Group</th>
                                    <th>Core Mandate</th>
                                    <th>Selected Count</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coremandates as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->upn_no }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->job_group ?? 'N/A' }}</td>
                                        <td>{{ $item->comandate ?? 'N/A' }}</td>
                                        <td>{{ $item->selected_count ?? 'N/A' }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->status }}</td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const toggleBtn = document.getElementById('toggleLicenceTableBtn');
                            const licenceTable = document.getElementById('licenceTable');
                    
                            toggleBtn.addEventListener('click', function () {
                                if (licenceTable.style.display === 'none') {
                                    licenceTable.style.display = 'block';
                                    toggleBtn.innerHTML = '<i class="bi bi-table"></i> Hide Licenses';
                                } else {
                                    licenceTable.style.display = 'none';
                                    toggleBtn.innerHTML = '<i class="bi bi-table"></i> Show Licenses';
                                }
                            });
                        });
                    </script>
                    
                    <div class="table-responsive" id="licenceTable" style="display: none;">
                        <p class="text-muted">This is your licenses data.</p>
                        <table id="example2" class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>UPN No</th>
                                <th>Name</th>
                                <th>I have a licence</th>
                                <th>License Name</th>
                                <th>License Date</th>
                                <th>Document</th>
                                <th>View Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($licences as $licence)
    <tr>
        <td>{{ $licence->id }}</td>
        <td>{{ $licence->upn_no }}</td>
        <td>{{ $licence->name }}</td>
        <td>{{ $licence->has_license ?? 'N/A' }}</td>
        <td>{{ $licence->license_name ?? 'N/A' }}</td>
        <td>{{ $licence->license_date ?? 'N/A' }}</td>
        <td>
            @if($licence->document_name)
            <!-- Button to trigger the document viewer modal -->
            <button type="button" 
                    class="btn btn-sm btn-primary" 
                    data-toggle="modal" 
                    data-target="#documentModal{{ $licence->id }}">
                <i class="bi bi-file-earmark"></i> View Document
            </button>
        
            <!-- Modal for document viewer -->
            <div class="modal fade" id="documentModal{{ $licence->id }}" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel{{ $licence->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="documentModalLabel{{ $licence->id }}">Document Viewer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(in_array(pathinfo($licence->document_name, PATHINFO_EXTENSION), ['pdf', 'jpg', 'jpeg', 'png', 'gif']))
                                <!-- PDF or image viewer -->
                                @if(pathinfo($licence->document_name, PATHINFO_EXTENSION) === 'pdf')
                                    <!-- PDF Viewer using iframe -->
                                    <iframe src="{{ asset('uploads/Licence/' . $licence->document_name) }}" 
                                            width="100%" 
                                            height="500px" 
                                            style="border: none;">
                                    </iframe>
                                @else
                                    <!-- Display an image for non-PDF files -->
                                    <img src="{{ asset('uploads/Licence/' . $licence->document_name) }}" 
                                         alt="Document" 
                                         class="img-fluid">
                                @endif
                            @else
                                <!-- Download link for unsupported file types -->
                                <p>This document cannot be previewed. Please download it to view.</p>
                                <a href="{{ asset('uploads/Licence/' . $licence->document_name) }}" 
                                   download 
                                   class="btn btn-primary">
                                    <i class="bi bi-download"></i> Download Document
                                </a>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <span class="text-danger">No Document</span>
        @endif
        </td>
        <td>
            @if($licence->document_name)
                <a href="{{ asset('uploads/Licence/' . $licence->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                    View Document
                </a>
            @else
                No Document
            @endif
        </td>
    </tr>
@endforeach
</tbody>
</table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggleProfessionalBodyTableBtn');
        const professionalBodyTable = document.getElementById('professionalBodyTable');

        toggleBtn.addEventListener('click', function () {
            if (professionalBodyTable.style.display === 'none') {
                professionalBodyTable.style.display = 'block';
                toggleBtn.innerHTML = '<i class="bi bi-table"></i> Hide Professional Body Data';
            } else {
                professionalBodyTable.style.display = 'none';
                toggleBtn.innerHTML = '<i class="bi bi-table"></i> Show Professional Body Data';
            }
        });
    });
</script>
<div class="table-responsive" id="professionalBodyTable" style="display: none;">
    <p class="text-muted">This is your professional body data.</p>
                      
                        <table id="example1" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>I am a member</th>
                                    <th>Professional Body Name</th>
                                    <th>Regulating Law/Statute</th>
                                    <th>Status</th>
                                    <th>Certificate</th>
                                    <th>Read</th>
                                   
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
    <!-- Button to trigger the document viewer modal -->
    <button type="button" 
            class="btn btn-sm btn-primary" 
            data-toggle="modal" 
            data-target="#documentModal{{ $data->id }}">
        <i class="bi bi-file-earmark"></i> View Document
    </button>

    <!-- Modal for document viewer -->
    <div class="modal fade" id="documentModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel{{ $data->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentModalLabel{{ $data->id }}">Document Viewer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(in_array(pathinfo($data->document_name, PATHINFO_EXTENSION), ['pdf', 'jpg', 'jpeg', 'png', 'gif']))
                        <!-- PDF or image viewer -->
                        @if(pathinfo($data->document_name, PATHINFO_EXTENSION) === 'pdf')
                            <!-- PDF Viewer using iframe -->
                            <iframe src="{{ asset('uploads/Profecionalbody/' . $data->document_name) }}" 
                                    width="100%" 
                                    height="500px" 
                                    style="border: none;">
                            </iframe>
                        @else
                            <!-- Display an image for non-PDF files -->
                            <img src="{{ asset('uploads/Profecionalbody/' . $data->document_name) }}" 
                                 alt="Document" 
                                 class="img-fluid">
                        @endif
                    @else
                        <!-- Download link for unsupported file types -->
                        <p>This document cannot be previewed. Please download it to view.</p>
                        <a href="{{ asset('uploads/Profecionalbody/' . $data->document_name) }}" 
                           download 
                           class="btn btn-primary">
                            <i class="bi bi-download"></i> Download Document
                        </a>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@else
    <span class="text-danger">No Document</span>
@endif
                                        </td>
                                        <td>
                                            @if($data->document_name)
                                                <a href="{{ asset('uploads/Profecionalbody/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    View Document
                                                </a>
                                            @else
                                                No Document
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   
                    <div class="table-responsive" id="medicalTable" style="display: none;">
                        <p class="text-muted">This is your medical data.</p>
                    <table id="example2" class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Examination Name</th>
                                <th>I have</th>
                                
                                <th>Date</th>
                                <th>Status</th>
                                <th>Document</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medical as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->name_exam }}</td>
                                    <td>{{ $data->condition ?? 'N/A' }}</td>
                                    <td>{{ $data->date ?? 'N/A' }}</td>
                                    <td>{{ $data->status }}</td>
                                    
                                    <td>
                                        @if($data->document_name)
                                            <!-- Button to trigger the document viewer modal -->
                                            <button type="button" 
                                                    class="btn btn-sm btn-primary" 
                                                    data-toggle="modal" 
                                                    data-target="#documentModal{{ $data->id }}">
                                                <i class="bi bi-file-earmark"></i> View Document
                                            </button>
                    
                                            <!-- Modal for document viewer -->
                                            <div class="modal fade" id="documentModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel{{ $data->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="documentModalLabel{{ $data->id }}">Document Viewer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if(pathinfo($data->document_name, PATHINFO_EXTENSION) === 'pdf')
                                                                <!-- PDF Viewer using iframe -->
                                                                <iframe src="{{ asset('uploads/Medical/' . $data->document_name) }}" 
                                                                        width="100%" 
                                                                        height="500px" 
                                                                        style="border: none;">
                                                                </iframe>
                                                            @else
                                                                <!-- Display an image for non-PDF files -->
                                                                <img src="{{ asset('uploads/Medical/' . $data->document_name) }}" 
                                                                     alt="Document" 
                                                                     class="img-fluid">
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-danger">No Document</span>
                                        @endif
                                    </td>
                                   
                                    <td>
                                        @if($data->document_name)
                                            <a href="{{ asset('uploads/Medical/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                View Document
                                            </a>
                                        @else
                                            No Document
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const toggleBtn = document.getElementById('toggleMedicalTableBtn');
                            const medicalTable = document.getElementById('medicalTable');
                    
                            toggleBtn.addEventListener('click', function () {
                                if (medicalTable.style.display === 'none') {
                                    medicalTable.style.display = 'block';
                                    toggleBtn.innerHTML = '<i class="bi bi-table"></i> Hide Medical Data';
                                } else {
                                    medicalTable.style.display = 'none';
                                    toggleBtn.innerHTML = '<i class="bi bi-table"></i> Pick Medical Data';
                                }
                            });
                        });
                    </script>
                </div>
                
                        <div class="table-responsive"id="associationTable" style="display: none;">
                            <p class="text-muted">This is your association data.</p>
                        <table id="example2" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>My Name</th>
                                    <th>Am I a member</th>
                                    <th>Association Name</th>
                                    <th>Membership Status</th>
                                    <th>Document</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($associations as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->condition }}</td>
                                        <td>{{ $data->association_name }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                            @if($data->document_name)
                                                <!-- Button to trigger the document viewer modal -->
                                                <button type="button" 
                                                        class="btn btn-sm btn-primary" 
                                                        data-toggle="modal" 
                                                        data-target="#documentModal{{ $data->id }}">
                                                    <i class="bi bi-file-earmark"></i> View Document
                                                </button>
                        
                                                <!-- Modal for document viewer -->
                                                <div class="modal fade" id="documentModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel{{ $data->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="documentModalLabel{{ $data->id }}">Document Viewer</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if(pathinfo($data->document_name, PATHINFO_EXTENSION) === 'pdf')
                                                                    <!-- PDF Viewer using iframe -->
                                                                    <iframe src="{{ asset('uploads/Association/' . $data->document_name) }}" 
                                                                            width="100%" 
                                                                            height="500px" 
                                                                            style="border: none;">
                                                                    </iframe>
                                                                @else
                                                                    <!-- Display a download link for non-PDF files -->
                                                                    <p>This document cannot be previewed. Please download it to view.</p>
                                                                    <a href="{{ asset('uploads/Association/' . $data->document_name) }}" 
                                                                       download 
                                                                       class="btn btn-primary">
                                                                        <i class="bi bi-download"></i> Download Document
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-danger">No Document</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->document_name)
                                                <a href="{{ asset('uploads/Association/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    View Document
                                                </a>
                                            @else
                                                No Document
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const toggleBtn = document.getElementById('toggleAssociationTableBtn');
                                const associationTable = document.getElementById('associationTable');
                        
                                toggleBtn.addEventListener('click', function () {
                                    if (associationTable.style.display === 'none') {
                                        associationTable.style.display = 'block';
                                        toggleBtn.innerHTML = '<i class="bi bi-table"></i> Hide Association Data';
                                    } else {
                                        associationTable.style.display = 'none';
                                        toggleBtn.innerHTML = '<i class="bi bi-table"></i> Show Association Data';
                                    }
                                });
                            });
                        </script>
                        </div>
                        
                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('admin.Dashboard.footer')

