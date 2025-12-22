@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Work   Experience</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                       
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    Please provide your work experience starting with the most recent.
                </div>
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Academic.data') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>

                    <button onclick="location.href='{{ route('Research.Home') }}'" class="btn next-button px-4 py-2">
                        Next
                    </button>
                    
                    <style>
                        /* Previous Button */
                        .previous-button {
                            background-color: rgb(127, 98, 44); /* Brown color */
                            color: white; /* White text */
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                            transition: background-color 0.3s ease, color 0.3s ease;
                        }
                    
                        /* Hover effect for Previous Button */
                        .previous-button:hover {
                            background-color: white; /* Turns white on hover */
                            color: rgb(127, 98, 44); /* Text turns to brown */
                            border: 1px solid rgb(127, 98, 44);
                        }
                    
                        /* Next Button */
                        .next-button {
                            background-color: rgb(203, 211, 0); /* Yellowish-green color */
                            color: black; /* Default text color */
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                            transition: background-color 0.3s ease, color 0.3s ease;
                        }
                    
                        /* Hover effect for Next Button */
                        .next-button:hover {
                            background-color: white; /* Turns white on hover */
                            color: black; /* Black text on hover */
                            border: 1px solid black;
                        }
                    </style>
                    
                </div>
            </div>
            <br>
            <br>
            
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="ms-auto">
                            <div class="d-flex justify-content-start mt-4">
                               
                                <button class="custom-btn" onclick="openModal()">
                                    Add an Experience
                                </button>
                                
                                <style>
                                    .custom-btn {
                                        background-color: rgb(203, 211, 0); /* Default background */
                                        color: black; /* Default text color */
                                        padding: 10px 20px;
                                        font-size: 16px;
                                        border: none;
                                        border-radius: 5px;
                                        cursor: pointer;
                                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                                        transition: background-color 0.3s, color 0.3s;
                                    }
                                
                                    .custom-btn:hover {
                                        background-color: white; /* Turns white on hover */
                                        color: black; /* Keeps text black */
                                        border: 2px solid rgb(203, 211, 0); /* Optional: border for visibility */
                                    }
                                </style>
                                
                                
                               
                        </div>
                        </div>
                            
                    </div>
                    @if ($errors->any() || session('success') || session('error'))
    <div class="alert alert-{{ $errors->any() ? 'danger' : (session('error') ? 'danger' : 'success') }}" role="alert">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @elseif (session('error'))
            {{ session('error') }} <!-- Display custom error message -->
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
@if ($errors->any() || session('error'))
    <div class="alert alert-danger" id="error-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @if (session('error'))
                <li>{{ session('error') }}</li> <!-- Display "already applied" error -->
            @endif
        </ul>
    </div>
@endif

<!-- Style for alert boxes -->
<style>
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: block;
    }

    .alert-success {
        background-color: yellow;
        color: #333;
        border: 1px solid #ccc;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<!-- Flickering effect using JavaScript -->
<script>
    function flickerEffect(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            let visible = true;
            setInterval(() => {
                element.style.visibility = visible ? 'hidden' : 'visible';
                visible = !visible;
            }, 470);
        }
    }

    if (document.getElementById('success-message')) {
        flickerEffect('success-message');
    }

    if (document.getElementById('error-message')) {
        flickerEffect('error-message');
    }
