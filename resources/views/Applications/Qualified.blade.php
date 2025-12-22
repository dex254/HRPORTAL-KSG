@include('admin.Dashboard.header')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Qualified Canidates</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                           
                            <li class="breadcrumb-item active" aria-current="page"> To  be  Interveiwd</li>
                        </ol>
                    </nav>
                </div>
                
            </div> <!--end breadcrumb-->

            <div class="card">
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

<div class="table-responsive">
    <table id="example2" class="table mb-0">
        <thead class="table-light">
            <tr>
                <th>UPN/No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Job Ref No</th>
                <th>Job Name</th>
                <th>Interview Date</th>
                <th>Location</th>
                <th>Status</th>
                <th>Applicat  Job Group</th>
                <th>Job Group</th>
                <th>No. of Positions</th>
                <th>Deadline</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Applicants as $applicant)
                <tr>
                    <td>{{ $applicant->upn_no }}</td>
                    
                    <td>{{ $applicant->name }}</td>
                    <td>{{ $applicant->email }}</td>
                    <td>{{ $applicant->phone }}</td>
                    <td>{{ $applicant->Ref_No }}</td>
                    <td>{{ $applicant->designation }}</td>
                    <td>{{ $applicant->intervew ?? 'N/A' }}</td>
                    <td>{{ $applicant->venue ?? 'N/A' }}</td>
                    <td><span class="badge badge-success">{{ $applicant->status }}</span></td>
                    <td>{{ $applicant->hr ? $applicant->hr->job_group : 'N/A' }}</td>
                    <td>{{ $applicant->job ? $applicant->job->Job_Group : 'N/A' }}</td>
                    <td>{{ $applicant->job ? $applicant->job->Proposed_No_of_Positions : 'N/A' }}</td>
                    <td>{{ $applicant->job ? $applicant->job->deadline : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('admin.Dashboard.footer')

