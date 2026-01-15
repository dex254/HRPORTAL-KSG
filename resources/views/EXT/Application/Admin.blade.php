@include('admin.Dashboard.header')


<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Create  an External job  advart</li>
                        </ol>
                    </nav>
                </div>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @error('current_password')
            <div class="text-danger">{{ $message }}</div>
          @enderror
          @if ($errors->any() || session('success'))
          <div class="alert alert-{{ $errors->any() ? 'danger' : 'success' }}" role="alert">
              @if ($errors->any())
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
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
@if ($errors->any())
<div class="alert alert-danger" id="error-message">
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif

<!-- Style for alert boxes -->
<style>
.alert {
  padding: 15px; /* Add some padding */
  border-radius: 5px; /* Round corners */
  margin-bottom: 20px; /* Space between messages */
  display: block; /* Ensure the message is displayed as a block element */
}

.alert-success {
  background-color: yellow; /* Yellow background for success */
  color: #333; /* Dark text color */
  border: 1px solid #ccc; /* Border for the alert */
}

.alert-danger {
  background-color: #f8d7da; /* Light red background for errors */
  color: #721c24; /* Dark red text color */
  border: 1px solid #f5c6cb; /* Border for the alert */
}
</style>

<!-- Flickering effect using JavaScript -->
<script>
// Function to add flicker effect
function flickerEffect(elementId) {
  const element = document.getElementById(elementId);
  if (element) {
      let visible = true;
      setInterval(() => {
          element.style.visibility = visible ? 'hidden' : 'visible';
          visible = !visible;
      }, 470); // 500ms flicker interval
  }
}

// Apply flicker effect to success or error messages
if (document.getElementById('success-message')) {
  flickerEffect('success-message');
}

if (document.getElementById('error-message')) {
  flickerEffect('error-message');
}
</script>
                <div class="ms-auto">
                   
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">Job Avart</h5>
                                    <br>
                                   <form class="row g-3" action="{{ route('EXT.JOB.create') }}" method="POST">
    @csrf

    <div class="col-md-6">
        <label for="Designation" class="form-label">Position Name</label>
        <input type="text" class="form-control" name="Designation" placeholder="e.g., Nutrition" required>
    </div>

    <input type="hidden" name="Job_Group" value="All">


    <input type="hidden" name="level" value="All">

    <div class="col-md-6">
        <label for="Proposed_No_of_Positions" class="form-label">Proposed No. of Positions</label>
        <input type="text" class="form-control" name="Proposed_No_of_Positions" required>
    </div>

    <div class="col-md-6">
        <label for="AE" class="form-label">AE</label>
        <input type="text" class="form-control" name="AE" required>
    </div>

    <div class="col-md-6">
        <label for="IP" class="form-label">IP</label>
        <input type="text" class="form-control" name="IP" required>
    </div>

    <div class="col-md-6">
        <label for="Var" class="form-label">Var</label>
        <input type="text" class="form-control" name="Var" required>
    </div>

    <div class="col-md-6">
        <label for="Ref_NO" class="form-label">Reference Number</label>
        <input type="text" class="form-control" name="Ref_NO" required>
    </div>

    <div class="col-md-6">
        <label for="datefrom" class="form-label">Start Date</label>
        <input type="date" class="form-control" name="datefrom" required>
    </div>

    <div class="col-md-6">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" class="form-control" name="deadline" required>
    </div>
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