</script>

                    <div class="table-responsive">
                        <table id="example" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Employer</th>
                                    <th>Designation</th>
                                    <th>Country</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Location</th>
                                    <th>Job Description</th>
                                    <th>Duties  and  Responsibilities</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($experiences as $experience)
                    <tr>
                        <td>{{ $experience->employer }}</td>
                        <td>{{ $experience->job_title }}</td>
                        <td>{{ $experience->country }}</td>
                        <td>{{ $experience->stdate }}</td>
                        <td>{{ $experience->enddate }}</td>
                        <td>{{ $experience->location }}</td>
                        <td>{{ $experience->expartise }}</td>
                        <td>{{ $experience->duties }}</td>
                        
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('Experince.destroy', $experience->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Employer</th>
                                    <th>Designation</th>
                                    <th>Country</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Location</th>
                                    <th>Job Description</th>
                                    <th>Duties  and  Responsibilities</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                   

                <!-- Popup Modal -->
                <div id="academicModal" class="modal">
                    <div class="modal-content">
                        <h3 class="modal-title">Add Experience</h3>
                       
                
                        <form action="{{ route('Experience.data') }}"   method="POST"  >
                            @csrf
                            
                            
                
                            <!-- Hidden Fields -->
                            <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                            <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                            <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                            <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                            <!-- Input Fields -->
                            <div class="form-group">
                                <label>Employer</label>
                                <input type="text" name="employer" class="form-control" required>
                            </div>
                
                            <div class="form-group">
                                <label>Designations</label>
                                <input type="text" name="job_title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                
                                <label>Select Country</label>
    <select class="form-select" name="country" required style="background-color: white; color: black;">
        <option value="">Select Country</option>
        <option value="Afghanistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Brazil">Brazil</option>
        <option value="Brunei">Brunei</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>
        <option value="Cabo Verde">Cabo Verde</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
        <option value="Congo (Congo-Brazzaville)">Congo</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
        <option value="Estonia">Estonia</option>
        <option value="Eswatini">Eswatini</option>
        <option value="Ethiopia">Ethiopia</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>
        <option value="Gabon">Gabon</option>
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Greece">Greece</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Honduras">Honduras</option>
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="India">India</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Iran">Iran</option>
        <option value="Iraq">Iraq</option>
        <option value="Ireland">Ireland</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kuwait">Kuwait</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Libya">Libya</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Malta">Malta</option>
        <option value="Mexico">Mexico</option>
        <option value="Moldova">Moldova</option>
        <option value="Monaco">Monaco</option>
        <option value="Morocco">Morocco</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Namibia">Namibia</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherlands">Netherlands</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nigeria">Nigeria</option>
        <option value="North Korea">North Korea</option>
        <option value="Norway">Norway</option>
        <option value="Pakistan">Pakistan</option>
        <option value="Panama">Panama</option>
        <option value="Peru">Peru</option>
        <option value="Philippines">Philippines</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>
        <option value="Qatar">Qatar</option>
        <option value="Romania">Romania</option>
        <option value="Russia">Russia</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Serbia">Serbia</option>
        <option value="Singapore">Singapore</option>
        <option value="South Africa">South Africa</option>
        <option value="Spain">Spain</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Thailand">Thailand</option>
        <option value="Turkey">Turkey</option>
        <option value="Ukraine">Ukraine</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="United States">United States</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Zimbabwe">Zimbabwe</option>
    </select>
</div>
                
                            <div class="form-group">
                                <label>Start  Date</label>
                                <input type="date" name="stdate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>End  Date</label>
                                <input type="date" name="enddate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Location  or Campus</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2" class="form-label">Duties  and Responsibilities</label>
                                <textarea class="form-control" id="inputAddress2" name="duties" placeholder="1................" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="achievements" class="form-label">Achievements in the Organization</label>
                                <textarea class="form-control" id="inputAddress2" name="expartise" placeholder="Describe your key achievements in the organization, starting with the most recent. For example: 
                                - Successfully led a team of 10 to complete a project 2 weeks ahead of schedule.
                                - Increased sales by 20% through the implementation of a new marketing strategy.
                                - Streamlined internal processes, reducing operational costs by 15%." rows="5"></textarea>
                                    
                            </div>
                            
                            
                            
                            <!-- Buttons -->
                            <div class="button-group">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-danger" onclick="closeModal()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Modal Script -->
                <script>
                    function openModal() {
                        document.getElementById('academicModal').style.display = 'flex';
                    }
                    
                    function closeModal() {
                        document.getElementById('academicModal').style.display = 'none';
                    }
                    </script>
                    
                    <!-- Modal Styling -->
                    <style>
                    /* Modal Background */
                    .modal {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.6); /* Dimmed background */
                        display: none;
                        justify-content: center;
                        align-items: center;
                        z-index: 1050;
                        padding: 20px; /* Allows content to be centered better */
                        overflow-y: auto; /* Enables scrolling if modal is too large */
                    }
                    select.form-select {
        color: black !important;  /* Ensures text inside dropdown is black */
        background-color: white !important;  /* Keeps background white */
        border: 1px solid #ccc; /* Subtle border */
        padding: 8px;
        width: 100%;
        appearance: none; /* Removes default OS styles */
        font-size: 16px;
    }
    
    /* Ensure dropdown options have the correct styling */
    select.form-select option {
        background: white !important;  /* Keep dropdown options white */
        color: black !important;  /* Text remains black */
    }
                    
                    /* Modal Content */
                    .modal-content {
                        width: 80%; /* More adjustable width */
                        max-width: 900px; /* Ensures it does not get too wide */
                        min-width: 300px; /* Prevents it from being too small */
                        background: white;
                        padding: 30px;
                        border-radius: 10px;
                        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
                        text-align: center;
                        max-height: 90vh; /* Prevents modal from exceeding screen height */
                        overflow-y: auto; /* Enables internal scrolling if content is long */
                    }
                    
                    /* Title Styling */
                    .modal-title {
                        color: black;
                        font-size: 22px;
                        font-weight: bold;
                        margin-bottom: 20px;
                    }
                    
                    /* Label Styling */
                    label {
                        color: black;
                        display: block;
                        text-align: left;
                        font-weight: bold;
                        margin-top: 10px;
                    }
                    
                    /* Form Inputs */
                    input[type="text"], 
                    input[type="number"], 
                    input[type="date"], 
                    input[type="file"], 
                    select.form-select {
                        color: black !important;
                        background-color: white;
                        border: 1px solid #ccc;
                        padding: 8px;
                        width: 100%;
                    }
                    
                    /* Button Group */
                    .button-group {
                        margin-top: 20px;
                        display: flex;
                        justify-content: space-between;
                    }
                    
                    /* Responsive Design */
                    @media (max-width: 768px) {
                        .modal-content {
                            width: 95%; /* Makes modal almost full width on small screens */
                        }
                    }
                    </style>

                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HR.Dashboard.footer')

