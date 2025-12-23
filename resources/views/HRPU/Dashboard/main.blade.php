
	   <!--end header wrapper-->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				
					<div class="d-flex justify-content-start mt-4">
                        <form method="POST" action="{{ route('HRPU.logout') }}">
                            @csrf
                            <button type="submit" class="btn logout-button px-4 py-2 me-2">
                                <i class="bx bx-log-out-circle me-2 text-white"></i>
                                <span class="text-white">Logout</span>
                            </button>
                        </form>
                        
                        <button onclick="location.href='{{ route('Academic.Ext') }}'" class="btn next-button px-4 py-2">
                            Next
                        </button>
                        
                        <style>
                            /* Logout Button */
                            .logout-button {
                                background-color: rgb(127, 98, 44); /* Requested color */
                                color: white; /* Text color */
                                border: none;
                                border-radius: 5px;
                                cursor: pointer;
                                transition: background-color 0.3s ease, color 0.3s ease;
                            }
                        
                            /* Next Button */
                            .next-button {
                                background-color: rgb(203, 211, 0); /* Requested color */
                                color: black; /* Default text color */
                                border: none;
                                border-radius: 5px;
                                cursor: pointer;
                                transition: background-color 0.3s ease, color 0.3s ease;
                            }
                        
                            /* Hover effects */
                            .next-button:hover {
                                background-color: white; /* Change to white on hover */
                                color: black; /* Black text on hover */
                                border: 1px solid black;
                            }
                        </style>
                        
				</div>
				
				<br>
				<br>
			<br>
			<br>
			<br>
 

						  
				  <div class="row">
					
					   <div class="card radius-10 w-100">
						
						<div class="container">
							<div class="main-body">
								<div class="row">
								   
									
										
									<div class="col-lg-12">
										
										<div id="form-sections">
											<div  class="card-body">
												
												</a>
												
												<h5 class="d-flex align-items-center mb-3">Personal Details</h5>


												<br>
												<!-- Button to Open Modal -->


												<!-- Update Profile Modal -->
<!-- Button to Open Modal -->
<div class="d-flex justify-content-end mb-3">
    <button class="btn update-profile-button" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
        Update Profile
    </button>
    
    <style>
        /* Update Profile Button */
        .update-profile-button {
            background-color: rgb(127, 98, 44); /* Brown color */
            color: white; /* White text */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    
        /* Hover effect */
        .update-profile-button:hover {
            background-color: white; /* Turns white on hover */
            color: rgb(127, 98, 44); /* Brown text on hover */
            border: 1px solid rgb(127, 98, 44);
        }
    </style>
    
</div>


<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 shadow-lg"
             style="border-radius: 10px; background-color: white; max-width: 600px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Your Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to Update User Data -->
                <form id="updateProfileForm" action="{{ route('Myprofile.extupdatemy') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full   name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ Auth::guard('HRPU')->user()->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ Auth::guard('HRPU')->user()->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile Number:</label>
                        <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" 
                               name="mobile_no" value="{{ Auth::guard('HRPU')->user()->mobile_no }}" required>
                        @error('mobile_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   <div class="mb-3">
    <label for="dob" class="form-label">Date of Birth:</label>
    <input type="date" 
           id="dob"
           name="dob"
           class="form-control @error('dob') is-invalid @enderror"
           value="{{ Auth::guard('HRPU')->user()->dob }}"
           max=""
           required>
    @error('dob')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
    @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dobInput = document.getElementById('dob');

        // Get today's date
        const today = new Date();

        // Subtract 7 years
        const maxDate = new Date(today.getFullYear() - 7, today.getMonth(), today.getDate());

        // Format to yyyy-mm-dd
        const formattedMax = maxDate.toISOString().split('T')[0];

        // Set as max
        dobInput.max = formattedMax;
    });
</script>

<style>
    #dob::-webkit-calendar-picker-indicator {
        filter: invert(0.5);
    }

    input[type="date"] {
        background-color: #f9f5f0;
        color: #333;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 6px;
        font-size: 16px;
    }

    input[type="date"]:focus {
        border-color: #bfa100;
        box-shadow: 0 0 0 0.2rem rgba(191, 161, 0, 0.25);
        outline: none;
    }
