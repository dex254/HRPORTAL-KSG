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
                                <li class="breadcrumb-item active" aria-current="page">Edit Staff User Details</li>
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
                                        <h5 class="">KSG Staff Update</h5>
                                        <p class="mb-0">Please fill the below details to edit staff details</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ route('Admin.accounts',$admin->id) }}" method="POST">
                                            @csrf
                                           

                                           

                                            <div class="col-6">
                                                <label for="inputSurname" class="form-label">Full Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{ $admin->name }}">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-message'></i></span>
                                                    <input type="email" class="form-control" name="email" id="email" value="{{ $admin->email }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="inputID" class="form-label">ID OR Passport No.</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-id-card'></i></span>
                                                    <input type="number" class="form-control" name="idnumber" id="idnumber" value="{{ $admin->idnumber }}">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <label for="inputNumber" class="form-label">Phone Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-phone'></i></span>
                                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $admin->phone }}">
                                                </div>
                                            </div>

                                           <div class="col-6 text-center">
    <label class="form-label d-block mb-3">Role</label>
    <div id="roles" class="d-flex flex-wrap justify-content-center gap-3">
        @php
            $roles = ['Dex', 'Admin', 'Super Admin', 'Root', 'HRM', 'Data', 'Viewer'];
        @endphp
        @foreach($roles as $role)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" value="{{ $role }}" id="{{ Str::slug($role) }}Radio" 
                {{ $admin->role === $role ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ Str::slug($role) }}Radio">{{ $role }}</label>
        </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var loggedInRole = "{{ Auth::guard('admin')->user()->role }}"; // Logged-in user role
    var currentRole = "{{ $admin->role }}"; // Role of the user being edited

    // Roles that can assign any role
    var canAssignAnyRole = ['Dex', 'Super Admin', 'Admin'];

    if (!canAssignAnyRole.includes(loggedInRole)) {
        // Hide all radios by default
        document.querySelectorAll('#roles .form-check').forEach(function(el) {
            el.style.display = 'none';
        });

        // Show only the existing role of the user being edited
        var existingRadio = document.querySelector('input[name="role"][value="' + currentRole + '"]');
        if (existingRadio) {
            existingRadio.parentNode.style.display = 'block';
        }
    } else {
        // Show all roles for Dex, Super Admin, and Admin
        document.querySelectorAll('#roles .form-check').forEach(function(el) {
            el.style.display = 'block';
        });
    }
});
</script>


                                            
                                            <div class="col-6">
                                                <label for="campus" class="form-label">Campus</label>
                                                <div id="campus">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="campus" id="LowerKabete" value="Lower Kabete" 
                                                            {{ $admin->campus == 'Lower Kabete' ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="LowerKabete">Lower Kabete</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="campus" id="eLDi" value="eLDi" 
                                                            {{ $admin->campus == 'eLDi' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="eLDi">eLDi</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="campus" id="Mombasa" value="Mombasa" 
                                                            {{ $admin->campus == 'Mombasa' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="Mombasa">Mombasa</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="campus" id="Matuga" value="Matuga" 
                                                            {{ $admin->campus == 'Matuga' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="Matuga">Matuga</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="campus" id="Embu" value="Embu" 
                                                            {{ $admin->campus == 'Embu' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="Embu">Embu</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="campus" id="Baringo" value="Baringo" 
                                                            {{ $admin->campus == 'Baringo' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="Baringo">Baringo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <label for="inputDes" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-briefcase-alt-2'></i></span>
                                                    <input type="text" class="form-control" name="password" id="des" value="KSG@2024">
                                                </div>
                                            </div>
                                          
                                            <br/>
                                            <br/>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-light">Update</button>
                                                </div>
                                               
                                            </div>
                                            <div class="col-12">
                                            <div class="d-grid">
                                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $admin->email }}&su=Your%20Account%20Profile%20Credentials%20Updated&body=Dear%20{{ $admin->fnamel }}%20{{ $admin->sname }},%0A%0AWe%20would%20like%20to%20inform%20you%20that%20your%20account%20profile%20credentials%20have%20been%20successfully%20updated.%20Please%20find%20the%20details%20below:%0A%0AName:%20{{ $admin->fnamel }}%20{{ $admin->sname }}%20{{ $admin->mname }}%0AID%20Number:%20{{ $admin->iden }}%0ADepartment:%20{{ $admin->dept }}%0APhone%20Number:%20{{ $admin->phone }}%0A%0AYour%20new%20password%20is:%20KSG@2024%0A%0APlease%20ensure%20to%20keep%20this%20information%20confidential.%0A%0AIf%20you%20have%20any%20questions%20or%20need%20further%20assistance,%20feel%20free%20to%20contact%20our%20support%20team.%0A%0ARegards,%0AKenya%20School%20of%20Government%20ICT%20Support%20Team" 
                                                    class="ms-3" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top" 
                                                    title="Update"> <button type="button" class="btn btn-primary"><i class="bx bxs-message"></i>Click  to informthe user  before  updating </button>  </a>
                                            </div></div>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    // Get the elements
                                                    const updateButton = document.querySelector('button[type="submit"]');
                                                    const informButton = document.querySelector('.btn.btn-primary');
                                            
                                                    // Hide the Update button initially
                                                    updateButton.style.display = "none";
                                            
                                                    // Add an event listener to the Inform button
                                                    informButton.addEventListener("click", function () {
                                                        // Show the Update button when Inform button is clicked
                                                        updateButton.style.display = "block";
                                                    });
                                                });
                                            </script>
                                            

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
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <!--end wrapper-->


@include('admin.Dashboard.footer')
