@include('EXT.Dashboard.header')
@include('EXT.Dashboard.Status')

<!-- Wrapper -->
<div class="wrapper">
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

<!-- Breadcrumb & Instructions -->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Academic Qualifications and Professional Development</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb"></nav>
    </div>

    <!-- Instruction Alert -->
    <div class="alert alert-info mt-3" role="alert">
        <i class="bx bx-info-circle"></i>
        To provide your qualifications, please click the appropriate button below:  
        <ul class="mb-0 mt-2">
            <li><strong>Academic Qualifications:</strong> Add degrees, diplomas, or certificates like O-Level, A-Level, Bachelor's, Master's, etc.</li>
            <li><strong>Short Courses:</strong> Add professional development programs under 6 months (e.g., SMC, workshops).</li>
            <li><strong>Professional Qualifications:</strong> Add recognized professional certificates (e.g., Part III of CIA, CPA, ACCA or equivalent).</li>
        </ul>
    </div>
</div>

<style>
.alert-info {
    background-color: #e7f3fe;
    color: #31708f;
    border: 1px solid #bce8f1;
    border-radius: 5px;
}

.alert-info ul {
    margin-top: 5px;
    padding-left: 20px;
}
</style>

            <!-- End Breadcrumb -->

            <!-- Navigation Buttons -->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4 gap-3">
                    <a href="{{ route('EXT.Dashboard') }}" class="btn previous-button px-4 py-2">Previous</a>
                    <button onclick="location.href='{{ route('EXT.Proffecional.Body') }}'" class="btn next-button px-4 py-2">Next</button>
                </div>
            </div>

            <style>
                .previous-button { background-color: rgb(127, 98, 44); color: white; border: none; border-radius:5px; transition:0.3s; }
                .previous-button:hover { background-color: white; color: rgb(127, 98, 44); border: 1px solid rgb(127, 98, 44); }
                .next-button { background-color: rgb(203, 211, 0); color: black; border:none; border-radius:5px; transition:0.3s; }
                .next-button:hover { background-color: white; color:black; border:1px solid black; }
            </style>

            <br><br>
<div class="qualification-buttons d-flex flex-column flex-md-row gap-4 mb-5">

    <!-- Academic Button -->
    <div class="qualification-card">
        <button class="btn academic-btn w-100 py-3" onclick="openModal('academicModal')">
            Academic Qualifications
        </button>
        <p class="text-muted mt-2 small">
            Add your academic qualifications like O-level, A-level, Diploma, Bachelor's, Master's, etc.
        </p>
    </div>

    <!-- Short Course Button -->
    <div class="qualification-card">
        <button class="btn training-btn w-100 py-3" onclick="openModal('trainingModal')">
            Short Courses
        </button>
        <p class="text-muted mt-2 small">
            Short courses are professional development programs (like SMC, workshops) usually under 6 months.
        </p>
    </div>

    <!-- Professional Qualification Button -->
    <div class="qualification-card">
        <button class="btn professional-btn w-100 py-3" onclick="openModal('professionalModal')">
            Professional Qualifications
        </button>
        <p class="text-muted mt-2 small">
            Certificate in any of the following: Part III of the Certified Internal Auditor (CIA), Part III of CPA, Part III of ACCA, or equivalent qualification from a recognized institution.
        </p>
    </div>

</div>

<style>
.qualification-buttons {
    justify-content: space-between;
    gap: 2rem; /* Increased spacing between cards */
}

.qualification-card {
    flex: 1;
    text-align: center;
}

/* Academic Button */
.academic-btn {
    background-color: rgb(127, 98, 44);
    color: white;
    border-radius: 5px;
    font-weight: bold;
    font-size: 1rem;
    transition: all 0.3s ease;
    min-height: 60px; /* taller button */
}
.academic-btn:hover {
    background-color: white;
    color: rgb(127, 98, 44);
    border: 1px solid rgb(127, 98, 44);
}

/* Short Course Button */
.training-btn {
    background-color: rgb(203, 211, 0);
    color: black;
    border-radius: 5px;
    font-weight: bold;
    font-size: 1rem;
    transition: all 0.3s ease;
    min-height: 60px;
}
.training-btn:hover {
    background-color: white;
    color: black;
    border: 1px solid rgb(203, 211, 0);
}

/* Professional Qualification Button */
.professional-btn {
    background-color: rgb(0, 123, 255); /* Blue */
    color: white;
    border-radius: 5px;
    font-weight: bold;
    font-size: 1rem;
    transition: all 0.3s ease;
    min-height: 60px;
}
.professional-btn:hover {
    background-color: white;
    color: rgb(0, 123, 255);
    border: 1px solid rgb(0, 123, 255);
}

