<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>#Catch Them Doing the Right Thing – Nomination Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Nomination Form for Public Officers Doing the Right Thing" name="description" />
  <meta content="Kenya School of Government" name="author" />
  <link rel="shortcut icon" href="assets/images/logo-dark.png">

  <!-- Vendor & App CSS -->
  <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

  <style>
    /* === Floating Progress Bar === */
#progress-container {
  position: fixed;        /* makes it float */
  top: 0;                 /* sticks to top */
  left: 0;
  width: 100%;
  height: 8px;
  background: #222;
  border-radius: 0;       /* flat top edge for full-width bar */
  overflow: hidden;
  z-index: 1000;          /* ensures it stays above everything */
}

#progress-bar {
  height: 100%;
  width: 0%;
  background: linear-gradient(90deg, red, orange, yellow, limegreen);
  transition: width 0.4s ease, background 0.4s ease;
}


    /* === Description Section === */
    /* ✨ Page content intro (improved visibility) */
.intro {
    text-align: center;
    margin-bottom: 30px;
}

.intro h3 {
    font-weight: 700;
    color: #000; /* Black heading */
    text-shadow: none; /* Remove glow */
    font-size: 1.8rem;
}

.intro p {
    color: #000; /* Black paragraph text */
    font-size: 16px;
    line-height: 1.6;
    font-weight: 500;
    max-width: 600px;
    margin: 0 auto;
}

.intro a {
    color: #198754; /* Bootstrap success green for contrast */
    font-weight: 600;
    text-decoration: underline;
}

  </style>
</head>

<body>

  <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
    <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
      <div class="col-xl-5 col-lg-6 col-md-8">
        <div class="card overflow-hidden text-center h-100 p-xxl-4 p-4 mb-0">

          <!-- === Progress Bar === -->
          <div id="progress-container">
            <div id="progress-bar"></div>
          </div><script>// 🟢 Floating progress bar logic
const progressBar = document.getElementById('progress-bar');

function updateProgress() {
  const requiredFields = Array.from(form.querySelectorAll('[required]'));
  const filledFields = requiredFields.filter(field => field.value.trim() !== '');
  const progress = (filledFields.length / requiredFields.length) * 100;
  progressBar.style.width = `${progress}%`;
}

inputs.forEach(input => input.addEventListener('input', updateProgress));
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '{{ session('success') }}',
    confirmButtonColor: '#3085d6',
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Login Failed',
    text: '{{ session('error') }}',
    confirmButtonColor: '#d33',
});
</script>
@endif

