@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')
<div class="page-wrapper">
    <div class="page-content">
<div class="container mt-4">
    <div class="ms-auto">
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('JOB.Myapplicants') }}" class="btn btn-danger px-4 py-2 me-2">Previous</a>
            
            <form action="{{ route('user.final') }}" method="GET">
                <button type="submit" class="btn btn-success px-4 py-2">
                    Complete
                </button>
            </form>
        </div>
        <br>
        <br>
    <div class="card shadow-lg">
        
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"> User Final   Report</h4>
        </div>
        
        <div class="card-body">
            
            <!-- User Information -->
            <h5 class="text-primary mb-3"><i class="bi bi-person-circle"></i> User Details</h5>
            
            <div class="row g-3">
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->name }}" readonly />
                        <label>Full Name</label>
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
                        <label>Date  of birth</label>
                    </div>
                </div>
            </div>

            <!-- Academic Qualifications -->
            <h5 class="text-primary mt-4"><i class="bi bi-mortarboard"></i> Academic Qualifications</h5>
            <div class="table-responsive">
                <table id="example2" class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
            <th>Institution</th>
            <th>Course</th>
            <th>Level</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Grade</th>
            <th>Certificate</th>
            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($academics as $index => $academic)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $academic->institution }}</td>
                            <td>{{ $academic->course }}</td>
                            <td>{{ $academic->level }}</td>
                            <td>{{ date('d M Y', strtotime($academic->stdate)) }}</td>
                            <td>{{ date('d M Y', strtotime($academic->enddate)) }}</td>
                            <td>{{ $academic->grade }}</td>
                            <td>
                                @if($academic->document_name)
                                    <a href="{{ asset('uploads/Academic/' . $academic->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                        View Certificate
                                    </a>
                                @else
                                    <span class="text-danger">No Document</span>
                                @endif
                            </td>
                            <td>
                                <!-- Delete Button -->
                                <form action="{{ route('academic.destroy', $academic->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
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
                            <td colspan="9" class="text-center text-muted">No academic records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
            <th>Institution</th>
            <th>Course</th>
            <th>Level</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Grade</th>
            <th>Certificate</th>
            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            

            <!-- Work Experience -->
            <h5 class="text-primary mt-4"><i class="bi bi-briefcase"></i> Work Experience</h5>
            <div class="table-responsive">
                <table id="example2" class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Employer</th>
                            <th>Job Title</th>
                            <th>Country</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <th>Expertise</th>
                            <th>Action</th>
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
                <td>
                    <!-- Delete Button -->
                    <form action="{{ route('Experince.destroy', $experience->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
                
            </tr>
        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Employer</th>
                            <th>Job Title</th>
                            <th>Country</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <th>Expertise</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <h5 class="text-primary mt-4"><i class="bi bi-briefcase"></i> Application History</h5>
                <div class="table-responsive">
                    <table id="example2" class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ref No</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Applied On</th>
                                <th>CV</th>
                                <th>Cover Letter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                            <a href="{{ asset($application->cv) }}" target="_blank" class="btn btn-info btn-sm">
                                <i class="fa fa-file-pdf"></i> View CV
                            </a>
                        @else
                            <span class="text-danger">No CV</span>
                        @endif
                    </td>
                    <td>
                        @if ($application->cover_letter)
                            <a href="{{ asset($application->cover_letter) }}" target="_blank" class="btn btn-warning btn-sm">
                                <i class="fa fa-file-pdf"></i> View Cover Letter
                            </a>
                        @else
                            <span class="text-danger">No Cover Letter</span>
                        @endif
                    <td>
                        <a href="{{ route('JOB.Applicationdetails', ['ref_no' => $application->Ref_No]) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-eye"></i> View Details
                        </a>
                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Ref No</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Applied On</th>
                                <th>CV</th>
                                <th>Cover Letter</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="container mt-5">
                    <!-- Core Mandate Section -->
                    <div class="mb-5">
                        <h2>Core Mandate</h2>
                        <p class="text-muted">This is your core mandates achieved.</p>
                        <table id="coreMandateTable" class="table mb-0">
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
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coremandate as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->upn_no }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->job_group ?? 'N/A' }}</td>
                                        <td>{{ $item->comandate ?? 'N/A' }}</td>
                                        <td>{{ $item->selected_count ?? 'N/A' }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <form action="{{ route('coremandate.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
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
            
                    <!-- Licenses Section -->
                    <div class="mb-5">
                        <h2>Licenses</h2>
                        <p class="text-muted">This is your licenses data.</p>
                        <table id="licensesTable" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>UPN No</th>
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
                                        <td>{{ $licence->upn_no }}</td>
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
                        <h2>Professional Body</h2>
                        <p class="text-muted">This is your professional body data.</p>
                        <table id="professionalBodyTable" class="table mb-0">
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
                        <h2>Medical</h2>
                        <p class="text-muted">This is your medical data.</p>
                        <table id="medicalTable" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Examination Name</th>
                                    <th>I have</th>
                                    <th>Expiry Date</th>
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
                                        <td>{{ $data->name }}</td>
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
                        <h2>Association</h2>
                        <p class="text-muted">This is your association data.</p>
                        <table id="associationTable" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>My Name</th>
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
                                        <td>{{ $data->name }}</td>
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
            
                <!-- Bootstrap JS and Popper.js -->
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
                <div class="container mt-4">
                    <h4 class="mb-3">User Report</h4>
                
                    <div class="card">
                        <div class="card-body">
                            <iframe src="{{ route('user.final') }}" width="100%" height="800px" style="border: none;"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('HR.Dashboard.footer')