/* Description text */
.qualification-card p {
    font-size: 0.85rem;
    line-height: 1.3;
    margin-top: 0.5rem;
}

/* Responsive spacing */
@media (max-width: 768px) {
    .qualification-buttons {
        gap: 1.5rem; /* space between stacked buttons on mobile */
    }
}
</style>

            <!-- Academic Qualifications Card -->
            <div class="card mb-4">
                
                <div class="card-body">
                    

                    <div class="d-lg-flex align-items-center mb-4 gap-3 justify-content-between">
                        
                        <h2 class="fw-bold">Academic Qualifications</h2>
                    </div>

                    <style>
                        .add-qualification-button { background-color: rgb(127, 98, 44); color: white; border:none; border-radius:5px; }
                        .add-qualification-button:hover { background-color:white; color:rgb(127, 98, 44); border:1px solid rgb(127, 98, 44);}
                        .short-course-button { background-color: rgb(203, 211, 0); color:black; border:none; border-radius:5px; }
                        .short-course-button:hover { background-color:white; color:black; border:1px solid rgb(203, 211, 0);}
                        .view-button { background-color: rgb(203, 211, 0); color:black; border:none; border-radius:5px; }
                        .view-button:hover { background-color:white; color:black; border:1px solid black;}
                    </style>

                    <!-- Alerts -->
                    @if ($errors->any() || session('success') || session('error'))
                        <div class="alert alert-{{ $errors->any() ? 'danger' : (session('error') ? 'danger' : 'success') }}">
                            @if ($errors->any())
                                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                            @elseif (session('error'))
                                {{ session('error') }}
                            @else
                                {{ session('success') }}
                            @endif
                        </div>
                    @endif

                    <!-- Academic Table -->
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered mb-0">
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
                                                <a href="{{ asset('uploads/Academic/' . $academic->document_name) }}" target="_blank" class="btn btn-sm view-button"><i class="bi bi-book"></i> View</a>
                                            @else
                                                <span class="text-danger">No Document</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('EXT.academic.destroyext', $academic->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" class="text-center text-muted">No academic records found.</td></tr>
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
                </div>
            </div>

            <!-- Short Courses Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold">Short Courses</h2>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered mb-0">
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
                                @forelse($trainning as $index => $course)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $course->institution }}</td>
                                        <td>{{ $course->course }}</td>
                                        <td>{{ $course->level }}</td>
                                        <td>{{ date('d M Y', strtotime($course->stdate)) }}</td>
                                        <td>{{ date('d M Y', strtotime($course->enddate)) }}</td>
                                        <td>{{ $course->grade }}</td>
                                        <td>
                                            @if($course->document_name)
                                                <a href="{{ asset('uploads/Academic/' . $course->document_name) }}" target="_blank" class="btn btn-sm view-button"><i class="bi bi-book"></i> View</a>
                                            @else
                                                <span class="text-danger">No Document</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('EXT.academic.destroyext', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" class="text-center text-muted">No short courses found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Professional Qualifications</h2>
            
        </div>

        <div class="table-responsive">
            <table id="professionalTable" class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Institution / Body</th>
                        <th>Course Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Result / Status</th>
                        <th>Certificate</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($professionals as $index => $pro)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pro->institution }}</td>
                            <td>{{ $pro->course }}</td>
                            <td>{{ date('d M Y', strtotime($pro->stdate)) }}</td>
                            <td>{{ date('d M Y', strtotime($pro->enddate)) }}</td>
                            <td>{{ $pro->grade ?? 'N/A' }}</td>
                            <td>
                                @if($pro->document_name)
                                    <a href="{{ asset('uploads/Professional/' . $pro->document_name) }}" target="_blank" class="btn btn-sm btn-success">
                                        <i class="bi bi-book"></i> View
                                    </a>
                                @else
                                    <span class="text-danger">No Document</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('EXT.academic.destroyext', $pro->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
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
                            <td colspan="8" class="text-center text-muted">No professional qualifications found.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Institution / Body</th>
                        <th>Course Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Result / Status</th>
                        <th>Certificate</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


            <!-- Modals -->
            @include('EXT.Dashboard.Modals.AcademicModal')
            @include('EXT.Dashboard.Modals.TrainingModal')
            @include('EXT.Dashboard.Modals.ProfessionalModal')

        </div>
    </div>
    <!-- End Page Wrapper -->
</div>
<!-- End Wrapper -->

@include('EXT.Dashboard.footer')

<!-- Scripts -->
<script>
function openModal(modalId){ document.getElementById(modalId).style.display='flex'; }
function closeModal(modalId){ document.getElementById(modalId).style.display='none'; }
</script>
