@include('HRPU.Dashboard.header')
@include('HRPU.Dashboard.Status')
<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Member  to a  Professional Body</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                       
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    Indicate  if you are a member to a  relevant professional body.
                   
                </div>
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Academic.Ext') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>

<button onclick="location.href='{{ route('Experience.Ext') }}'" class="btn next-button px-4 py-2">
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
                               
                                <button class="btn custom-btn" data-bs-toggle="modal" data-bs-target="#professionalBodyModal">
                                    Add a Professional Body
                                </button>
                                
                                <!-- Custom CSS -->
                                <style>
                                    .custom-btn {
                                        background-color: rgb(203, 211, 0);
                                        color: black;
                                        border: none;
                                    }
                                
                                    .custom-btn:hover {
                                        background-color: white;
                                        color: black;
                                        border: 1px solid black;
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

                    <div class="mb-4">
                        <h5>Member  to  a  Professional Body</h5>
                        
                      
                        <div id="message" class="alert alert-info" style="display: none;">
                            This is my  memeberships.
                        </div>
                    
                        <!-- Table (hidden by default) -->
                        <div class="table-responsive">
                            <table id="example" class="table mb-0 mt-3" >
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>I  am a member</th>
                                        <th>Professional body Name</th>
                                        <th>Regulating Law/Statute  </th>
                                        <th>Status</th>
                                        <th>Membership  Date</th>
                                        <th>Certificate</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($profecionalbodies as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->is_member }}</td>
                                        <td>{{ $data->professional_body}}</td>
                                        <td>{{ $data->law }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>
                                            @if($data->document_name)
                                            <a href="{{ asset('uploads/Profecionalbody/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                View Document
                                            </a>
                                        @else
                                            No Document
                                        @endif
                                    
                                        </td>
                                        <td>
                                        <form action="{{ route('Profecionalbody.destroyext', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                </div>
                   
                                <div class="modal fade" id="professionalBodyModal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content bg-white text-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Professional Body</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('Profecionalbody.saveext') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf <!-- CSRF token for security -->
                                                    <input type="hidden" name="upn_no" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
                                                    <input type="hidden" name="email" value="{{ Auth::guard('HRPU')->user()->email }}">
                                                    <input type="hidden" name="phone" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
                                                    <input type="hidden" name="name" value="{{ Auth::guard('HRPU')->user()->name }}">
                                                    <input type="hidden" name="job_group" value="Ext">
                                
                                                    <div class="form-group">
                                                        <label>Are you a member of any professional body?</label>
                                                        <div>
                                                            <input type="radio" name="is_member" id="is_member_yes" value="yes"> Yes
                                                            <input type="radio" name="is_member" id="is_member_no" value="no"> No
                                                        </div>
                                                    </div>
                                
                                                    <!-- Fields to display if the user selects "Yes" -->
                                                    <div id="member_fields" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="professional_body">Select Professional Body:</label>
                                                            <select class="form-control" id="professional_body" name="professional_body">
                                                                <option value="">-- Select Professional Body --</option>
                                                                @foreach($proffecional as $body)
                                                                    <option value="{{ $body->name }}" data-law="{{ $body->law }}">{{ $body->name }}</option>
                                                                    
                                                                @endforeach
                                                                <option value="Other">Other</option>
                                                                
                                                            </select>
                                                        </div>
                                
                                                        <!-- Fields to add a new professional body -->
                                                        <div id="other_body_fields" style="display: none;">
                                                            <div class="form-group">
                                                                <label for="new_professional_body">Enter Professional Body Name:</label>
                                                                <input type="text" class="form-control" id="new_professional_body" name="new_professional_body">
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label for="new_law">Regulating authority:</label>
                                                                <input type="text" class="form-control" id="new_law" name="new_law">
                                                            </div>
                                                        </div>
                                
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" id="law" name="law" readonly>
                                                        </div>
                                
                                                        <div class="form-group">
                                                            <label for="status">Status:</label>
                                                            <select class="form-control" id="status" name="status">
                                                                <option value="">-- Select Status --</option> <!-- Default empty option -->
                                                                <option value="Active">Active</option>
                                                                <option value="Inactive">Inactive</option>
                                                            </select>
                                                            
                                                        </div>
                                
                                                        <!-- Date Field (Initially Hidden) -->
                                                        <div class="form-group" id="activeDateField" style="display: none;">
                                                            <label for="active_date">Membership  Date:</label>
                                                            <input type="date" class="form-control" id="active_date" name="date">
                                                        </div>
                                
                                                        <div class="form-group">
                                                            <label for="document">Upload Membership Document:</label>
                                                            <input type="file" class="form-control" id="document" name="document">
                                                        </div>
                                                    </div>
                                
                                                    <!-- Submit and Cancel Buttons -->
                                                    <div class="mt-3 d-flex justify-content-between">
                                                        <button type="submit" class="btn btn-warning">Save</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                
                                                <!-- JavaScript to handle dynamic fields -->
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function () {
                                                        const isMemberYes = document.getElementById('is_member_yes');
                                                        const isMemberNo = document.getElementById('is_member_no');
                                                        const memberFields = document.getElementById('member_fields');
                                                        const professionalBodySelect = document.getElementById('professional_body');
                                                        const lawInput = document.getElementById('law');
                                                        const statusSelect = document.getElementById('status');
                                                        const activeDateField = document.getElementById('activeDateField');
                                                        const otherBodyFields = document.getElementById('other_body_fields');
                                                        const newProfessionalBody = document.getElementById('new_professional_body');
                                                        const newLaw = document.getElementById('new_law');
                                
                                                        // Show/hide fields based on radio button selection
                                                        isMemberYes.addEventListener('change', function () {
                                                            if (this.checked) {
                                                                memberFields.style.display = 'block';
                                                                statusSelect.value = ""; // Default status to Active
                                                            }
                                                        });
                                
                                                        isMemberNo.addEventListener('change', function () {
                                                            if (this.checked) {
                                                                memberFields.style.display = 'none';
                                                                statusSelect.value = "Inactive"; // Set status to Inactive when "No" is selected
                                                                activeDateField.style.display = 'none'; // Hide date field
                                                            }
                                                        });
                                
                                                        // Show/hide date input based on "Active" status selection
                                                        statusSelect.addEventListener('change', function () {
                                                            if (this.value === 'Active') {
                                                                activeDateField.style.display = 'block'; // Show date input
                                                            } else {
                                                                activeDateField.style.display = 'none'; // Hide date input
                                                            }
                                                        });
                                
                                                        // Autofill the law field when a professional body is selected
                                                        professionalBodySelect.addEventListener('change', function () {
                                                            const selectedOption = this.options[this.selectedIndex];
                                
                                                            if (selectedOption.value === "Other") {
                                                                otherBodyFields.style.display = "block";
                                                                newProfessionalBody.required = true;
                                                                newLaw.required = true;
                                                                lawInput.value = ""; // Reset law field
                                                            } else {
                                                                otherBodyFields.style.display = "none";
                                                                newProfessionalBody.required = false;
                                                                newLaw.required = false;
                                                                lawInput.value = selectedOption.getAttribute('data-law');
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                <!-- Popup Modal -->
               

                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HRPU.Dashboard.footer')

