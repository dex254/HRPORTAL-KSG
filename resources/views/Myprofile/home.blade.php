@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Account Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile </li>
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
                            <a class="dropdown-item" href="/Update_Profile">Edit Profile</a>
                            
                           
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
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Login Time :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->updated_at}}" readonly />
                                        </div>
                                       
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Full Name :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->name}}" readonly />
                                        </div>
                                       
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Campus :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->campus}}" readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">E-Mail :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->email}}" readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">ID/ Passport No :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->idnumber}}" readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone Contact :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->phone}}"; " readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Gender :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->gender}}" readonly />
                                        </div>
                                        
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Eny disabilty :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->disability}}" readonly />
                                        </div>
                                        
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">   Disability :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->What}}" readonly />
                                        </div>
                                        
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Ethnicity :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::guard('HR')->user()->ethnicity}}" readonly />
                                        </div>
                                        
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Ongoing long courses  and  Indicate  completion  date  for  each :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="inputAddress" placeholder="Enter academic qualifications..." rows="3">
                                                {{ Auth::guard('HR')->user()->ongoing_long_courses }}
                                            </textarea>
                                            
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Academic Qualification :</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="inputAddress" placeholder="Enter academic qualifications..." rows="3">
                                                {{ Auth::guard('HR')->user()->academic_qualifications }}
                                            </textarea>
                                            
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Career guideline requirements:</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="inputAddress" placeholder="Enter academic qualifications..." rows="3">
                                                {{ Auth::guard('HR')->user()->career_guideline_requirements }}
                                            </textarea>
                                            
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Identified_gaps:</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="inputAddress" placeholder="Enter academic qualifications..." rows="3">
                                                {{ Auth::guard('HR')->user()->identified_gaps }}
                                            </textarea>
                                            
                                        </div>
                                    </div>
                                    
                                    
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