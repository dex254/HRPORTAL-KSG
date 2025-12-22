
	   <!--end header wrapper-->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				
					<div class="d-flex justify-content-start mt-4">
                        <form method="POST" action="{{ route('EXT.logout') }}">
                            @csrf
                            <button type="submit" class="btn logout-button px-4 py-2 me-2">
                                <i class="bx bx-log-out-circle me-2 text-white"></i>
                                <span class="text-white">Logout</span>
                            </button>
                        </form>
                        
                        <button onclick="location.href='{{ route('EXT.Academic.Home') }}'" class="btn next-button px-4 py-2">
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
            style="border-radius: 10px; background-color: white; width: 100%; margin: auto;"


>
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Your Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to Update User Data -->
                <form id="updateProfileForm" action="{{ route('Myprofile.EXT') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full   name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ Auth::guard('EXT')->user()->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <!-- Email -->
                    <div class="mb-3">
                        
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                  name="email"  value="{{ Auth::guard('EXT')->user()->email }}" readonly>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
    <label for="gender" class="form-label">Gender:</label>
    <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="Male" {{ Auth::guard('EXT')->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ Auth::guard('EXT')->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
    </select>
    @error('gender')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="idnumber" class="form-label">National ID Number:</label>
    <input type="text" class="form-control @error('idnumber') is-invalid @enderror" 
           name="idnumber" value="{{ Auth::guard('EXT')->user()->idnumber }}" required>
    @error('idnumber')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


                    <!-- Phone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile Number:</label>
                        <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" 
                               name="mobile_no" value="{{ Auth::guard('EXT')->user()->mobile_no }}" required>
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
           value="{{ Auth::guard('EXT')->user()->dob }}"
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
                        <input type="text" class="form-control @error('postal_address') is-invalid @enderror" name="postal_address" value="{{ Auth::guard('EXT')->user()->postal_address }}" required>
                       
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
                {{ Auth::guard('EXT')->user()->nationality == $nationality->name ? 'selected' : '' }}>
                {{ $nationality->name }}
            </option>
        @endforeach
    </select>
    @error('nationality')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
                        <label for="disability" class="form-label">Do you have a disability?</label>
                        <select class="form-control" name="disability" id="disability" required>
                            
                            <option value="No" {{ Auth::guard('EXT')->user()->disability == 'No' ? 'selected' : '' }}>No</option>
                            <option value="Yes" {{ Auth::guard('EXT')->user()->disability == 'Yes' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <!-- Disability Description (Hidden by Default) -->
                    <div class="mb-3" id="disabilityDescriptionDiv" style="display: none;">
                        <label for="disability_description" class="form-label">Disability Type:</label>
                        <select class="form-control" name="disability_description">
                            <option value="Physical Disability" {{ Auth::guard('EXT')->user()->disability_description == 'Physical Disability' ? 'selected' : '' }}>Physical Disability</option>
                            <option value="Vision Impairment" {{ Auth::guard('EXT')->user()->disability_description == 'Vision Impairment' ? 'selected' : '' }}>Vision Impairment</option>
                            <option value="Hearing Impairment" {{ Auth::guard('EXT')->user()->disability_description == 'Hearing Impairment' ? 'selected' : '' }}>Hearing Impairment</option>
                            <option value="Speech Disability" {{ Auth::guard('EXT')->user()->disability_description == 'Speech Disability' ? 'selected' : '' }}>Speech Disability</option>
                            <option value="Mental Disorder" {{ Auth::guard('EXT')->user()->disability_description == 'Mental Disorder' ? 'selected' : '' }}>Mental Disorder</option>
                            <option value="Maxillofacial Disabilities" {{ Auth::guard('EXT')->user()->disability_description == 'Maxillofacial Disabilities' ? 'selected' : '' }}>Maxillofacial Disabilities</option>
                            <option value="Progressive Chronic Disorders" {{ Auth::guard('EXT')->user()->disability_description == 'Progressive Chronic Disorders' ? 'selected' : '' }}>Progressive Chronic Disorders</option>
                            <option value="Others" {{ Auth::guard('EXT')->user()->disability_description == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>

                    </div>
                    <div class="mb-3" id="disabilityDocumentDiv" style="display: none;">
    <label for="disability_document" class="form-label">
        Upload NCPWD Card <span class="text-danger">*</span>
    </label>
    <input type="file" class="form-control" name="document" accept=".jpg,.jpeg,.png,.pdf">
    <small class="form-text text-muted">
        Please upload a valid copy of your <strong>NCPWD (National Council for Persons with Disabilities)</strong> card. Accepted formats: JPG, PNG, PDF.
    </small>
</div>

                    <div class="mb-3">
                        <label for="home_county" class="form-label">Home County:</label>
                        <select class="form-control" name="home_county" id="home_county">
                            <option value="">Select County</option>
                            <option value="Mombasa" {{ Auth::guard('EXT')->user()->home_county == 'Mombasa' ? 'selected' : '' }}>Mombasa</option>
                            <option value="Kwale" {{ Auth::guard('EXT')->user()->home_county == 'Kwale' ? 'selected' : '' }}>Kwale</option>
                            <option value="Kilifi" {{ Auth::guard('EXT')->user()->home_county == 'Kilifi' ? 'selected' : '' }}>Kilifi</option>
                            <option value="Tana River" {{ Auth::guard('EXT')->user()->home_county == 'Tana River' ? 'selected' : '' }}>Tana River</option>
                            <option value="Lamu" {{ Auth::guard('EXT')->user()->home_county == 'Lamu' ? 'selected' : '' }}>Lamu</option>
                            <option value="Taita-Taveta" {{ Auth::guard('EXT')->user()->home_county == 'Taita-Taveta' ? 'selected' : '' }}>Taita-Taveta</option>
                            <option value="Garissa" {{ Auth::guard('EXT')->user()->home_county == 'Garissa' ? 'selected' : '' }}>Garissa</option>
                            <option value="Wajir" {{ Auth::guard('EXT')->user()->home_county == 'Wajir' ? 'selected' : '' }}>Wajir</option>
                            <option value="Mandera" {{ Auth::guard('EXT')->user()->home_county == 'Mandera' ? 'selected' : '' }}>Mandera</option>
                            <option value="Marsabit" {{ Auth::guard('EXT')->user()->home_county == 'Marsabit' ? 'selected' : '' }}>Marsabit</option>
                            <option value="Isiolo" {{ Auth::guard('EXT')->user()->home_county == 'Isiolo' ? 'selected' : '' }}>Isiolo</option>
                            <option value="Meru" {{ Auth::guard('EXT')->user()->home_county == 'Meru' ? 'selected' : '' }}>Meru</option>
                            <option value="Tharaka-Nithi" {{ Auth::guard('EXT')->user()->home_county == 'Tharaka-Nithi' ? 'selected' : '' }}>Tharaka-Nithi</option>
                            <option value="Embu" {{ Auth::guard('EXT')->user()->home_county == 'Embu' ? 'selected' : '' }}>Embu</option>
                            <option value="Kitui" {{ Auth::guard('EXT')->user()->home_county == 'Kitui' ? 'selected' : '' }}>Kitui</option>
                            <option value="Machakos" {{ Auth::guard('EXT')->user()->home_county == 'Machakos' ? 'selected' : '' }}>Machakos</option>
                            <option value="Makueni" {{ Auth::guard('EXT')->user()->home_county == 'Makueni' ? 'selected' : '' }}>Makueni</option>
                            <option value="Nyandarua" {{ Auth::guard('EXT')->user()->home_county == 'Nyandarua' ? 'selected' : '' }}>Nyandarua</option>
                            <option value="Nyeri" {{ Auth::guard('EXT')->user()->home_county == 'Nyeri' ? 'selected' : '' }}>Nyeri</option>
                            <option value="Kirinyaga" {{ Auth::guard('EXT')->user()->home_county == 'Kirinyaga' ? 'selected' : '' }}>Kirinyaga</option>
                            <option value="Murang'a" {{ Auth::guard('EXT')->user()->home_county == "Murang'a" ? 'selected' : '' }}>Muranga</option>
                            <option value="Kiambu" {{ Auth::guard('EXT')->user()->home_county == 'Kiambu' ? 'selected' : '' }}>Kiambu</option>
                            <option value="Turkana" {{ Auth::guard('EXT')->user()->home_county == 'Turkana' ? 'selected' : '' }}>Turkana</option>
                            <option value="West Pokot" {{ Auth::guard('EXT')->user()->home_county == 'West Pokot' ? 'selected' : '' }}>West Pokot</option>
                            <option value="Samburu" {{ Auth::guard('EXT')->user()->home_county == 'Samburu' ? 'selected' : '' }}>Samburu</option>
                            <option value="Trans Nzoia" {{ Auth::guard('EXT')->user()->home_county == 'Trans Nzoia' ? 'selected' : '' }}>Trans Nzoia</option>
                            <option value="Uasin Gishu" {{ Auth::guard('EXT')->user()->home_county == 'Uasin Gishu' ? 'selected' : '' }}>Uasin Gishu</option>
                            <option value="Elgeyo-Marakwet" {{ Auth::guard('EXT')->user()->home_county == 'Elgeyo-Marakwet' ? 'selected' : '' }}>Elgeyo-Marakwet</option>
                            <option value="Nandi" {{ Auth::guard('EXT')->user()->home_county == 'Nandi' ? 'selected' : '' }}>Nandi</option>
                            <option value="Baringo" {{ Auth::guard('EXT')->user()->home_county == 'Baringo' ? 'selected' : '' }}>Baringo</option>
                            <option value="Laikipia" {{ Auth::guard('EXT')->user()->home_county == 'Laikipia' ? 'selected' : '' }}>Laikipia</option>
                            <option value="Nakuru" {{ Auth::guard('EXT')->user()->home_county == 'Nakuru' ? 'selected' : '' }}>Nakuru</option>
                            <option value="Narok" {{ Auth::guard('EXT')->user()->home_county == 'Narok' ? 'selected' : '' }}>Narok</option>
                            <option value="Kajiado" {{ Auth::guard('EXT')->user()->home_county == 'Kajiado' ? 'selected' : '' }}>Kajiado</option>
                            <option value="Kericho" {{ Auth::guard('EXT')->user()->home_county == 'Kericho' ? 'selected' : '' }}>Kericho</option>
                            <option value="Bomet" {{ Auth::guard('EXT')->user()->home_county == 'Bomet' ? 'selected' : '' }}>Bomet</option>
                            <option value="Kakamega" {{ Auth::guard('EXT')->user()->home_county == 'Kakamega' ? 'selected' : '' }}>Kakamega</option>
                            <option value="Vihiga" {{ Auth::guard('EXT')->user()->home_county == 'Vihiga' ? 'selected' : '' }}>Vihiga</option>
                            <option value="Bungoma" {{ Auth::guard('EXT')->user()->home_county == 'Bungoma' ? 'selected' : '' }}>Bungoma</option>
                            <option value="Busia" {{ Auth::guard('EXT')->user()->home_county == 'Busia' ? 'selected' : '' }}>Busia</option>
                            <option value="Siaya" {{ Auth::guard('EXT')->user()->home_county == 'Siaya' ? 'selected' : '' }}>Siaya</option>
                            <option value="Kisumu" {{ Auth::guard('EXT')->user()->home_county == 'Kisumu' ? 'selected' : '' }}>Kisumu</option>
                            <option value="Homa Bay" {{ Auth::guard('EXT')->user()->home_county == 'Homa Bay' ? 'selected' : '' }}>Homa Bay</option>
                            <option value="Migori" {{ Auth::guard('EXT')->user()->home_county == 'Migori' ? 'selected' : '' }}>Migori</option>
                            <option value="Kisii" {{ Auth::guard('EXT')->user()->home_county == 'Kisii' ? 'selected' : '' }}>Kisii</option>
                            <option value="Nyamira" {{ Auth::guard('EXT')->user()->home_county == 'Nyamira' ? 'selected' : '' }}>Nyamira</option>
                            <option value="Nairobi" {{ Auth::guard('EXT')->user()->home_county == 'Nairobi' ? 'selected' : '' }}>Nairobi</option>
                            <option value="Others" {{ Auth::guard('EXT')->user()->home_county == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ethnicity" class="form-label">Ethnicity:</label>
                        <select class="form-control" name="ethnicity" id="ethnicity">
                            <option value="">Select Ethnicity</option>
                            <option value="Kikuyu" {{ Auth::guard('EXT')->user()->ethnicity == 'Kikuyu' ? 'selected' : '' }}>Kikuyu</option>
                            <option value="Luhya" {{ Auth::guard('EXT')->user()->ethnicity == 'Luhya' ? 'selected' : '' }}>Luhya</option>
                            <option value="Kalenjin" {{ Auth::guard('EXT')->user()->ethnicity == 'Kalenjin' ? 'selected' : '' }}>Kalenjin</option>
                            <option value="Luo" {{ Auth::guard('EXT')->user()->ethnicity == 'Luo' ? 'selected' : '' }}>Luo</option>
                            <option value="Kamba" {{ Auth::guard('EXT')->user()->ethnicity == 'Kamba' ? 'selected' : '' }}>Kamba</option>
                            <option value="Kisii" {{ Auth::guard('EXT')->user()->ethnicity == 'Kisii' ? 'selected' : '' }}>Kisii</option>
                            <option value="Meru" {{ Auth::guard('EXT')->user()->ethnicity == 'Meru' ? 'selected' : '' }}>Meru</option>
                            <option value="Mijikenda" {{ Auth::guard('EXT')->user()->ethnicity == 'Mijikenda' ? 'selected' : '' }}>Mijikenda</option>
                            <option value="Turkana" {{ Auth::guard('EXT')->user()->ethnicity == 'Turkana' ? 'selected' : '' }}>Turkana</option>
                            <option value="Maasai" {{ Auth::guard('EXT')->user()->ethnicity == 'Maasai' ? 'selected' : '' }}>Maasai</option>
                            <option value="Samburu" {{ Auth::guard('EXT')->user()->ethnicity == 'Samburu' ? 'selected' : '' }}>Samburu</option>
                            <option value="Taita" {{ Auth::guard('EXT')->user()->ethnicity == 'Taita' ? 'selected' : '' }}>Taita</option>
                            <option value="Embu" {{ Auth::guard('EXT')->user()->ethnicity == 'Embu' ? 'selected' : '' }}>Embu</option>
                            <option value="Tharaka" {{ Auth::guard('EXT')->user()->ethnicity == 'Tharaka' ? 'selected' : '' }}>Tharaka</option>
                            <option value="Pokomo" {{ Auth::guard('EXT')->user()->ethnicity == 'Pokomo' ? 'selected' : '' }}>Pokomo</option>
                            <option value="Borana" {{ Auth::guard('EXT')->user()->ethnicity == 'Borana' ? 'selected' : '' }}>Borana</option>
                            <option value="Rendile" {{ Auth::guard('EXT')->user()->ethnicity == 'Rendile' ? 'selected' : '' }}>Rendile</option>
                            <option value="Somali" {{ Auth::guard('EXT')->user()->ethnicity == 'Somali' ? 'selected' : '' }}>Somali</option>
                            <option value="Swahili" {{ Auth::guard('EXT')->user()->ethnicity == 'Swahili' ? 'selected' : '' }}>Swahili</option>
                            <option value="Taveta" {{ Auth::guard('EXT')->user()->ethnicity == 'Taveta' ? 'selected' : '' }}>Taveta</option>
                            <option value="Orma" {{ Auth::guard('EXT')->user()->ethnicity == 'Orma' ? 'selected' : '' }}>Orma</option>
                            <option value="Gabra" {{ Auth::guard('EXT')->user()->ethnicity == 'Gabra' ? 'selected' : '' }}>Gabra</option>
                            <option value="El Molo" {{ Auth::guard('EXT')->user()->ethnicity == 'El Molo' ? 'selected' : '' }}>El Molo</option>
                            <option value="Njemps" {{ Auth::guard('EXT')->user()->ethnicity == 'Njemps' ? 'selected' : '' }}>Njemps</option>
                            <option value="Others" {{ Auth::guard('EXT')->user()->ethnicity == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
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
        const disabilityDocumentDiv = document.getElementById("disabilityDocumentDiv");

        function toggleDisabilityFields() {
            if (disabilitySelect.value === "Yes") {
                disabilityDescriptionDiv.style.display = "block";
                disabilityDocumentDiv.style.display = "block";
            } else {
                disabilityDescriptionDiv.style.display = "none";
                disabilityDocumentDiv.style.display = "none";
            }
        }

        // Initial load state
        toggleDisabilityFields();

        // Trigger when value changes
        disabilitySelect.addEventListener("change", toggleDisabilityFields);
    });
</script>




												
												
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Full Name :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->name}}" readonly />
													</div>
												   
												</div>
                                               
                                                
												
												<div class="row mb-3">
													
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">E-Mail :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->email}}" readonly />
													</div>
												</div>
												
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Phone Number:</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->mobile_no}}" readonly />
													</div>
												</div>
												
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Date  of  Birth :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->dob}}" readonly />
													</div>
													
												</div>
												
												
												
												
												<div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Natinality :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->nationality}}" readonly />
													</div>
												</div>
                                                <div class="row mb-3">
													<div class="col-sm-3">
														<h6 class="mb-0">Postal  Address :</h6>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->postal_address}}" readonly />
													</div>
												</div>
                                                <div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Home County :</h6>
    </div>
    <div class="col-sm-9">
        <input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->home_county }}" readonly />
    </div>
