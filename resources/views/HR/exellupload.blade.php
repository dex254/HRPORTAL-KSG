@include('admin.Dashboard.header')

<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid">

            {{-- =======================
                UPLOAD EXCEL SECTION
            ======================== --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bx bxs-file-import me-2"></i>
                    <h5 class="mb-0">Upload Excel File with Staff Records</h5>
                </div>

                <div class="card-body">

                    {{-- Alerts --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('HR.uploadExcel') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Upload Excel Document
                            </label>
                            <input
                                type="file"
                                name="file"
                                class="form-control"
                                accept=".xlsx,.xls,.csv"
                                required
                            >
                            <small class="text-muted">
                                Accepted formats: XLSX, XLS, CSV
                            </small>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bx bx-upload me-1"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- =======================
                HR MANUAL ENTRY FORM
            ======================== --}}
            <div class="row justify-content-center">
                <div class="col-lg-11">

                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="bx bxs-user-plus me-1"></i>
                                Add HR Staff Record (Manual Entry)
                            </h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('hr.store') }}" method="POST">
                                @csrf

                                <div class="row g-3">

                                    {{-- BASIC INFORMATION --}}
                                    <h6 class="text-muted mt-2">Basic Information</h6>
                                    <hr>

                                    <div class="col-md-4">
                                        <label class="form-label">S/No</label>
                                        <input type="text" name="s_no" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Payroll Number</label>
                                        <input type="text" name="payroll_num" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">UPN Number</label>
                                        <input type="text" name="upn_no" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">ID Number</label>
                                        <input type="text" name="idnumber" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="">Select</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Ethnicity</label>
                                        <input type="text" name="ethnicity" class="form-control">
                                    </div>

                                    <div class="col-md-4">
    <label class="form-label">Disability</label>
    <select name="disability" id="disability" class="form-select">
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>
</div>

<div class="col-md-12" id="disability-description-container" style="display: none;">
    <label class="form-label">Disability Description</label>
    <textarea name="disability_description" class="form-control"></textarea>
</div>


                                    {{-- JOB INFORMATION --}}
                                    <h6 class="text-muted mt-4">Job Information</h6>
                                    <hr>

                                    <div class="col-md-4">
                                        <label class="form-label">Designation</label>
                                        <input type="text" name="designation" class="form-control">
                                    </div>

                                   <div class="col-md-4">
    <label class="form-label">Job Group</label>
    <select name="job_group" class="form-select">
        <option value="">Select Job Group</option>
        @for ($i = 1; $i <= 13; $i++)
            <option value="KSG {{ $i }}">KSG {{ $i }}</option>
        @endfor
    </select>
</div>


                                    <div class="col-md-4">
    <label class="form-label">Campus</label>
    <select name="campus" class="form-select">
        <option value="">Select Campus</option>
        <option value="Lower Kabete">Lower Kabete</option>
        <option value="e-Learning and Development Institute">e-Learning and Development Institute</option>
        <option value="Baringo">Baringo</option>
        <option value="Mombasa">Mombasa</option>
        <option value="Matuga">Matuga</option>
    </select>
</div>


                                    <div class="col-md-4">
                                        <label class="form-label">Job Designation</label>
                                        <input type="text" name="job_designation" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Job Code</label>
                                        <input type="text" name="job_code" class="form-control">
                                    </div>

                                   <div class="col-md-4">
    <label class="form-label">Home County</label>
    <select name="home_county" class="form-select">
        <option value="">Select County</option>

        <option value="Baringo">Baringo</option>
        <option value="Bomet">Bomet</option>
        <option value="Bungoma">Bungoma</option>
        <option value="Busia">Busia</option>
        <option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
        <option value="Embu">Embu</option>
        <option value="Garissa">Garissa</option>
        <option value="Homa Bay">Homa Bay</option>
        <option value="Isiolo">Isiolo</option>
        <option value="Kajiado">Kajiado</option>
        <option value="Kakamega">Kakamega</option>
        <option value="Kericho">Kericho</option>
        <option value="Kiambu">Kiambu</option>
        <option value="Kilifi">Kilifi</option>
        <option value="Kirinyaga">Kirinyaga</option>
        <option value="Kisii">Kisii</option>
        <option value="Kisumu">Kisumu</option>
        <option value="Kitui">Kitui</option>
        <option value="Kwale">Kwale</option>
        <option value="Laikipia">Laikipia</option>
        <option value="Lamu">Lamu</option>
        <option value="Machakos">Machakos</option>
        <option value="Makueni">Makueni</option>
        <option value="Mandera">Mandera</option>
        <option value="Marsabit">Marsabit</option>
        <option value="Meru">Meru</option>
        <option value="Migori">Migori</option>
        <option value="Mombasa">Mombasa</option>
        <option value="Murang'a">Murang'a</option>
        <option value="Nairobi">Nairobi</option>
        <option value="Nakuru">Nakuru</option>
        <option value="Nandi">Nandi</option>
        <option value="Narok">Narok</option>
        <option value="Nyamira">Nyamira</option>
        <option value="Nyandarua">Nyandarua</option>
        <option value="Nyeri">Nyeri</option>
        <option value="Samburu">Samburu</option>
        <option value="Siaya">Siaya</option>
        <option value="Taita Taveta">Taita Taveta</option>
        <option value="Tana River">Tana River</option>
        <option value="Tharaka Nithi">Tharaka Nithi</option>
        <option value="Trans Nzoia">Trans Nzoia</option>
        <option value="Turkana">Turkana</option>
        <option value="Uasin Gishu">Uasin Gishu</option>
        <option value="Vihiga">Vihiga</option>
        <option value="Wajir">Wajir</option>
        <option value="West Pokot">West Pokot</option>
    </select>
</div>


                                    <div class="col-md-6">
                                        <label class="form-label">First Date of Appointment</label>
                                        <input type="date" name="first_date_of_appointment" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Current Date of Appointment</label>
                                        <input type="date" name="current_date_of_appointment" class="form-control">
                                    </div>

                                    {{-- HR DETAILS --}}
                                    <h6 class="text-muted mt-4">HR Details</h6>
                                    <hr>

                                    <div class="col-md-12">
                                        <label class="form-label">Academic Qualifications</label>
                                        <textarea name="academic_qualifications" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Ongoing Long Courses</label>
                                        <textarea name="ongoing_long_courses" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Career Guideline Requirements</label>
                                        <textarea name="career_guideline_requirements" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Identified Gaps</label>
                                        <textarea name="identified_gaps" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Application Status</label>
                                        <select name="application_status" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="bx bx-save me-1"></i> Save HR Record
                                    </button>
                                </div>

                            </form>
                            <script>
document.addEventListener('DOMContentLoaded', function () {
    const disabilitySelect = document.getElementById('disability');
    const descriptionContainer = document.getElementById('disability-description-container');

    function toggleDescription() {
        if (disabilitySelect.value === 'Yes') {
            descriptionContainer.style.display = 'block';
        } else {
            descriptionContainer.style.display = 'none';
        }
    }

    // Initial check
    toggleDescription();

    // On change
    disabilitySelect.addEventListener('change', toggleDescription);
});
</script>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@include('admin.Dashboard.footer')
