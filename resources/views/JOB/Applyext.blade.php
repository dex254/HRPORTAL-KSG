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
                        <ol class="breadcrumb mb-0 p-0">
                           
                            <li class="breadcrumb-item active" aria-current="page">Apply </li>
                        </ol>
                    </nav>
                </div>
                
            </div> <!--end breadcrumb-->
            <div class="d-flex justify-content-start mt-4">
               <!-- Previous Button -->
<a href="{{ route('JOB.applicantsext') }}" class="btn px-4 py-2 me-2" style="background-color: rgb(127, 98, 44); color: black; border: none; transition: background-color 0.3s, color 0.3s;" onmouseover="this.style.backgroundColor='white'; this.style.color='black';" onmouseout="this.style.backgroundColor='rgb(127, 98, 44)'; this.style.color='black';">
    Previous
</a>

<!-- My Application Button -->
<button onclick="location.href='{{ route('HRPU.Myapplicants') }}'" class="btn px-4 py-2" style="background-color: rgb(203, 211, 0); color: black; border: none; transition: background-color 0.3s, color 0.3s;" onmouseover="this.style.backgroundColor='white'; this.style.color='black';" onmouseout="this.style.backgroundColor='rgb(203, 211, 0)'; this.style.color='black';">
    My Application
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
</script><div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0">Job Details</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Designation:</strong> {{ $jobexts->area }}</p>
                <p><strong>Specific Area of Specialization:</strong> {{ $jobexts->Specialization }}</p>
                <p><strong>Proposed Number of Positions:</strong> {{ $jobexts->Proposed_No_of_Positions }}</p>
               
            </div>
            <div class="col-md-6">
               
                <p><strong>Reference Number:</strong> {{ $jobexts->Ref_NO }}</p>
                <p><strong>Date From:</strong> {{ $jobexts->datefrom }}</p>
                <p><strong>Deadline:</strong> {{ $jobexts->deadline }}</p>
                <p><strong>Status:</strong> {{ $jobexts->status }}</p>
            </div>
        </div>
    </div>
</div>



<form class="row g-3" action="{{ route('JOB.applyext', ['id' => $jobexts->id]) }}" method="POST"  enctype="multipart/form-data">
    @csrf
    
    <div class="row mb-3">
        <div class="col-sm-12">
             <label for="cvFile" class="form-label" style="font-size: 1.25rem; font-weight: bold; color: #333;">
        Please upload a filled copy of the 
        <span style="color: #0056b3;">KENYA SCHOOL OF GOVERNMENT</span><br>
        <em style="color: #b33a00;">CALL FOR EXPERTS (CONSULTANTS AND TRAINERS) – APPENDIX 1: CV FORMAT</em><br>
        <span style="color: #000;">Accepted format: PDF only</span>
    </label>
            <input class="form-control" type="file" id="cvFile" name="cv" accept=".pdf" required />
            <iframe id="cvPreview" class="mt-2 d-none" style="width: 100%; height: 400px; border: 1px solid #ddd;"></iframe>
             <input type="hidden" name="cover_letter" id="coverLetter" />
        </div>
    </div>
     <script>
    document.getElementById('cvFile').addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file && file.type === "application/pdf") {
            // Preview the PDF in the iframe
            const fileURL = URL.createObjectURL(file);
            document.getElementById('cvPreview').classList.remove('d-none');
            document.getElementById('cvPreview').src = fileURL;

            // Set the cover_letter value to the file name
            document.getElementById('coverLetter').value = file.name;
        }
    });
</script>
    
    <!--<div class="row mb-3">
        <div class="col-sm-12">
            <label for="coverLetterFile" class="form-label">Upload your Cover Letter (PDF):</label>
            <input class="form-control" type="file" id="coverLetterFile" name="cover_letter" accept=".pdf" required />
            <iframe id="coverLetterPreview" class="mt-2 d-none" style="width: 100%; height: 400px; border: 1px solid #ddd;"></iframe>
        </div>
    </div>-->
    
    <script>
        function previewPDF(input, previewId) {
            const file = input.files[0];
            if (file && file.type === "application/pdf") {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            } else {
                alert("Please select a valid PDF file.");
                input.value = ""; // Clear input if not a PDF
            }
        }
    
        document.getElementById('cvFile').addEventListener('change', function() {
            previewPDF(this, 'cvPreview');
        });
    
        document.getElementById('coverLetterFile').addEventListener('change', function() {
            previewPDF(this, 'coverLetterPreview');
        });
    </script>
    

        <input type="hidden" name="Ref_No" value="{{ $jobexts->Ref_NO }}">
        <input type="hidden" name="upn_no" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
        <input type="hidden" name="email" value="{{ Auth::guard('HRPU')->user()->email }}">
        <input type="hidden" name="phone" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
        <input type="hidden" name="idnumber" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
        <input type="hidden" name="name" value="{{ Auth::guard('HRPU')->user()->email }}">
        <input type="hidden" name="job_group" value="{{ $jobexts->level }}">
        <input type="hidden" name="designation" value="{{ $jobexts->Specialization }}">
        <input type="hidden" name="Expected" value="{{ $jobexts->level }}">
        <input type="hidden" name="my_bio" value="{{ old('my_bio', isset($application) ? $application->my_bio : '') }}">

    <div class="col-12">
        <button type="submit" class="btn btn-success px-5">Apply</button>
    </div>
</form>


</div>
</div>

</div>
</div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HRPU.Dashboard.footer')

