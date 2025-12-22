@include('HRPU.Dashboard.header')
@include('HRPU.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Consultancy  assignments and Research assignments</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    Please provide your Consultancy  assignments and Research assignments starting with the most recent .
                </div>
                
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Experience.Ext') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>
                
                    <button onclick="location.href='{{ route('Report.Ext') }}'" class="btn next-button px-4 py-2">
                        Next
                    </button>
                </div>
                
                <style>
                    /* Previous Button */
                    .previous-button {
                        background-color: rgb(127, 98, 44); /* Requested color */
                        color: white; /* Text color */
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
                        background-color: rgb(203, 211, 0); /* Requested color */
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
            <br>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            <div class="d-flex justify-content-start gap-3 mt-4">
                                <button class="btn add-qualification-button text-white px-4 py-2 shadow" onclick="openModal('academicModal')">
                                    Add Consultancy  assignments
                                </button>
                                
                                <button type="button" class="btn short-course-button px-4 py-2 shadow" onclick="openModal('trainingModal')">
                                    Add Research assignments
                                </button>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <h2 class="fw-bold">Consultancy assignments</h2>
                            </div>
                            <style>
                                /* Add Academic Qualification Button */
                                .add-qualification-button {
                                    background-color: rgb(127, 98, 44); /* Brown color */
                                    color: white; /* White text */
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: background-color 0.3s ease, color 0.3s ease;
                                }
                            
                                /* Hover effect */
                                .add-qualification-button:hover {
                                    background-color: white; /* Turns white on hover */
                                    color: rgb(127, 98, 44); /* Brown text on hover */
                                    border: 1px solid rgb(127, 98, 44);
                                }
                            
                                /* Add Short Course Button */
                                .short-course-button {
                                    background-color: rgb(203, 211, 0); /* Yellow-green color */
                                    color: black;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: background-color 0.3s ease, color 0.3s ease;
                                }
                            
                                /* Hover effect */
                                .short-course-button:hover {
                                    background-color: white;
                                    color: black;
                                    border: 1px solid rgb(203, 211, 0);
                                }
                            </style>
                            
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
        <th>#</th>
       
        <th>Client</th>
        <th>Sector</th>
        <th>Completed</th>
        <th>Completion Date</th>
        <th>Amount</th>
        <th>File</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @forelse($other as $index => $other)
        <tr>
            <td>{{ $index + 1 }}</td>
           
            <td>{{ $other->Client }}</td>
            <td>{{ $other->Sector }}</td>
            <td>{{ $other->completed }}</td>
            <td>{{ \Carbon\Carbon::parse($other->compedate)->format('d M Y') }}</td>
            <td>{{ $other->Amount ?? 'N/A' }}</td>
            <td>
                                        @if($other->document_name)
                                        <a href="{{ asset('uploads/Other/' . $other->document_name) }}" 
                                            target="_blank" 
                                            class="btn btn-sm view-button">
                                            <i class="bi bi-book"></i> View
                                         </a>
                                         
                                         <style>
                                             /* View Button */
                                             .view-button {
                                                 background-color: rgb(203, 211, 0); /* Yellowish-green color */
                                                 color: black; /* Default text color */
                                                 border: none;
                                                 border-radius: 5px;
                                                 cursor: pointer;
                                                 transition: background-color 0.3s ease, color 0.3s ease;
                                             }
                                         
                                             /* Hover effect */
                                             .view-button:hover {
                                                 background-color: white; /* Turns white on hover */
                                                 color: black; /* Black text on hover */
                                                 border: 1px solid black;
                                             }
                                         </style>
                                         
                                        @else
                                            <span class="text-danger">No Document</span>
                                        @endif
                                    </td>
            
            <td>
                <form action="{{ route('Experience.destroyother', $other->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center text-muted">No records found.</td>
        </tr>
    @endforelse
</tbody>
<tfoot>
    <tr>
        <th>#</th>
       
        <th>Client</th>
        <th>Sector</th>
        <th>Completed</th>
        <th>Completion Date</th>
        <th>Amount</th>
       <th>File</th>
        <th>Action</th>
    </tr>
</tfoot>

                        </table>
                    </div>
                    
                
                <!-- Modal (Hidden by Default) -->
                

                <!-- Popup Modal -->
               <!-- Academic Modal -->
               <div id="academicModal" class="modal">
                <div class="modal-content">
                    <h3 class="modal-title">Add Consultancy assignments</h3>
                    <form action="{{ route('Other.post.save') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Hidden Fields -->
    <input type="hidden" name="upn_no" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
    <input type="hidden" name="email" value="{{ Auth::guard('HRPU')->user()->email }}">
    <input type="hidden" name="phone" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
    <input type="hidden" name="name" value="{{ Auth::guard('HRPU')->user()->name }}">
 <input type="hidden" name="type" value="Consultancy">
    <!-- Client -->
    <div class="form-group">
        <label>Client /organization</label>
        <input type="text" name="Client" class="form-control" required>
    </div>

    <!-- Sector Dropdown -->
    <div class="form-group">
        <label>Sector (Private/Public)</label>
        <select name="Sector" class="form-control" required>
            <option value="">Select Sector</option>
            <option value="Public">Public</option>
            <option value="Private">Private</option>
            <option value="Non-Governmental Organisation">Non-Governmental Organisation</option>
        </select>
    </div>

    <!-- Completion Status -->
    <div class="form-group">
        <label>Indicate area of research successfully
completed</label>
        <input type="text" name="completed" class="form-control" placeholder="e.g. Completed / Ongoing" required>
    </div>

    <!-- Completion Date -->
    <div class="form-group">
        <label>Date of Completion</label>
        <input type="date" name="compedate" class="form-control" required>
    </div>

    <!-- Amount (optional) -->
    <div class="form-group">
       
        
        <input type="hidden"  value="000" name="Amount" class="form-control">
    </div>

    <!-- Document Upload -->
    <div class="form-group">
    <label>Upload Supporting Document</label>
    <input type="file" name="document" class="form-control-file" accept=".pdf,.doc,.docx,.jpg,.png" required>
</div>
    

    <!-- Submit -->
    <div class="button-group mt-3">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" onclick="closeModal('academicModal')">Cancel</button>
    </div>
</form>
                </div>
            </div>
            
            <!-- Training Modal -->
            <div id="trainingModal" class="modal">
                <div class="modal-content">
                    <h3 class="modal-title">Add a Short Course</h3>
                    <form action="{{ route('Other.others') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Fields -->
                         <input type="hidden" name="upn_no" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
    <input type="hidden" name="email" value="{{ Auth::guard('HRPU')->user()->email }}">
    <input type="hidden" name="phone" value="{{ Auth::guard('HRPU')->user()->upn_no }}">
    <input type="hidden" name="name" value="{{ Auth::guard('HRPU')->user()->name }}">
                        <input type="hidden" name="type" value="Research">
            
                        <!-- Input Fields -->
                        <div class="form-group">
        <label>Client /organization</label>
        <input type="text" name="Client" class="form-control" required>
    </div>

    <!-- Sector Dropdown -->
    <div class="form-group">
        <label>Sector (Private/Public)</label>
        <select name="Sector" class="form-control" required>
            <option value="">Select Sector</option>
            <option value="Public">Public</option>
            <option value="Private">Private</option>
            <option value="Non-Governmental Organisation">Non-Governmental Organisation</option>
        </select>
    </div>

    <!-- Completion Status -->
    <div class="form-group">
        <label>Indicate area of research successfully
completed</label>
        <input type="text" name="completed" class="form-control" placeholder="e.g. Completed / Ongoing" required>
    </div>

    <!-- Completion Date -->
    <div class="form-group">
        <label>Date of Completion</label>
        <input type="date" name="compedate" class="form-control" required>
    </div>

    <!-- Amount (optional) -->
    <div class="form-group">
       
        <label>Amount of funds the research attracted
in Kshs.</label>
        <input type="text"   name="Amount" class="form-control">
    </div>
    <div class="form-group">
    <label>Upload Supporting Document</label>
    <input type="file" name="document" class="form-control-file" accept=".pdf,.doc,.docx,.jpg,.png" required>
</div>
                        <!-- Buttons -->
                        <div class="button-group">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger" onclick="closeModal('trainingModal')">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
<!-- Buttons to Open Modals -->


<!-- Modal Script -->
<script>
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
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
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                   
                    <div class="ms-auto">
                        <div class="d-flex justify-content-end mt-4">
                            <h2 class="fw-bold">Research  assignments</h2>
                        </div>
                        
                        
                    </div>
                </div>
        <div class="table-responsive">
            <table id="example1" class="table mb-0">
                <thead class="table-light">
    <tr>
        <th>#</th>
       
        <th>Client</th>
        <th>Sector</th>
        <th>Completed</th>
        <th>Completion Date</th>
        <th>Amount</th>
        <th>File</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @forelse($others as $index => $other)
        <tr>
            <td>{{ $index + 1 }}</td>
           
            <td>{{ $other->Client }}</td>
            <td>{{ $other->Sector }}</td>
            <td>{{ $other->completed }}</td>
            <td>{{ \Carbon\Carbon::parse($other->compedate)->format('d M Y') }}</td>
            <td>{{ $other->Amount ?? 'N/A' }}</td>
            <td>
                                        @if($other->document_name)
                                        <a href="{{ asset('uploads/Other/' . $other->document_name) }}" 
                                            target="_blank" 
                                            class="btn btn-sm view-button">
                                            <i class="bi bi-book"></i> View
                                         </a>
                                         
                                         <style>
                                             /* View Button */
                                             .view-button {
                                                 background-color: rgb(203, 211, 0); /* Yellowish-green color */
                                                 color: black; /* Default text color */
                                                 border: none;
                                                 border-radius: 5px;
                                                 cursor: pointer;
                                                 transition: background-color 0.3s ease, color 0.3s ease;
                                             }
                                         
                                             /* Hover effect */
                                             .view-button:hover {
                                                 background-color: white; /* Turns white on hover */
                                                 color: black; /* Black text on hover */
                                                 border: 1px solid black;
                                             }
                                         </style>
                                         
                                        @else
                                            <span class="text-danger">No Document</span>
                                        @endif
                                    </td>
            
            <td>
                <form action="{{ route('Experience.destroyother', $other->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center text-muted">No records found.</td>
        </tr>
    @endforelse
</tbody>
<tfoot>
    <tr>
        <th>#</th>
       
        <th>Client</th>
        <th>Sector</th>
        <th>Completed</th>
        <th>Completion Date</th>
        <th>Amount</th>
       <th>File</th>
        <th>Action</th>
    </tr>
                </tfoot>
            </table>
        </div>
    </div> 

   
    
    <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HRPU.Dashboard.footer')

