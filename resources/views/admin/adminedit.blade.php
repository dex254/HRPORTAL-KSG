@include('admin.Layout.header')

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Admin Details || KSG LRS</title>
</head>

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
                                <li class="breadcrumb-item active" aria-current="page">Edit Admin Details</li>
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
                                        <h5 class="">KSG Admin Update</h5>
                                        <p class="mb-0">Please fill the below details to edit admin details</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ route('admin.edit.update.post', $admin->id) }}" method="POST">
                                            @csrf
                                            <div class="col-md-6">
                                                <label for="inputFirstname" class="form-label">First Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                                    <input type="text" class="form-control" name="fname" id="fname" value="{{ $admin->fname }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputMidname" class="form-label">Middle Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                                    <input type="text" class="form-control" name="mname" id="mname" value="{{ $admin->mname }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputSurname" class="form-label">Surname</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-user'></i></span>
                                                    <input type="text" class="form-control" name="sname" id="sname" value="{{ $admin->sname }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-message'></i></span>
                                                    <input type="email" class="form-control" name="email" id="email" value="{{ $admin->email }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputID" class="form-label">ID OR Passport No.</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-id-card'></i></span>
                                                    <input type="number" class="form-control" name="iden" id="iden" value="{{ $admin->iden }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputNumber" class="form-label">Phone Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-phone'></i></span>
                                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $admin->phone }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputDept" class="form-label">Department</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bx-detail'></i></span>
                                                    <input type="text" class="form-control" name="dept" id="dept" value="{{ $admin->dept }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="inputDes" class="form-label">Designation</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class='bx bxs-briefcase-alt-2'></i></span>
                                                    <input type="text" class="form-control" name="des" id="des" value="{{ $admin->des }}">
                                                </div>
                                            </div>
                                            

                                            <br/>
                                            <br/>

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-light">Update</button>
                                                </div>
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
</body>

@include('admin.Layout.footer')
