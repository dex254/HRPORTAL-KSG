<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/dashtreme/demo/vertical/dashboard-alternate.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 May 2024 07:17:23 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('') }}assets/images/KSG Logo (1).png" type="image/png" />
	<!--plugins-->
	<link href="{{asset('') }}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/highcharts/css/highcharts-white.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('') }}assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{asset('') }}assets/js/pace.min.js"></script>
	<link href="{{asset('') }}assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="{{asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('') }}assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{asset('') }}assets/css/app.css" rel="stylesheet">
	<link href="{{asset('') }}assets/css/icons.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Include jQuery (necessary for DataTables) -->
    <link href="{{asset('assets/css/dataTables.dataTables.min.css') }}" rel="stylesheet">
	
	<title>KSG Application Dashboard</title>
</head>
<style>
    /* Apply black text to all elements */
    body, h1, h2, h3, h4, h5, h6, p, span, div, a, button, li, label, input, textarea, select, th, td {
        color: black !important;
    }

    /* Override Bootstrap or any framework's text color */
    .text-white, .text-light, .text-muted {
        color: black !important;
    }

    /* Ensure button and link text also remain black */
    a, button {
        color: black !important;
    }

    /* Ensure icons (such as in buttons) are black */
    i, svg {
        fill: black !important;
        color: black !important;
    }

    /* Ensure alert text remains readable */
    .alert-success, .alert-danger {
        color: black !important;
    }
</style>


<body style="background-color: rgb(247, 243, 243); color: black !important;">


    
    
	<!--wrapper-->
	<div class="wrapper">
		<!--start header wrapper-->	
	  <div class="header-wrapper">
			
        <header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
                    <button class="dashboard-button" onclick="markCompleteAndNavigate('{{ route('EXT.Application.MY') }}')">
                        My Applications
                    </button>
            
                    <!-- My Profile Button -->
                    <button class="dashboard-button" onclick="markCompleteAndNavigate('{{ route('EXT.Dashboard') }}')">
                        My Profile
                    </button><style>
                        /* Dashboard Buttons */
                        .dashboard-button {
    background-color: rgb(127, 98, 44) !important; /* Brown background */
    color: white !important; /* White text */
    border: none !important;
    padding: 10px 20px !important;
    border-radius: 5px !important;
    cursor: pointer !important;
    transition: background-color 0.3s ease, color 0.3s ease !important;
}

/* Hover Effect for Buttons */
.dashboard-button:hover {
    background-color: white !important; /* White background on hover */
    color: rgb(203, 211, 0) !important; /* Brown text on hover */
    border: 1px solid rgb(114, 140, 125) !important; /* Brown border on hover */
}

                    </style>
					
                    <span class="nav-link fw-bold" style="color: brown; font-size: 2.0rem;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KSG Online Application  Portal</span>
                    
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							
                            <form method="POST" action="{{ route('EXT.logout') }}">
                                @csrf
                                <button type="submit" class="logout-button">
                                    <i class="bx bx-log-out-circle me-2 text-white"></i>
                                    <span class="text-white">Logout</span>
                                </button>
                            </form>
                            
                            <style>
                                .logout-button {
                                    background-color: rgb(127, 98, 44); /* Default background color */
                                    color: white; /* Text color */
                                    border: none;
                                    padding: 10px 20px;
                                    border-radius: 50px; /* Rounded-pill style */
                                    cursor: pointer;
                                    display: flex;
                                    align-items: center;
                                    transition: background-color 0.3s ease, color 0.3s ease;
                                }
                            
                                /* Hover effect */
                                .logout-button:hover {
                                    background-color: rgb(203, 211, 0); /* Change background color on hover */
                                    color: white; /* Keep text white */
                                }
                            </style>
                            

							<li class="nav-item dropdown dropdown-app">
								
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="app-container p-2 my-2">
									  <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
										
										
				
									  </div><!--end row-->
				
									</div>
								</div>
							</li>

							<li class="nav-item dropdown dropdown-large">
								
								<div class="dropdown-menu dropdown-menu-end">
									
									<div class="header-notifications-list">
									
										
										
										
										
										
										
										
										
									</div>
									
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
							
								
									
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									
									<div class="header-message-list">
										
										
										
									
										
										
										
										
										
									</div>
									
								</div>
							</li>
						</ul>
					</div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="form-elements.html#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							
							
                            
                            <div class="user-info">
                                <p class="user-name mb-0"> {{ Auth::guard('EXT')->user()->name}}, </p>
                                <p class="designattion mb-0">{{ Auth::guard('EXT')->user()->designation}}: {{ Auth::guard('EXT')->user()->campus}} </p>
                            </div>
                        </a>
						
                        <ul class="dropdown-menu dropdown-menu-end" style="background-color: white; color: black;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/Home" style="color: black;">
                                    <i class='bx bx-home-alt'></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/Complete_update_online" style="color: black;">
                                    <i class="bx bx-user fs-5"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/Jobs_to_apply" style="color: black;">
                                    <i class='bx bx-chevron-down'></i>
                                    <span>Advertised Jobs</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/My_applications" style="color: black;">
                                    <i class='bx bx-bar-chart-alt-2'></i>
                                    <span>My Application</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('EXT.logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger border border-primary rounded-pill px-4 py-2 d-flex align-items-center">
                                        <i class="bx bx-log-out-circle me-2 text-white"></i>
                                        <span class="text-white">Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
				</nav>
			</div>
		</header>
       
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success') || session('status'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '{{ session('success') ?? session('status') }}',
    confirmButtonColor: '#3085d6',
});
</script>
@endif

<!-- Error Message -->
@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{ session('error') }}',
    confirmButtonColor: '#d33',
});
</script>
@endif

<!-- Validation Errors -->
@if ($errors->any())
<script>
Swal.fire({
    icon: 'warning',
    title: 'Validation Error',
    html: `{!! implode('<br>', $errors->all()) !!}`,
    confirmButtonColor: '#f39c12',
});
</script>
@endif
    <br>
    <br>
    <br>
    
