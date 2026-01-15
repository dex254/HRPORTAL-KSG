@include('EXT.Dashboard.header')
@include('EXT.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Referees</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                       
                    </nav>
                </div>
               <div class="alert alert-info mt-3" role="alert">
    <i class="bx bx-info-circle"></i>
    Please provide details of referees who can professionally attest to your
    <strong>qualifications, experience, and character</strong>.
</div>

            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('EXT.Special.Licence') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>

                    <button onclick="location.href='{{ route('EXT.Report.User') }}'" class="btn next-button px-4 py-2">
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
                                   Add Your Referee

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
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Position</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach($referees as $referee)
    <tr>
        <td>{{ $referee->employer }}</td>
        <td>{{ $referee->refname }}</td>
        <td>{{ $referee->refphone }}</td>
        <td>{{ $referee->refemail }}</td>
        <td>{{ $referee->Position }}</td>
        <td>
            <form action="{{ route('EXT.delete', $referee->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
         <th>Employer</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Position</th>
        <th>Action</th>
    </tr>
</tfoot>

                        </table>
                    </div>
                   

                <!-- Popup Modal -->
                <div id="academicModal" class="modal">
                    <div class="modal-content">
                        <h3 class="modal-title">Add Referees</h3>
                       
                
                        <form action="{{ route('EXT.ref') }}"   method="POST"  >
                            @csrf
                            
                            
                
                            <!-- Hidden Fields -->
                            <input type="hidden" name="upn_no" value="{{ Auth::guard('EXT')->user()->upn_no }}">
                            <input type="hidden" name="email" value="{{ Auth::guard('EXT')->user()->email }}">
                            <input type="hidden" name="phone" value="{{ Auth::guard('EXT')->user()->upn_no }}">
                            <input type="hidden" name="name" value="{{ Auth::guard('EXT')->user()->name }}">
                            <input type="hidden" name="job_title" value="none">
                            <!-- Input Fields -->
                           



<!-- This is the field that will be saved -->



                <div class="form-group">
        <label for="employer"> Employer</label>
        <input type="text" class="form-control" name="employer" required>
    </div>
                           
                
                           
                             <div class="form-group">
        <label for="refname">Referee Name</label>
        <input type="text" class="form-control" name="refname" required>
    </div>

    <div class="form-group">
        <label for="refphone">Referee Phone</label>
        <input type="text" class="form-control" name="refphone" required>
    </div>

    <div class="form-group">
        <label for="refemail">Referee Email</label>
        <input type="email" class="form-control" name="refemail" required>
    </div>

    <div class="form-group">
        <label for="Position">Referee Position <small>(optional)</small></label>
        <input type="text" class="form-control" name="Position">
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

@include('EXT.Dashboard.footer')

