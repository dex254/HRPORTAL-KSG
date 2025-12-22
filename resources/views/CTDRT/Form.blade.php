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

/* =========================================
   GLOBAL BRAND COLORS
========================================= */
:root {
    --brand-primary: rgb(127, 98, 44);     /* Brown-Gold */
    --brand-secondary: rgb(203, 211, 0);   /* Yellow-Green */
    --brand-accent: rgba(203, 211, 0, 0.35);
    --glass-bg: rgba(255, 255, 255, 0.22);
    --glass-border: rgba(255, 255, 255, 0.45);
}

/* =========================================
   BACKGROUND + OVERLAY
========================================= */
body {
    background: url('{{ asset("assets/images/logo-dark.png") }}')
                no-repeat center center fixed;
    background-size: cover;
    position: relative;
}

/* Soft gold overlay */
body::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(127, 98, 44, 0.45);
    backdrop-filter: blur(7px);
    z-index: -1;
}

/* =========================================
   FLOATING CORPORATE PROGRESS BAR
========================================= */
#progress-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 8px;
  background: rgba(0,0,0,0.4);
  overflow: hidden;
  z-index: 1000;
}

#progress-bar {
  height: 100%;
  width: 0%;
  background: linear-gradient(90deg, var(--brand-secondary), var(--brand-primary));
  transition: width 0.4s ease;
}

/* =========================================
   GLASSMORPHIC FORM CONTAINER (PREMIUM)
========================================= */
.form-wrapper {
    max-width: 580px;
    margin: auto;
    margin-top: 40px;
    padding: 30px 32px;
    background: var(--glass-bg);
    border-radius: 18px;
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(18px);
    box-shadow: 
        0 12px 28px rgba(0,0,0,0.25),
        0 6px 12px rgba(127, 98, 44, 0.32);
    position: relative;
    overflow: hidden;
}

/* Narrow glowing gold strip around the form */
.form-wrapper::before {
    content: "";
    position: absolute;
    inset: -5px;
    border-radius: 20px;
    border: 3px solid transparent;
    background: linear-gradient(120deg,
        var(--brand-primary),
        var(--brand-secondary)
    );
    z-index: -1;
    filter: blur(8px);
}

/* =========================================
   SECTION HEADER / INTRO TEXT
========================================= */
.intro {
    text-align: center;
    margin-bottom: 25px;
    padding: 12px 18px;
    background: linear-gradient(to right,
        rgba(255,255,255,0.22),
        rgba(203,211,0,0.30)
    );
    border-left: 7px solid var(--brand-primary);
    border-radius: 10px;
}

.intro h3 {
    color: var(--brand-primary);
    font-weight: 900;
    font-size: 2rem;
}

.intro p {
    color: #000;
    font-size: 15px;
    font-weight: 500;
}

/* =========================================
   FORM ELEMENTS + INPUT WRAPPERS
========================================= */
.input-wrapper {
    padding: 10px 14px;
    background: rgba(255,255,255,0.28);
    border-radius: 12px;
    border: 1px solid rgba(203,211,0,0.35);
    margin-bottom: 14px;
    transition: 0.25s ease-in-out;
}

.input-wrapper:hover {
    background: rgba(255,255,255,0.42);
    transform: translateY(-2px);
}

/* Labels */
label.form-label {
    color: var(--brand-primary);
    font-weight: 800;
    letter-spacing: 0.5px;
}

/* Inputs */
.form-control {
    border: 2px solid var(--brand-primary);
    border-radius: 8px;
    background: rgba(255,255,255,0.82);
    transition: all 0.3s;
}

.form-control:focus {
    border-color: var(--brand-secondary);
    background: #fff;
    box-shadow: 0 0 10px rgba(203,211,0,0.8);
}

/* =========================================
   BUTTONS
========================================= */
.btn-success {
    background: linear-gradient(90deg,
        var(--brand-primary),
        var(--brand-secondary)
    );
    border: none;
    font-weight: 900;
    padding: 12px;
    color: #fff;
    letter-spacing: 1px;
    font-size: 1.1rem;
    border-radius: 10px;
    box-shadow: 0 6px 16px rgba(127, 98, 44, 0.4);
    transition: 0.3s ease-in-out;
}

.btn-success:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 22px rgba(203,211,0,0.55);
    background: linear-gradient(90deg,
        var(--brand-secondary),
        var(--brand-primary)
    );
}

/* =========================================
   AUTOCOMPLETE LIST STYLING
========================================= */
.list-group-item {
    border-left: 4px solid var(--brand-primary);
}

.list-group-item:hover {
    background: var(--brand-secondary);
    font-weight: 700;
}

