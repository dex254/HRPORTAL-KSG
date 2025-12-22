@include('staff.Dashboard.header')

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
								<li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->

                <div class="container">

                <div class="col-sm-12">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item active" aria-current="true"><strong>CURRENT STAFF USER DETAILS</strong></li>
                                        <li class="list-group-item"><strong>Full Name: </strong> <span> {{ Auth::guard('staff')->user()->name}}  </span></li>
                                        <li class="list-group-item"><strong>E-Mail Address: </strong><span>{{ Auth::guard('staff')->user()->email}}</span></li>
                                        <li class="list-group-item"><strong>ID or Passport No.: </strong><span>{{ Auth::guard('staff')->user()->idnumber}}</span></li>
                                        <li class="list-group-item"><strong>Contact: </strong><span>{{ Auth::guard('staff')->user()->phone}}</span></li>
                                        <li class="list-group-item"><strong>Designation: </strong><span>{{ Auth::guard('staff')->user()->designation}}</span></li>
                                        <li class="list-group-item"><strong>Department: </strong><span>{{ Auth::guard('staff')->user()->department}}</span></li>
                                        <li class="list-group-item"><strong>Campus: </strong><span>{{ Auth::guard('staff')->user()->campus}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
         </div>
        
            
       
        
                   
                    <form class="row" action="{{ route('staff.profile.update.post') }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">Key in new details:</h5>
                                    <br>
                                    <div class="row mb-3">
                                        <div>
                                            <label for="formFileLg" class="form-label">Choose  a profile picture</label>
                                            <input class="form-control form-control-lg" id="formFileLg" name="image" type="file" multiple>
                                        </div>
                                    </div>
                                   
                           
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Full Name:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" value="{{ Auth::guard('staff')->user()->name}}" />
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>E-Mail Address:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email" value="{{ Auth::guard('staff')->user()->email}}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>ID or Passport No.:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="idnumber" value="{{ Auth::guard('staff')->user()->idnumber}}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Contact:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone" value="{{ Auth::guard('staff')->user()->phone}}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Department:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="designation" value="{{ Auth::guard('staff')->user()->department}}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="inputCampus" class="form-label">User Type</label>
                                    </div>
                                    <div class="col-sm-9">
                                        
                                            <select name="usertype" class="form-select form-select-lg mb-3">
                                                <option value="Dual user">Dual user</option>
                                                <option value="Coordinator">Coordinator</option>
                                                <option value="Facilitator">Facilitator</option>
                                                
                                            </select>
                                    </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Campus:</p>
                                        </div>
                                            <div id="campus" class="col-sm-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="campus" id="LowerKabete" value="Lower Kabete" 
                                                    {{ (Auth::guard('staff')->user()->campus == 'Lower Kabete') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="LowerKabete">Lower Kabete</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="campus" id="eLDi" value="eLDi" 
                                                    {{ (Auth::guard('staff')->user()->campus == 'eLDi') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="eLDi">eLDi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="campus" id="Mombasa" value="Mombasa" 
                                                    {{ (Auth::guard('staff')->user()->campus == 'Mombasa') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="Mombasa">Mombasa</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="campus" id="Matuga" value="Matuga" 
                                                    {{ (Auth::guard('staff')->user()->campus == 'Matuga') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="Matuga">Matuga</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="campus" id="Embu" value="Embu" 
                                                    {{ (Auth::guard('staff')->user()->campus == 'Embu') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="Embu">Embu</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="campus" id="Baringo" value="Baringo" 
                                                    {{ (Auth::guard('staff')->user()->campus == 'Baringo') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="Baringo">Baringo</label>
                                                </div>
                                            </div>
                                        </div>
                                    

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <input type="submit" class="btn btn-light px-4" value="Save Changes" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form class="row" action="{{ route('staff.delete') }}" method="POST"  >
                    @csrf
                    @method('DELETE')
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Delet  my  account:</h5>
                                <br>
                                <div class="row mb-3">
                                    <div>
                                        <label for="formFileLg" class="form-label">Confirm   password  To  delet Your Account</label>
                                        <input class="form-control form-control-lg" id="formFileLg" type="password" name="password" id="password" required>
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <!-- Confirmation Checkbox -->
                                <div class="form-group form-check">
                                    <input type="checkbox" name="confirm_deletion" id="confirm_deletion" class="form-check-input" required>
                                    <label for="confirm_deletion" class="form-check-label">
                                        I am sure I want to delete my account permanently.
                                    </label>
                                    @error('confirm_deletion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                            </form>
                </div>
                
                                </div>
                        </div>
                    </div>
        	</div>
    	</div>
		<!--end page wrapper -->
	</div>
	<!--end wrapper-->


    @include('staff.Dashboard.footer')