@if ($errors->any())
<script>
Swal.fire({
    icon: 'warning',
    title: 'Validation Error',
    html: `{!! implode('<br>', $errors->all()) !!}`,
    confirmButtonColor: '#f39c12',
});
</script>
@endif

          <a href="#" class="auth-brand mb-3">
            <img src="assets/images/logo-dark.png" alt="KSG logo" height="40" class="logo-dark">
          </a>

          <!-- 🌟 Intro Section -->
          <div class="intro">
            <h3>#Catch Them Doing the Right Thing</h3>
            <p>
              The Kenya School of Government is celebrating public officers in Kenya doing the right thing,
              but who often go unnoticed. This initiative seeks to recognize and motivate them —
              encouraging others to stand out for the right reasons.
              Please take a moment to nominate someone who has been doing the right thing
              and help us appreciate them.
              Kindly send your filled-in forms to
              <a href="mailto:ipslei@ksg.ac.ke">ipslei@ksg.ac.ke</a>.
            </p>
          </div>

          <form  class="text-start mb-3" id="nominationForm"  action="{{ route('nomination.store') }}" enctype="multipart/form-data"  method="POST" >
            @csrf
            <input type="hidden" name="country" value="Kenya">

            <!-- County Dropdown -->
            <div class="mb-3">
              <label for="county" class="form-label fw-semibold">Select County</label>
              <select name="county" id="county" class="form-control" required>
                <option value="">-- Choose County --</option>
                @foreach($counties as $county)
                <option value="{{ $county->CountyName }}">{{ $county->CountyName }}</option>
                @endforeach
              </select>
            </div>

            <!-- Subcounty Dropdown -->
            <div class="mb-3" id="subcounty-div" style="display:none;">
              <label for="subcounty" class="form-label fw-semibold">Select Subcounty</label>
              <select name="subcounty" id="subcounty" class="form-control" required>
                <option value="">-- Choose Subcounty --</option>
              </select>
            </div>

            <!-- Nomination Fields -->
            <div id="nominationFields" style="display:none;">
              <hr>
              <h5 class="fw-semibold mt-4">1. Nominee Details</h5>

              <div class="mb-3">
                <label class="form-label">a) Name of Nominee</label>
                <input type="text" name="nominee_name" class="form-control" placeholder="Enter full name" required>
              </div>

              <div class="mb-3">
                <label class="form-label">b) Work Station</label>
                <input type="text" name="work_station" class="form-control" placeholder="Enter work station" required>
              </div>

              <div class="mb-3">
                <label class="form-label">c) Designation</label>
                <input type="text" name="designation" class="form-control" placeholder="Enter designation" required>
              </div>

              <h5 class="fw-semibold mt-4">2. Duties carried out by nominee</h5>
              <textarea name="duties" class="form-control" rows="3" placeholder="Describe duties performed"
                required></textarea>

              <h5 class="fw-semibold mt-4">3. Outstanding behavior/activities noted</h5>
              <textarea name="outstanding_behavior" class="form-control" rows="3"
                placeholder="What amazing action did you catch them doing?" required></textarea>

              <h5 class="fw-semibold mt-4">4. Justification for nomination</h5>
              <textarea name="justification" class="form-control" rows="3"
                placeholder="Why does this action deserve recognition?" required></textarea>

              <h5 class="fw-semibold mt-4">5. Lessons Learnt</h5>
              <textarea name="lessons" class="form-control" rows="3"
                placeholder="What inspiring lesson can others learn from their example?" required></textarea>

              <div class="mb-3">
                <label class="form-label">Optional: Upload supporting evidence</label>
                <input type="file" name="attachment" class="form-control"
                  accept="audio/*,video/*,image/*,application/*">
                <small class="text-muted">You may upload a photo, video, audio, or any other file type (optional).</small>
              </div>

              <div class="mb-3 form-check">
                <input type="checkbox" name="confirmation" id="confirmation" class="form-check-input" required>
                <label class="form-check-label" for="confirmation">
                  I confirm that the information I have provided is accurate and correct.
                </label>
              </div>

              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-success">Submit Nomination</button>
              </div>
            </div>
          </form>

          <p class="mt-auto mb-0 text-muted small">
            <script>document.write(new Date().getFullYear())</script> © Kenya School of Government
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Logic -->
  <script src="assets/js/vendor.min.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('nominationForm');
      const inputs = form.querySelectorAll('input, select, textarea');
      const progressBar = document.getElementById('progress-bar');
      const countySelect = document.getElementById('county');
      const subcountySelect = document.getElementById('subcounty');
      const subcountyContainer = document.getElementById('subcounty-div');
      const nominationFields = document.getElementById('nominationFields');

      function updateProgress() {
        const required = Array.from(inputs).filter(i => i.hasAttribute('required'));
        const filled = required.filter(i => i.type === 'checkbox' ? i.checked : i.value.trim() !== '');
        const progress = (filled.length / required.length) * 100;

        progressBar.style.width = progress + '%';

        // Color change from red → green
        if (progress < 30) progressBar.style.background = 'red';
        else if (progress < 60) progressBar.style.background = 'orange';
        else if (progress < 90) progressBar.style.background = 'yellow';
        else progressBar.style.background = 'limegreen';
      }

      inputs.forEach(input => {
        input.addEventListener('input', updateProgress);
        input.addEventListener('change', updateProgress);
      });

      // Dynamic dropdowns
      countySelect.addEventListener('change', function () {
        const county = this.value;
        subcountySelect.innerHTML = '<option value="">-- Choose Subcounty --</option>';
        nominationFields.style.display = 'none';
        updateProgress();

        if (county) {
          fetch(`/ctdrt/subcounties?county=${encodeURIComponent(county)}`)
            .then(res => res.json())
            .then(data => {
              if (data.length > 0) {
                data.forEach(sub => {
                  const opt = document.createElement('option');
                  opt.value = sub;
                  opt.textContent = sub;
                  subcountySelect.appendChild(opt);
                });
                subcountyContainer.style.display = 'block';
              } else {
                subcountyContainer.style.display = 'none';
              }
            });
        } else {
          subcountyContainer.style.display = 'none';
        }
      });

      subcountySelect.addEventListener('change', function () {
        nominationFields.style.display = this.value ? 'block' : 'none';
        updateProgress();
      });
    });
  </script>
</body>

</html>