/* =========================================
   HEADINGS
========================================= */
h4, h5, h6 {
    color: var(--brand-primary);
    font-weight: 700;
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

          <div class="intro text-center mb-3">

    <!-- MAIN TITLE -->
    <h3 style="font-weight: 800; color: #000;">Doing The Right Thing</h3>

    <!-- KISWAHILI MESSAGE (ITALICISED) -->
    <p style="font-style: italic; color: #222; margin-top: 8px;">
        The National Government, in collaboration with the Kenya School of Government (KSG), 
        is celebrating hardworking and dedicated citizens who consistently do the right thing, 
        yet often go unnoticed. 
        <br><br>
        This initiative aims to recognize, appreciate, and motivate individuals whose positive actions 
        make a meaningful difference in their workplaces and communities. By highlighting such exemplary 
        behaviour, we seek to inspire others across the country to uphold integrity, commitment, 
        and excellence.
        <br><br>
        Kindly take a moment to nominate someone who deserves recognition by filling in the form below.
        <br><br>
        <span style="font-style: italic; font-size: 15px;">
            Tafadhali jaza fomu ifuatayo kumteua mtu unayemuona akifanya mambo kwa njia bora.
        </span>
    </p>

    <!-- HASHTAG LINK AT BOTTOM -->
    <a href="#" 
       style="display: inline-block; margin-top: 10px; font-weight: 700; color: #0056b3; text-decoration: underline;">
        #Catch Them Doing the Right Thing
    </a>
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
              <label for="subcounty" class="form-label fw-semibold"> Select Subcounty (Chagua Tarafa)</label>
              <select name="subcounty" id="subcounty" class="form-control" required>
                <option value="">-- Choose Subcounty --</option>
              </select>
            </div>

            <!-- Nomination Fields -->
            <div id="nominationFields" style="display:none;">
              <hr>
              <div class="mb-3">
  <label class="form-label">Enter your phone number (Weka Nambari yako Simu)</label>
  <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number" required>
</div>

              <h5 class="fw-semibold mt-4">1. Nominee Details</h5>

              <div class="mb-3" style="position: relative;">
  <label class="form-label">a) Name of Nominee (Jina la Mteuliwa)</label>
  <input type="text" name="nominee_name" id="nominee_name" class="form-control" placeholder="Enter full name" autocomplete="off" required>

  <!-- Suggestions Box -->
  <div id="nameSuggestions" class="list-group" 
       style="position:absolute; width:100%; z-index:999; max-height:200px; overflow-y:auto;">
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const nameInput = document.getElementById("nominee_name");
    const suggestionsBox = document.getElementById("nameSuggestions");
    const countySelect = document.getElementById("county");
    const subcountySelect = document.getElementById("subcounty");

    nameInput.addEventListener("keyup", function () {
        let query = this.value;
        let county = countySelect.value;
        let subcounty = subcountySelect.value;

        // Only search when minimum 2 chars and location chosen
        if (query.length < 2 || !county || !subcounty) {
            suggestionsBox.innerHTML = "";
            return;
        }

        fetch(`/autocomplete-nominee?q=${encodeURIComponent(query)}&county=${encodeURIComponent(county)}&subcounty=${encodeURIComponent(subcounty)}`)
            .then(res => res.json())
            .then(data => {
                suggestionsBox.innerHTML = "";

                if (data.length === 0) {
                    return;
                }

                data.forEach(name => {
                    let item = document.createElement("a");
                    item.classList.add("list-group-item", "list-group-item-action");
                    item.textContent = name;

                    item.onclick = function () {
                        nameInput.value = name;
                        suggestionsBox.innerHTML = "";
                    };

                    suggestionsBox.appendChild(item);
                });
            });
    });

    // Hide suggestions when clicking elsewhere
    document.addEventListener("click", function (e) {
        if (e.target !== nameInput) {
            suggestionsBox.innerHTML = "";
        }
    });

});
</script>


              <div class="mb-3">
                <label class="form-label">  b) Work Station (Kituo cha Kazi)</label>
                <input type="text" name="work_station" class="form-control" placeholder="Enter work station" required>
              </div>

              <div class="mb-3">
                <label class="form-label">c) Designation (Cheo cha Kazi)</label>
                <input type="text" name="designation" class="form-control" placeholder="Enter designation" required>
              </div>

              <h5 class="fw-semibold mt-4">2. Duties carried out by nominee (Majukumu ya Mteuliwa)</h5>
              <textarea name="duties" class="form-control" rows="3" placeholder="Describe duties performed"
                required></textarea>

              <h5 class="fw-semibold mt-4">  3. Outstanding behavior/activities noted (Tabia Bora Ilizoonekana)</h5>
              <textarea name="outstanding_behavior" class="form-control" rows="3"
                placeholder="What amazing action did you catch them doing?" required></textarea>

              <h5 class="fw-semibold mt-4"> 4. Justification for nomination (Sababu za Kuteua Mtu Huyu)</h5>
              <textarea name="justification" class="form-control" rows="3"
                placeholder="Why does this action deserve recognition?" required></textarea>

              <h5 class="fw-semibold mt-4">  5. Lessons Learnt (Masomo Tuliyojifunza)</h5>
              <textarea name="lessons" class="form-control" rows="3"
                placeholder="What inspiring lesson can others learn from their example?" required></textarea>

              <div class="mb-3">
                <label class="form-label">Optional: Upload supporting evidence(Hiari: Pakia Ushahidi)</label>
                <input type="file" name="attachment" class="form-control"
                  accept="audio/*,video/*,image/*,application/*">
                <small class="text-muted">You may upload a photo, video, audio, or any other file type (optional).</small>
              </div>

              <div class="mb-3 form-check">
                <input type="checkbox" name="confirmation" id="confirmation" class="form-check-input" required>
                <label class="form-check-label" for="confirmation">
                  I confirm that the information I have provided is accurate and correct.
                   (Nathibitisha kuwa taarifa nilizotoa ni sahihi)
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
