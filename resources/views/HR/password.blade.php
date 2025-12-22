<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('') }}assets/images/KSG Logo (1).png" type="image/png" />
	<!--plugins-->
	<link href="{{asset('') }}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('') }}assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{asset('') }}assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('') }}assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{asset('') }}assets/css/app.css" rel="stylesheet">
	<link href="{{asset('') }}assets/css/icons.css" rel="stylesheet">
	<title>KSG Career Portal</title>
	<style>
		/* Custom styles */
		body {
			background-color: #ffffff !important; /* White background */
			color: #000000 !important; /* Black text */
		}
		
		.auth-cover-right {
			background-color: #ffffff !important; /* White background for form area */
		}
		
		.card {
			background-color: #ffffff !important; /* White card background */
			border: none !important;
		}
		
		/* Button styles */
		.btn-white {
			background-color: rgb(203, 211, 0) !important; /* Yellow-green submit button */
			color: #000000 !important; /* Black text */
			border: none;
		}
		
		.btn-white:hover {
			background-color: rgba(203, 211, 0, 0.8) !important; /* Slightly transparent on hover */
		}
		
		.btn-light {
			background-color: rgb(127, 98, 44) !important; /* Brown back button */
			color: #ffffff !important; /* White text */
			border: none;
		}
		
		.btn-light:hover {
			background-color: rgba(127, 98, 44, 0.8) !important; /* Slightly transparent on hover */
		}
		
		.btn-primary {
			background-color: #007bff !important; /* Keep default blue for email button */
		}
		
		/* Form input styling */
		.form-control {
			background-color: #f8f9fa !important; /* Light gray input background */
			border: 1px solid #ced4da !important;
			color: #000000 !important; /* Black text */
		}
		
		.form-control:focus {
			border-color: rgb(203, 211, 0) !important; /* Yellow-green focus */
			box-shadow: 0 0 0 0.2rem rgba(203, 211, 0, 0.25) !important;
		}
		
		/* Alert boxes */
		.alert-success {
			background-color: #d4edda !important;
			color: #155724 !important;
			border-color: #c3e6cb !important;
		}
		
		.alert-danger {
			background-color: #f8d7da !important;
			color: #721c24 !important;
			border-color: #f5c6cb !important;
		}
		
		/* Text colors */
		h4, p, label, .text-muted {
			color: #000000 !important; /* Black text */
		}
	</style>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-cover">
			<div class="">
				<div class="row g-0">
					<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
						<div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
							<div class="card-body">
								<img src="{{asset('') }}assets/images/login-images/forgot-password-cover.svg" class="img-fluid" width="600" alt=""/>
							</div>
						</div>
					</div>
					<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
						<div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
							<div class="card-body p-sm-5">
								<div class="p-3">
									<!-- Success Message -->
									@if (session('status'))
									<div class="alert alert-success">
										{{ session('status') }}
									</div>
									@endif

									<!-- General Error Message -->
									@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif

									<div class="text-center">
										<img src="assets/images/icons/forgot-2.png" width="100" alt="" />
									</div>
									<h4 class="mt-5 font-weight-bold">Request password?</h4>
									<p class="text-muted">Enter your UPN No</p>
									<form action="{{ route('password.recovery') }}" method="POST">
										@csrf
										<div class="my-4">
											<label class="form-label">UPN Number</label>
											<input type="text" id="upn_no" name="upn_no" class="form-control" placeholder="user.example@ksg.ac.ke" />
										</div>
										
										<div class="d-grid gap-2">
											<button type="submit" class="btn btn-white">Send</button>
											<a href="/" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	
	<!-- Bootstrap JS -->
	<script src="{{asset('') }}assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{asset('') }}assets/js/jquery.min.js"></script>
</body>

</html>