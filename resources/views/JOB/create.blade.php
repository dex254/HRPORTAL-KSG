@include('admin.Dashboard.header')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
                <div class="breadcrumb-title pe-3">HR / Jobs</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Internal Job Advert</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="container">
                <div class="main-body">
                    <div class="row justify-content-center">

                        <div class="col-lg-10">
                            <div class="card shadow-sm border-0 rounded-4">
                                <div class="card-header bg-primary text-white rounded-top-4">
                                    <h5 class="mb-0">Create Internal Job Advert</h5>
                                </div>
                                <div class="card-body p-4">

                                    <!-- Display Session Messages -->
                                    @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    <!-- Job Form -->
                                    <form class="row g-3" action="{{ route('JOB.createdata') }}" method="POST">
                                        @csrf

                                        <div class="col-md-6">
                                            <label for="area" class="form-label">Job Title</label>
                                            <input type="text" class="form-control rounded-3" id="area" name="Designation" placeholder="e.g., HR Manager" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="job_group" class="form-label">Job Group</label>
                                            <select class="form-select rounded-3" name="Job_Group" required>
                                                <option value="">-- Select Job Group --</option>
                                                <option value="All">All</option>
                                                @for ($i = 1; $i <= 14; $i++)
                                                    <option value="KSG{{ $i }}">KSG{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="positions" class="form-label">Proposed No of Positions</label>
                                            <input type="number" class="form-control rounded-3" name="Proposed_No_of_Positions" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="ae" class="form-label">AE</label>
                                            <input type="text" class="form-control rounded-3" name="AE" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="ip" class="form-label">IP</label>
                                            <input type="text" class="form-control rounded-3" name="IP" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="var" class="form-label">Var</label>
                                            <input type="text" class="form-control rounded-3" name="Var" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="ref_no" class="form-label">Reference Number</label>
                                            <input type="text" class="form-control rounded-3" name="Ref_NO" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="datefrom" class="form-label">Start Date</label>
                                            <input type="date" class="form-control rounded-3" name="datefrom" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="deadline" class="form-label">Deadline</label>
                                            <input type="date" class="form-control rounded-3" name="deadline" required>
                                        </div>

                                        <!-- Qualifications Section -->
                                        <div class="col-12 mt-3">
                                                                                      <h6 class="text-primary">Qualifications & Requirements</h6>

<div class="row g-3">

    <div class="col-md-2">
        <label class="form-label">Academic</label>
        <select id="academic" class="form-select rounded-3">
            <option value="">-- Select --</option>
            <option value="O level">O level</option>
            <option value="A level">A level</option>
            <option value="Certificate">Certificate</option>
            <option value="Diploma">Diploma</option>
            <option value="Bachelor's Degree">Bachelor's Degree</option>
            <option value="Master's Degree">Master's Degree</option>
            <option value="Doctorate">Doctorate (PhD)</option>
            <option value="All">All</option>
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label">Professional Bodies</label>
        <select id="professional_bodies" class="form-select rounded-3">
            <option value="">-- Select --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label">Association</label>
        <select id="association" class="form-select rounded-3">
            <option value="">-- Select --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label">Practising License</label>
        <select id="practising_license" class="form-select rounded-3">
            <option value="">-- Select --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label">Food Handlers Certificate</label>
        <select id="food_handlers" class="form-select rounded-3">
            <option value="">-- Select --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label">Experience</label>
        <select id="experience" class="form-select rounded-3">
            <option value="">-- Select --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <!-- Years of Experience (Shown only if Yes) -->
    <div class="col-md-2 d-none" id="experienceYearsWrapper">
        <label class="form-label">Years</label>
        <input type="number"
               id="experience_years"
               class="form-control rounded-3"
               min="0"
               placeholder="Years">
    </div>

    <div class="col-md-12">
        <label class="form-label">Qualifications (Auto-fill)</label>
        <input type="text"
               id="qualifications"
               name="qualifications"
               class="form-control rounded-3"
               readonly
               placeholder="Qualifications will autofill here">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-light px-5">Upload</button>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const academic = document.getElementById('academic');
    const professional = document.getElementById('professional_bodies');
    const association = document.getElementById('association');
    const license = document.getElementById('practising_license');
    const food = document.getElementById('food_handlers');
    const experience = document.getElementById('experience');
    const experienceYears = document.getElementById('experience_years');
    const experienceYearsWrapper = document.getElementById('experienceYearsWrapper');
    const qualifications = document.getElementById('qualifications');

    function updateQualifications() {
        let parts = [];

        if (academic.value)
            parts.push(`Academic[${academic.value}]`);

        if (professional.value !== "")
            parts.push(`Professional Bodies[${professional.value}]`);

        if (association.value !== "")
            parts.push(`Association[${association.value}]`);

        if (license.value !== "")
            parts.push(`Practising License[${license.value}]`);

        if (food.value !== "")
            parts.push(`Food Handlers Certificate[${food.value}]`);

        if (experience.value === "1") {
            const years = experienceYears.value || 0;
            parts.push(`Experience[1][${years} Years]`);
        } 
        else if (experience.value === "0") {
            parts.push(`Experience[0]`);
        }

        qualifications.value = parts.join(', ');
    }

    experience.addEventListener('change', function () {
        if (this.value === "1") {
            experienceYearsWrapper.classList.remove('d-none');
        } else {
            experienceYearsWrapper.classList.add('d-none');
            experienceYears.value = '';
        }
        updateQualifications();
    });

    experienceYears.addEventListener('input', updateQualifications);

    [academic, professional, association, license, food].forEach(el => {
        el.addEventListener('change', updateQualifications);
    });

});
</script>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('admin.Dashboard.footer')
