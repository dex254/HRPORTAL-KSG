@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')
<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Food handlers Certificate</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                       
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    The <strong>Food handlers Certificate</strong> is  issued  by  the public health as  requred in the career guideline.
                </div>
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Special.Licence') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>

                    <button onclick="location.href='{{ route('Experince.data') }}'" class="btn next-button px-4 py-2">
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
                               
                                <button class="custom-btn" data-bs-toggle="modal" data-bs-target="#medicalModal">
                                    Add   here....
                                </button>
                                
                                <style>
                                    .custom-btn {
                                        background-color: rgb(203, 211, 0); /* Initial background color */
                                        color: black; /* Text color */
                                        border: none;
                                        padding: 10px 20px;
                                        font-size: 16px;
                                        border-radius: 5px;
                                        cursor: pointer;
                                        transition: background-color 0.3s, color 0.3s;
                                    }
                                
                                    .custom-btn:hover {
                                        background-color: white; /* Change to white on hover */
                                        color: black; /* Black text */
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

                    <div class="mb-4">
                        <h5>Food handlers Certificate</h5>
                        <p class="text-muted">My Food handlers Certificate.</p>
                      
                       
                    
                        <!-- Table (hidden by default) -->
                        <div class="table-responsive">
                            <table id="example" class="table mb-0 mt-3" >
                               
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                           
                                            
                                            <th>I have</th>
                                            <th>Certificate</th>
                                            <th>Date</th>
                                            <th>Document</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($medical as $data)
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                
                                               
                                                
                                                <td>{{ $data->condition ?? 'N/A' }}</td>
                                                <td>{{ $data->name_exam }}</td>
                                                <td>{{ $data->date ?? 'N/A' }}</td>
                                                <td>
                                                    @if($data->document_name)
                                                    <a href="{{ asset('uploads/Medical/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                        View Document
                                                    </a>
                                                @else
                                                    No Document
                                                @endif
                                            
                                                </td>
                                                <td>
                                                <form action="{{ route('Medical.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
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
                   
                                <!-- Licenses Modal -->
                                <div class="modal fade" id="medicalModal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content bg-white text-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Food handlers Certificate</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="medicalCondition">Food handlers Certificate:</label>
                                                <form  action="{{ route('Medical.Create') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf <!-- CSRF token for security -->
                                                    <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                                                    <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                                                    <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                                                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                                                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->job_group }}">
                                                    <label>Do  you  have any medical  examination certificate?</label>
                                                    <br>
                                                    <div class="radio-container">
                                                        <label class="radio-label">
                                                            <input type="radio" name="condition" id="medical_yes" value="yes" onchange="toggleMedicalFields()">
                                                            <span class="radio-custom"></span>
                                                            Yes
                                                        </label>
                                                        <label class="radio-label">
                                                            <input type="radio" name="condition" id="medical_no" value="no" onchange="toggleMedicalFields()">
                                                            <span class="radio-custom"></span>
                                                            No
                                                        </label>
                                                    </div>
                                                    
                                                    <style>
                                                        /* Hide the default radio button */
                                                        .radio-label input[type="radio"] {
                                                            display: none;
                                                        }
                                                    
                                                        /* Custom radio button */
                                                        .radio-custom {
                                                            display: inline-block;
                                                            width: 20px;
                                                            height: 20px;
                                                            background-color: #fff;
                                                            border: 2px solid #ccc;
                                                            border-radius: 4px; /* Smooth edges */
                                                            margin-right: 8px;
                                                            position: relative;
                                                            vertical-align: middle;
                                                            cursor: pointer;
                                                            transition: background-color 0.3s, border-color 0.3s;
                                                        }
                                                    
                                                        /* Hover effect */
                                                        .radio-label:hover .radio-custom {
                                                            border-color: #007bff;
                                                        }
                                                    
                                                        /* Checked state */
                                                        .radio-label input[type="radio"]:checked + .radio-custom {
                                                            background-color: #007bff;
                                                            border-color: #007bff;
                                                        }
                                                    
                                                        /* Inner dot for checked state */
                                                        .radio-label input[type="radio"]:checked + .radio-custom::after {
                                                            content: '';
                                                            display: block;
                                                            width: 12px;
                                                            height: 12px;
                                                            background-color: white;
                                                            border-radius: 2px; /* Smooth edges for inner dot */
                                                            position: absolute;
                                                            top: 50%;
                                                            left: 50%;
                                                            transform: translate(-50%, -50%);
                                                        }
                                                    
                                                        /* Container for alignment */
                                                        .radio-container {
                                                            display: flex;
                                                            gap: 16px; /* Space between radio buttons */
                                                        }
                                                    
                                                        /* Label styling */
                                                        .radio-label {
                                                            display: flex;
                                                            align-items: center;
                                                            font-size: 16px;
                                                            color: #333;
                                                            cursor: pointer;
                                                        }
                                                    </style>
                                                    <br>
                                                
                                                        <!-- Fields to be shown only if "Yes" is selected -->
                                                        <div id="medicalFields" style="display: none;">
                                                            <div  class="form-group">
                                                                <label for="date">Name  of Medical Examination:</label>
                                                                <input type="text"  class="form-control" name="name_exam" id="name_exam">
                                                            </div>
                                                            <br>
                                                            <div  class="form-group">
                                                                <label for="date">Pick a  Date  Certified:</label>
                                                                <input type="date"  class="form-control" name="date" id="date">
                                                            </div>
                                                            <br>
                                                            <div class="form-group">
                                                                <label for="document">Upload Medical Examination Document:</label>
                                                                <input type="file" class="form-control" id="document_name" name="document">
                                                            </div>
                                                           
                                                        </div>
                                                    <div class="mt-3 d-flex justify-content-between">
                                                        
                                                        <button type="submit" class="btn btn-success">Save</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                                <script>
                                                    function toggleMedicalFields() {
                                                        const medicalFields = document.getElementById('medicalFields');
                                                        const medicalYes = document.getElementById('medical_yes');
                                                        const medicalNo = document.getElementById('medical_no');
                                                
                                                        if (medicalYes.checked) {
                                                            medicalFields.style.display = 'block'; // Show fields
                                                        } else if (medicalNo.checked) {
                                                            medicalFields.style.display = 'none'; // Hide fields
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HR.Dashboard.footer')

