@include('admin.Dashboard.header')

	<div class="wrapper">
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Account Management</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
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


                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col">
						<div class="card">
							<div class="card-body">
								<ul class="list-group">
									<li class="list-group-item active" aria-current="true"><strong>CURRENT ADMIN USER DETAILS</strong></li>
									<li class="list-group-item"><strong>Full Name: </strong> <span> {{ $admin->fname }}{{ $admin->mname }}{{ $admin->sname }} </span></li>
									<li class="list-group-item"><strong>E-Mail Address: </strong><span>{{ $admin->email }}</span></li>
									<li class="list-group-item"><strong>ID or Passport No.: </strong><span>{{ $admin->iden }}</span></li>
									<li class="list-group-item"><strong>Contact: </strong><span>{{ $admin->phone }}</span></li>
									<li class="list-group-item"><strong>Designation: </strong><span>{{ $admin->des }}</span></li>
									<li class="list-group-item"><strong>Department: </strong><span>{{ $admin->dept }}</span></li>
								</ul>
							</div>
						</div>
					</div>
                </div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body">
								<h5 class="d-flex align-items-center mb-3">Key in new details:</h5>
                                <br>

                                <form class="row g-3" action="{{ route('password.updateadmin.post',$admin->id) }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>First Name:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fname" value="{{ $admin->fname }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Middle Name:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="mname" value="{{ $admin->mname }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Surname:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="sname" value="{{ $admin->sname }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>E-Mail Address:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email" value="{{ $admin->email }}>" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>ID or Passport No.:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="iden" value="{{ $admin->iden}}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Contact:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone" value="{{ $admin->phone }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Designation:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="des" value="{{ $admin->des }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Department:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="dept" value="{{ $admin->dept }}" />
                                        </div>
                                        
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p>Department:</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="password" value="" placeholder="KSG@2024" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-light px-4">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
						
							</div>
						</div>
					</div>
            	</div>
        	</div>
    	</div>
		<!--end page wrapper -->
	</div>
	<!--end wrapper-->
    @include('admin.Dashboard.footer')