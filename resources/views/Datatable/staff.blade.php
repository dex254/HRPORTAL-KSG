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
                            <li class="breadcrumb-item">
                                <a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Staff Members</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-light">Outputs</button>
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            <a class="dropdown-item" href="javascript:;">Copy</a>
                            <a class="dropdown-item" href="javascript:;">Excel</a>
                            <a class="dropdown-item" href="javascript:;">PDF</a>
                            <a class="dropdown-item" href="javascript:;">Print</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div>
                    </div>
                </div>
            </div> <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            <a href="/admin/add_staff" class="btn btn-light radius-30 mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i>Add New Staff
                            </a>
                        </div>
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
                    <div class="table-responsive">
                        <table id="example2" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Staff#</th>
                                    <th>Image</th>
                                    <th>Full Name</th>
                                    <th>E-Mail</th>
                                    <th>Contact</th>
                                    <th>Department</th>
                                    <th>User role</th>
                                    <th>Campus</th>
                                    <th>Status</th>
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staff as $staff)
                                <tr>
                                    <td>{{ $staff->idnumber }}</td>
                                    <td><div class="profile-image">
                                        <img src="{{asset('') }}profile/{{ $staff->image }}"  class="user-img" alt="user avatar">
                                    </div></td>
                                    <td>{{ $staff->name }} </td>
                                    <td>{{ $staff->email }}</td>
                                    <td>{{ $staff->phone }}</td>
                                    <td>{{ $staff->department }}</td>
                                    <td>
                                        @if ($staff->usertype === 'Dual user')
                                            <span class="badge bg-success">Dual User</span>
                                            @elseif ($staff->usertype === 'Facilitator')
                                            <span class="badge bg-dark">Facilitator</span>
                                       
                                     @elseif ($staff->usertype === 'Coordinator')
                                            <span class="badge bg-primary">Coordinator</span>
                                        @endif
                                    </td>
                                    <td>{{ $staff->campus }}</td>
                                    <td>
                                        @if ($staff->is_online === 0)
                                        <span class="badge bg-danger">Offline</span>
                                    @elseif ($staff->is_online === 1)
                                        <span class="badge bg-success">Online</span>
                                    @endif
                                    
                                    </td>
                                    <td>{{ $staff->login_time }}</td>
                                    <td>{{ $staff->logout_time }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                             
                                            <a href="{{ route('password.staffedit', ['email' => $staff->email]) }}" class="ms-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Password" onclick="confirmChangePassword('{{ $staff->email }}');">
                                                <i class="bx bxs-key"></i>
                                            </a>
                                            
                                            <script>
                                                function confirmChangePassword(email) {
                                                    const confirmAction = confirm("Are you sure you want to change the staff profile for " + email + "?");
                                                    if (confirmAction) {
                                                        // Proceed with changing the password
                                                        Changepassword(email);
                                                    }
                                                }
                                            </script>
                                        </div>
                                        <script>
                                            function confirmDelete(iden) {
                                                if (confirm('Are you sure you want to delete this user data?')) {
                                                    document.getElementById('delete-form-' + iden).submit();
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Staff#</th>
                                    <th>image</th>
                                    <th>Full Name</th>
                                    <th>E-Mail</th>
                                    <th>Contact</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Campus</th>
                                    <th>Status</th>
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('admin.Dashboard.footer')

