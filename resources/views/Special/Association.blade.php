@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Member  to an Association</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                       
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    State  membership   to an Association.
                   
                </div>
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Special.ProfessionalBody') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>

<button onclick="location.href='{{ route('Special.Licence') }}'" class="btn next-button px-4 py-2">
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
                               
                                <button class="btn custom-btn" data-bs-toggle="modal" data-bs-target="#associationModal">
                                    Add an Association
                                </button>
                                
                                <style>
                                    .custom-btn {
                                        background-color: rgb(203, 211, 0);
                                        color: black;
                                        border: none;
                                        padding: 10px 20px;
                                        border-radius: 5px;
                                        transition: background-color 0.3s, color 0.3s;
                                    }
                                
                                    .custom-btn:hover {
                                        background-color: rgb(240, 249, 248);
                                        color: white;
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
                        <h5>Membership  to an Association</h5>
                        <p class="text-muted">My  memberships.</p>
                      
                       
                    
                        <!-- Table (hidden by default) -->
                        <div class="table-responsive">
                            <table id="example" class="table mb-0 mt-3" >
                               
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            
                                            <th>I am a member</th>
                                            <th>Association Name</th>
                                            <th>Membership  Status</th>
                                            <th>Document</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($associations as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                           
                                            <td>{{ $data->condition}}</td>
                                            <td>{{ $data->association_name}}</td>
                                            <td>{{ $data->status }}</td>
                                            
                                            <td>
                                                @if($data->document_name)
                                                <a href="{{ asset('uploads/Association/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    View Document
                                                </a>
                                            @else
                                                No Document
                                            @endif
                                        
                                            </td>
                                            <td>
                                            <form action="{{ route('Association.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
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
                   
                                    <div class="modal fade" id="associationModal" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content bg-white text-dark">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Association</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('Association.Create') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf <!-- CSRF token for security -->
                                                        <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                                                        <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                                                        <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                                                        <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                                                        <input type="hidden" name="job_group" value="{{ Auth::guard('HR')->user()->job_group }}">
                                    
                                                        <label>Are you a member of any association?</label>
                                                        <br>
                                                        <div class="radio-container">
                                                            <label class="radio-label">
                                                                <input type="radio" name="condition" id="association_yes" value="yes" onchange="toggleAssociationFields()">
                                                                <span class="radio-custom"></span>
                                                                Yes
                                                            </label>
                                                            <label class="radio-label">
                                                                <input type="radio" name="condition" id="association_no" value="no" onchange="toggleAssociationFields()" checked>
                                                                <span class="radio-custom"></span>
                                                                No
                                                            </label>
                                                        </div>
                                    
                                                        <br>
                                    
                                                        <!-- Hidden Fields -->
                                                        <div id="associationFields" style="display: none;">
                                                            <div class="form-group">
                                                                <label for="association_name">Name of the Association:</label>
                                                                <input type="text" class="form-control" name="association_name" id="association_name">
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                                <label for="status">State your membership status:</label>
                                                                <select class="form-control" name="status" id="membershipStatus" onchange="toggleDateField()">
                                                                    <option value="">-- Select Status --</option> <!-- Prevent auto-selection -->
                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                            <br>
                                    
                                                            <!-- Date Field (Hidden Initially) -->
                                                            <div class="form-group" id="activeDateField" style="display: none;">
                                                                <label for="membership_date">Membership Start Date:</label>
                                                                <input type="date" class="form-control" id="date" name="membership_date">
                                                            </div>
                                                            <br>
                                    
                                                            <div class="form-group">
                                                                <label for="document">Upload Evidence:</label>
                                                                <input type="file" class="form-control" id="document_name" name="document">
                                                            </div>
                                                        </div>
                                    
                                                        <!-- Hidden Status Input for "No" selection -->
                                                        <input type="hidden" name="status" value="Inactive" id="hiddenStatus">
                                    
                                                        <div class="mt-3 d-flex justify-content-between">
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </form>
                                    
                                                    <script>
                                                        function toggleAssociationFields() {
                                                            const associationFields = document.getElementById('associationFields');
                                                            const membershipStatus = document.getElementById('membershipStatus');
                                                            const hiddenStatus = document.getElementById('hiddenStatus');
                                    
                                                            if (document.getElementById('association_yes').checked) {
                                                                associationFields.style.display = 'block'; // Show fields
                                                                membershipStatus.removeAttribute("disabled"); // Enable status dropdown
                                                                hiddenStatus.disabled = true; // Disable hidden input
                                                            } else {
                                                                associationFields.style.display = 'none'; // Hide fields
                                                                membershipStatus.setAttribute("disabled", "true"); // Disable status dropdown
                                                                hiddenStatus.disabled = false; // Enable hidden input
                                                                document.getElementById('activeDateField').style.display = 'none'; // Hide date field
                                                            }
                                                        }
                                    
                                                        function toggleDateField() {
                                                            const membershipStatus = document.getElementById('membershipStatus').value;
                                                            const activeDateField = document.getElementById('activeDateField');
                                    
                                                            if (membershipStatus === 'Active') {
                                                                activeDateField.style.display = 'block'; // Show date input
                                                            } else {
                                                                activeDateField.style.display = 'none'; // Hide date input
                                                            }
                                                        }
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

@include('HR.Dashboard.footer')

