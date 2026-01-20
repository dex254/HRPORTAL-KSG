@include('EXT.Dashboard.header')
@include('EXT.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Professional Experience</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                       
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    State Professional Experience .
                   
                </div>
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('EXT.Experince.New') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>

                    <button onclick="location.href='{{ route('Experience.Teaching.Ext') }}'" class="btn next-button px-4 py-2">
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
                               
                                <button class="btn custom-license-btn" data-bs-toggle="modal" data-bs-target="#licensesModal">
                                    Add a License
                                </button>
                                
                                <style>
                                    .custom-license-btn {
                                        background-color: rgb(203, 211, 0);
                                        color: black;
                                        border: none;
                                        padding: 10px 15px;
                                        border-radius: 5px;
                                        transition: background-color 0.3s, color 0.3s;
                                    }
                                
                                    .custom-license-btn:hover {
                                        background-color: rgb(242, 236, 236);
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
                        <h5>Professional Experience</h5>
                        <p class="text-muted">My  license.</p>
                      
                       
                    
                        <!-- Table (hidden by default) -->
                        <div class="table-responsive">
                            <table id="example" class="table mb-0 mt-3" >
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        
                                        <th>I  have  a  license</th>
                                        <th>Issuing Body</th>
                                        <th>License Date</th>
                                        <th>Document</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($licence as $licence)
                                        <tr>
                                            <td>{{ $licence->id }}</td>
                                           
                                            <td>{{ $licence->has_license ?? 'N/A' }}</td>
                                            <td>{{ $licence->license_name ?? 'N/A' }}</td>
                                            <td>{{ $licence->license_date ?? 'N/A' }}</td>
                                            <td>
                                                @if($licence->document_name)
                                                <a href="{{ asset('uploads/Licence/' . $licence->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                                                    View Document
                                                </a>
                                            @else
                                                No Document
                                            @endif
                                        
                                            </td>
                                            <td>
                                            <form action="{{ route('EXT.licence.destroy', $licence->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
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
<div class="modal fade" id="licensesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title">Practising License (Professional Experience)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="licenseForm" action="{{ route('EXT.Licence.licencepost') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- CSRF token for security -->
                    <input type="hidden" name="upn_no" value="{{ Auth::guard('EXT')->user()->upn_no }}">
                    <input type="hidden" name="email" value="{{ Auth::guard('EXT')->user()->email }}">
                    <input type="hidden" name="phone" value="{{ Auth::guard('EXT')->user()->upn_no }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('EXT')->user()->name }}">
                    <input type="hidden" name="job_group" value="NONE">
                    <!-- Do you have a professional license? -->
                    <div class="mb-3">
                        <label class="form-label">Do you have any practising license or relevant professional experience?
(If yes, please provide details related to your license or professional background where applicable.)</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input custom-radio" type="radio" name="has_license" id="hasLicenseYes" value="yes">
                                <label class="form-check-label custom-radio-label" for="hasLicenseYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input custom-radio" type="radio" name="has_license" id="hasLicenseNo" value="no" checked>
                                <label class="form-check-label custom-radio-label" for="hasLicenseNo">No</label>
                            </div>
                        </div>
                    </div>
                    <style>/* Custom CSS for rectangular radio buttons */
                        .custom-radio {
                            display: none; /* Hide the default radio button */
                        }
                        
                        .custom-radio-label {
                            display: inline-block;
                            padding: 10px 20px;
                            margin: 5px;
                            border: 2px solid #ccc;
                            border-radius: 5px;
                            cursor: pointer;
                            background-color: #f8f9fa;
                            transition: background-color 0.3s, border-color 0.3s;
                        }
                        
                        .custom-radio:checked + .custom-radio-label {
                            background-color: yellow; /* Change to yellow when selected */
                            border-color: #ffcc00;
                            color: #000; /* Optional: Change text color for better visibility */
                        }
                        
                        .custom-radio-label:hover {
                            background-color: #e9ecef; /* Optional: Add hover effect */
                        }</style>
        
                    <!-- License Details (hidden by default) -->
                    <div id="licenseDetails" style="display: none;">
                        <div class="mb-3">
                            <label for="licenseName" class="form-label">Issuing Body</label>
                            <input type="text" class="form-control" id="licenseName" name="license_name">
                        </div>
                        <div class="mb-3">
                            <label for="licenseDate" class="form-label">License Date</label>
                            <input type="date" class="form-control" id="licenseDate" name="license_date">
                        </div>
                        <div class="mb-3">
                            <label for="licenseDocument" class="form-label">Upload License Document</label>
                            <input type="file" class="form-control" id="licenseDocument" name="document">
                        </div>
                    </div>
                        
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const licenseYes = document.getElementById('hasLicenseYes');
                        const licenseNo = document.getElementById('hasLicenseNo');
                        const licenseDetails = document.getElementById('licenseDetails');
            
                        // Toggle license details based on radio button selection
                        licenseYes.addEventListener('change', function () {
                            if (this.checked) {
                                licenseDetails.style.display = 'block';
                            }
                        });
            
                        licenseNo.addEventListener('change', function () {
                            if (this.checked) {
                                licenseDetails.style.display = 'none';
                            }
                        });
                    });
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

@include('EXT.Dashboard.footer')