</div>
<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Disability :</h6>
    </div>
    <div class="col-sm-9">
        <input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->disability }}" readonly />
    </div>
</div>
<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">NCPWD Card :</h6>
    </div>
    <div class="col-sm-9">
        @if(Auth::guard('EXT')->user()->documentName)
            <a href="{{ asset('uploads/PWD/' . Auth::guard('EXT')->user()->documentName) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                View Uploaded Document
            </a>
        @else
            <span class="text-muted">Not uploaded</span>
        @endif
    </div>
</div>
<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Gender :</h6>
    </div>
    <div class="col-sm-9">
        <input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->gender }}" readonly />
    </div>
</div>

{{-- Ethnicity --}}
<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Ethnicity :</h6>
    </div>
    <div class="col-sm-9">
        <input type="text" class="form-control" value="{{ Auth::guard('EXT')->user()->ethnicity }}" readonly />
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
            This is the official external job advertisement (Declaration of Vacant Positions).
        </h5>
    </div>
</div>

<!-- Download Word Document (Moved to Top) -->
<div class="row mb-3">
    <div class="col-12">
        
    </div>
</div>

<!-- PDF Viewer -->
<div class="row mb-4">
    <div class="col-12">
        <iframe src="{{ asset('assets/ext.pdf') }}" width="100%" height="600px" style="border: 1px solid #ccc;"></iframe>
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