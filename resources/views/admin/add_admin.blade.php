@include('admin.Dashboard.header')
<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Admin User</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col-xl-9 mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="mb-3 text-center">
                                    <img src="{{asset('assets/images/KSG Logo (1).png')}}" width="60" alt="" />
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
                @if ($errors->any())
                    <div class="alert alert-danger" id="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
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
                                <div class="text-center mb-4">
                                    <h5 class="">KSG Admin</h5>
                                    <p class="mb-0">Please fill the below details to create new admin account</p>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="{{ route('admin.add.store') }}" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <div>
                                                <label for="formFileLg" class="form-label">Choose  a profile picture</label>
                                                <input class="form-control form-control-lg" id="formFileLg" name="image" type="file" multiple>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputFirstname" class="form-label">Full Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="James">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bxs-message'></i></span>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="example@user.com">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputID" class="form-label">ID OR Passport No.</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bxs-id-card'></i></span>
                                                <input type="number" class="form-control" name="idnumber" id="idnumber" placeholder="1234567">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputNumber" class="form-label">Phone Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class='bx bxs-phone'></i></span>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="(+254)xxx xxx xxx">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCampus" class="form-label">Campus</label>
                                            @if($admin->role != 'AdminAssistant')
                                                <select name="campus" class="form-select form-select-lg mb-3">
                                                    <option value="Lower Kabete">Lower Kabete</option>
                                                    <option value="Baringo">Baringo</option>
                                                    <option value="Matuga">Matuga</option>
                                                    <option value="Embu">Embu</option>
                                                    <option value="eLDi">eLDi</option>
                                                    <option value="Mombasa">Mombasa</option>
                                                </select>
                                            @else
                                                <input type="text" class="form-control" name="campus" value="{{ $admin->campus }}" readonly>
                                            @endif
                                        </div>
                                    
                                        <div class="col-12 text-center">
    <label class="form-label d-block mb-3">Role</label>
    <div id="roles" class="d-flex justify-content-center flex-wrap gap-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="Dex" id="dexRadio">
            <label class="form-check-label" for="dexRadio">Dex</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="Admin" id="adminRadio">
            <label class="form-check-label" for="adminRadio">Admin</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="Super Admin" id="superAdminRadio">
            <label class="form-check-label" for="superAdminRadio">Super Admin</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="Root" id="rootRadio">
            <label class="form-check-label" for="rootRadio">Root</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="HRM" id="hrmRadio">
            <label class="form-check-label" for="hrmRadio">HRM</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="Data" id="dataRadio">
            <label class="form-check-label" for="dataRadio">Data</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="Viewer" id="viewerRadio">
            <label class="form-check-label" for="viewerRadio">Viewer</label>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var userRole = "{{ $admin->role }}"; // Get the authenticated user's role

    // Auto-select the correct role
    var roleMap = {
        'Dex': 'dexRadio',
        'Admin': 'adminRadio',
        'Super Admin': 'superAdminRadio',
        'Root': 'rootRadio',
        'HRM': 'hrmRadio',
        'Data': 'dataRadio',
        'Viewer': 'viewerRadio'
    };

    if(roleMap[userRole]) {
        document.getElementById(roleMap[userRole]).checked = true;
    }

    // If the user is not 'Dex', optionally hide Dex radio
    if(userRole !== "Dex") {
        // For example, hide Dex for other users
        document.getElementById("dexRadio").parentNode.style.display = 'none';
    }

    // Optional: you can control which roles are visible based on the logged-in user's role
});
</script>

                                       

                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="text" class="form-control border-end-0" name="password" id="inputChoosePassword" placeholder="Enter Password" oninput="checkPasswordStrength()">
                                                <a href="javascript:;" class="input-group-text bg-transparent" onclick="togglePasswordVisibility()">
                                                    <i class='bx bx-hide' id="toggleIcon"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="progress mb-3" style="height: 7px;">
                                            <div class="progress-bar progress-bar-striped bg-warning" id="strengthBar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small id="strengthText" class="form-text"></small>
                                        
                                        <script>
                                            function togglePasswordVisibility() {
                                                const passwordInput = document.getElementById("inputChoosePassword");
                                                const toggleIcon = document.getElementById("toggleIcon");
                                                if (passwordInput.type === "password") {
                                                    passwordInput.type = "text";
                                                    toggleIcon.classList.remove('bx-hide');
                                                    toggleIcon.classList.add('bx-show');
                                                } else {
                                                    passwordInput.type = "password";
                                                    toggleIcon.classList.remove('bx-show');
                                                    toggleIcon.classList.add('bx-hide');
                                                }
                                            }
                                        
                                            function checkPasswordStrength() {
                                                const password = document.getElementById("inputChoosePassword").value;
                                                const strengthBar = document.getElementById("strengthBar");
                                                const strengthText = document.getElementById("strengthText");
                                        
                                                let strength = 0;
                                        
                                                if (password.length >= 8) strength += 1; // Length
                                                if (/[A-Z]/.test(password)) strength += 1; // Uppercase
                                                if (/[a-z]/.test(password)) strength += 1; // Lowercase
                                                if (/[0-9]/.test(password)) strength += 1; // Number
                                                if (/[\W_]/.test(password)) strength += 1; // Special character
                                        
                                                const strengthPercent = (strength / 5) * 100;
                                                strengthBar.style.width = strengthPercent + '%';
                                                strengthBar.setAttribute('aria-valuenow', strengthPercent);
                                        
                                                // Update the strength text
                                                if (strengthPercent === 0) {
                                                    strengthText.textContent = '';
                                                    strengthBar.className = 'progress-bar progress-bar-striped bg-warning';
                                                } else if (strengthPercent < 40) {
                                                    strengthText.textContent = 'Weak';
                                                    strengthBar.className = 'progress-bar progress-bar-striped bg-danger';
                                                } else if (strengthPercent < 70) {
                                                    strengthText.textContent = 'Moderate';
                                                    strengthBar.className = 'progress-bar progress-bar-striped bg-warning';
                                                } else {
                                                    strengthText.textContent = 'Strong';
                                                    strengthBar.className = 'progress-bar progress-bar-striped bg-success';
                                                }
                                            }
                                        </script>
                                        
                                        
                                        
                                       
                                            <script>
                                                $(document).ready(function () {
                                                    $("#show_hide_password a").on('click', function (event) {
                                                        event.preventDefault();
                                                        if ($('#show_hide_password input').attr("type") == "text") {
                                                            $('#show_hide_password input').attr('type', 'password');
                                                            $('#show_hide_password i').addClass("bx-hide");
                                                            $('#show_hide_password i').removeClass("bx-show");
                                                        } else if ($('#show_hide_password input').attr("type") == "password") {
                                                            $('#show_hide_password input').attr('type', 'text');
                                                            $('#show_hide_password i').removeClass("bx-hide");
                                                            $('#show_hide_password i').addClass("bx-show");
                                                        }
                                                    });
                                                });
                                            </script>
                                        

                                        <br/>

                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                            </div>
                                        </div>

                                        <br/>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-light">Add</button>
                                            </div>
                                        </div>

                                        <br/>

                                        <div class="col-12 text-center">
                                            <p class="mb-0">Does admin already exist? <a href="/AdminLogin">Sign in here.</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
@include('admin.Dashboard.footer')




