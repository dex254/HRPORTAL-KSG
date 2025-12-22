@include('HRPU.Dashboard.header')
@include('HRPU.Dashboard.Status')
<!-- Wrapper -->
<div class="wrapper">
    <!-- Start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Application Details</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/My_applications">My Applications</a></li>
                           
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End breadcrumb -->

            <!-- Display Alerts -->
            @if (session('success') || session('error'))
                <div class="alert alert-{{ session('error') ? 'danger' : 'success' }}" role="alert">
                    {{ session('error') ?? session('success') }}
                </div>
            @endif

            <!-- Application & Job Details -->
            <div class="row">
                <!-- Job Details Card -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fa fa-briefcase"></i> Job Details</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Specialization:</strong> {{ $jobext->Specialization }}</p>
                            <p><strong>Reference No:</strong> {{ $jobext->Ref_No }}</p>
                            <p><strong>Area:</strong> {{ $jobext->area ?? 'N/A' }}</p>
                            
                            <p><strong>Positions:</strong> {{ $jobext->Proposed_No_of_Positions }}</p>
                            <p><strong>Application Deadline:</strong> {{ $jobext->deadline }}</p>
                        </div>
                    </div>
                </div>

                <!-- Application Details Card -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fa fa-user"></i> Your Application Details</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Name:</strong> {{ $application->name }}</p>
                            <p><strong>UPN No:</strong> {{ $application->upn_no }}</p>
                            <p><strong>Email:</strong> {{ $application->email }}</p>
                            <p><strong>Phone:</strong> {{ $application->phone }}</p>
                            <p><strong>ID Number:</strong> {{ $application->idnumber }}</p>
                            <p><strong>Designation:</strong> {{ $application->designation }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge badge-{{ $application->status == 'Applied' ? 'success' : 'secondary' }}">
                                    {{ $application->status }}
                                </span>
                            </p>
                            <p><strong>Applied On:</strong> {{ \Carbon\Carbon::parse($application->datetime)->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CV & Cover Letter Viewer -->
            <div class="row mt-4">
                <!-- CV Viewer -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fa fa-file-pdf"></i> Curriculum Vitae (CV)</h5>
                        </div>
                        <div class="card-body">
                            @if ($application->cv)
                                <iframe src="{{ asset($application->cv) }}" width="100%" height="500px"></iframe>
                                <a href="{{ asset($application->cv) }}" target="_blank" class="btn btn-outline-primary mt-2">
                                    <i class="fa fa-download"></i> Download CV
                                </a>
                            @else
                                <p class="text-danger">No CV uploaded.</p>
                            @endif
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fa fa-file-pdf"></i> Bio  Data</h5>
                        </div>
                        <div class="card-body">
                            @if ($application->cv)
                                <iframe src="{{ asset($application->my_bio) }}" width="100%" height="500px"></iframe>
                                <a href="{{ asset($application->my_bio) }}" target="_blank" class="btn btn-outline-primary mt-2">
                                    <i class="fa fa-download"></i> Download Bio Data
                                </a>
                            @else
                                <p class="text-danger">No Bio uploaded.</p>
                            @endif
                        </div>
                       
                    </div>
                </div>
                
                <!-- Cover Letter Viewer -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fa fa-file-pdf"></i> Cover Letter</h5>
                        </div>
                        <div class="card-body">
                            @if ($application->cover_letter)
                                <iframe src="{{ asset($application->cover_letter) }}" width="100%" height="500px"></iframe>
                                <a href="{{ asset($application->cover_letter) }}" target="_blank" class="btn btn-outline-primary mt-2">
                                    <i class="fa fa-download"></i> Download Cover Letter
                                </a>
                            @else
                                <p class="text-danger">No Cover Letter uploaded.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back & Delete Buttons -->
            <div class="mt-4 d-flex justify-content-between">
                <a href="/My_applications" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to Applications
                </a>
                <form action="{{ route('JOB.abortext', ['id' => $application->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Delete Application
                    </button>
                </form>
            </div>
        </div>
    </div> <!-- End page wrapper -->
</div>
<!-- End wrapper -->

@include('HRPU.Dashboard.footer')
