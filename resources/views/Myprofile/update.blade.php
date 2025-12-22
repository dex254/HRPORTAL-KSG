@include('HR.Dashboard.header')

@include('HR.Dashboard.Status')
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
                            <li class="breadcrumb-item active" aria-current="page">Update  Profile </li>
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
                    <div class="btn-group">
                        <button type="button" class="btn btn-light">Settings</button>
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            <a class="dropdown-item" href="/HR/profile/edit">Edit Profile</a>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body">
                    <div class="row">
                       
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">User Details</h5>
                                    <br>
                                    <form class="row g-3" action="{{ route('Myprofile.updatemy') }}" method="POST"  >
                                        @csrf
    
                                      
                                       
                                        
                                       
                                       
                                       
                                        <div class="col-md-6">
                                            <label class="form-label">Any Disability?</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="disability" id="disabilityYes" value="Yes" 
                                                    {{ Auth::guard('HR')->user()->disability && Auth::guard('HR')->user()->disability != 'No' ? 'checked' : '' }} 
                                                    onclick="toggleDisabilityInput()">
                                                <label class="form-check-label" for="disabilityYes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="disability" id="disabilityNo" value="No" 
                                                    {{ Auth::guard('HR')->user()->disability == 'No' ? 'checked' : '' }} 
                                                    onclick="toggleDisabilityInput()">
                                                <label class="form-check-label" for="disabilityNo">No</label>
                                            </div>
                                        </div>
                                        
                                        <!-- Disability Description Input (Hidden by Default) -->
                                        <div class="col-md-6" id="disability-description-container" style="display: none;">
                                            <label for="disability_description" class="form-label">Describe Your Disability</label>
                                            <input type="text" class="form-control" name="disability_description" id="disability_description" 
                                                value="{{ Auth::guard('HR')->user()->disability && Auth::guard('HR')->user()->disability != 'No' ? Auth::guard('HR')->user()->disability : '' }}" 
                                                placeholder="Enter disability details">
                                        </div>
                                        
                                        <!-- Hidden Input Field for "No" Value -->
                                        <input type="hidden" name="disability_description" id="disability_hidden" value="No">
                                        
                                        <!-- JavaScript to Toggle Disability Input -->
                                        <script>
                                            function toggleDisabilityInput() {
                                                var disabilityYes = document.getElementById("disabilityYes");
                                                var disabilityDescriptionContainer = document.getElementById("disability-description-container");
                                                var disabilityDescriptionInput = document.getElementById("disability_description");
                                                var disabilityHiddenInput = document.getElementById("disability_hidden");
                                        
                                                if (disabilityYes.checked) {
                                                    disabilityDescriptionContainer.style.display = "block";
                                                    disabilityDescriptionInput.setAttribute("required", "required");
                                                    disabilityHiddenInput.value = "";
                                                } else {
                                                    disabilityDescriptionContainer.style.display = "none";
                                                    disabilityDescriptionInput.removeAttribute("required");
                                                    disabilityHiddenInput.value = "No"; // If No is selected, store "No"
                                                }
                                            }
                                        
                                            // Check on page load if "Yes" was previously selected
                                            document.addEventListener("DOMContentLoaded", function () {
                                                toggleDisabilityInput();
                                            });
                                        </script>
                                        
                                        
                                        
                                       
                                        
                                       
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Academic Qualification </label>
                                            <textarea class="form-control" id="inputAddress" name="academic_qualifications" placeholder="Enter academic qualifications..." rows="3">
                                                {{ Auth::guard('HR')->user()->academic_qualifications }}
                                            </textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Career guideline requirements</label>
                                            <textarea class="form-control" id="inputAddress" name="career_guideline_requirements" placeholder="Enter academic qualifications..." rows="3">
                                                {{ Auth::guard('HR')->user()->career_guideline_requirements }}
                                            </textarea>
                                        </div>
                                        <div class="col-12"> 
                                            <label for="inputAddress2" class="form-label">Identified gaps</label>
                                            <textarea class="form-control" name="identified_gaps" id="inputAddress" placeholder="Enter academic qualifications..." rows="3">
                                                {{ Auth::guard('HR')->user()->identified_gaps }}
                                            </textarea>
                                        </div>
                                        <div class="col-12"> 
                                            <label for="inputAddress2" class="form-label">Ongoing long courses  and  Indicate  completion  date  for  each </label>
                                            <textarea class="form-control" id="inputAddress"  name="ongoing_long_courses" placeholder="Enter academic qualifications..." rows="3">
                                                {{ Auth::guard('HR')->user()->ongoing_long_courses }}
                                            </textarea>
                                        </div>
                                        
                                       
                                        
                                        
                                        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-light px-5">Update</button>
                                        </div>
                                    </form>
                                    
                                   
                                    
                                    
                                    
                                    
                                   
                                    
                                    
                                    
                                   
                                   
                                    
                                    
                                    
                                   
                                    
                                    
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

@include('HR.Dashboard.footer')