</style>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Postal Address:</label>
                        <input type="text" class="form-control @error('postal_address') is-invalid @enderror" name="postal_address" value="{{ Auth::guard('HRPU')->user()->postal_address }}" required>
                       
                    </div>
                    <style>
    /* Custom dropdown styling */
    .custom-nationality-select {
        background-color: #f9f5f0; /* Light cream background */
        color: #000; /* Text color */
        font-weight: 500;
        border: 1px solid #ccc;
    }

    .custom-nationality-select option {
        color: #000 !important;
        background-color: #fff; /* optional: white option bg */
    }

    .custom-nationality-select:focus {
        border-color: #bfa100;
        box-shadow: 0 0 0 0.2rem rgba(191, 161, 0, 0.25);
    }
</style>

<div class="mb-3">
    <label for="nationality" class="form-label">Select Nationality:</label>
    <select name="nationality" id="nationality"
            class="form-select custom-nationality-select @error('nationality') is-invalid @enderror"
            required>
        <option value="" disabled>Select your nationality</option>
        @foreach ($nationalities as $nationality)
            <option value="{{ $nationality->name }}"
                {{ Auth::guard('HRPU')->user()->nationality == $nationality->name ? 'selected' : '' }}>
                {{ $nationality->name }}
            </option>
        @endforeach
    </select>
    @error('nationality')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
    @enderror
</div>



                  
                   
                   

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Show/Hide Disability Description -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const disabilitySelect = document.getElementById("disability");
        const disabilityDescriptionDiv = document.getElementById("disabilityDescriptionDiv");

        function toggleDisabilityDescription() {
            if (disabilitySelect.value === "Yes") {
                disabilityDescriptionDiv.style.display = "block";
            } else {
                disabilityDescriptionDiv.style.display = "none";
            }
        }

        // Show the disability description if the user already has a disability
        toggleDisabilityDescription();

        // Listen for changes in the disability dropdown
        disabilitySelect.addEventListener("change", toggleDisabilityDescription);
    });
</script>


												
												
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Full Name :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('HRPU')->user()->name}}" readonly />
													</div>
												   
												</div>
                                               
                                                
												
												<div class="row mb-3">
													
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">E-Mail :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('HRPU')->user()->email}}" readonly />
													</div>
												</div>
												
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Phone Number:</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('HRPU')->user()->mobile_no}}" readonly />
													</div>
												</div>
												
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Date  of  Birth :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('HRPU')->user()->dob}}" readonly />
													</div>
													
												</div>
												
												
												
												
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Natinality :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('HRPU')->user()->nationality}}" readonly />
													</div>
												</div>
                                                <div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Postal  Address :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('HRPU')->user()->postal_address}}" readonly />
													</div>
												</div>

													
												</div>
                                                
											
												
												
												
												
											</div>
                                            
										</div>
									</div>
                                    
										</div>
									</div>
                                    
								</div>
                                <!-- Title -->
<div class="row mb-3">
    <div class="col-12">
        <h5 class="text-primary">
            Download the document, fill it, and upload it as your CV in the application for the Adjunct Faculty position
        </h5>
    </div>
</div>

<!-- Download Word Document (Moved to Top) -->
<div class="row mb-3">
    <div class="col-12">
        <a href="{{ asset('assets/ksgw.docx') }}" class="btn btn-success" download>
            📄 Download KSG Word Document
        </a>
    </div>
</div>

<!-- PDF Viewer -->
<div class="row mb-4">
    <div class="col-12">
        <iframe src="{{ asset('assets/ksgd.pdf') }}" width="100%" height="600px" style="border: 1px solid #ccc;"></iframe>
    </div>
</div>

<!-- Upload Section -->
<div class="row mb-4">
    <div class="col-md-6">
        
    </div>
</div>

							</div>
						</div>
					   </div>
					</div>
			   
					
				   </div><!--End Row-->


				  
		</div>