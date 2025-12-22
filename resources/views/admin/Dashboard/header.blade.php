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
	
    <!-- Include jQuery (necessary for DataTables) -->
    <link href="{{asset('assets/css/dataTables.dataTables.min.css') }}" rel="stylesheet">
	
	<title>KSG->{{ Auth::guard('admin')->user()->role}}</title>
</head>

<body  class="bg-theme bg-theme10" >
    
    
	<!--wrapper-->
	<div  class="wrapper">
		<!--sidebar wrapper -->
		
        <header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					
					
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
								<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
								</a>
							</li>
							

							<li class="nav-item dropdown dropdown-app">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;"><i class='bx bx-grid-alt'></i></a>
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
							<div style="display: flex; align-items: center;">
    <!-- Circle Indicator -->
    <div class="user-status" style="width: 20px; height: 20px; background-color: {{ Auth::guard('admin')->user()->is_online == 1 ? '#28a745' : '#dc3545' }}; border-radius: 50%; margin-right: 8px;"></div>
    
    <!-- Status Text -->
    <span style="font-weight: bold; font-size: 16px; color: white;">
        {{ Auth::guard('admin')->user()->is_online == 1 ? 'Online' : 'Offline' }}
    </span>
</div>


								
								
									
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									
									<div class="header-message-list">
										
										
										
									
										
										
										
										
										
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">
											<div class="d-flex align-items-center justify-content-between mb-3">
												<h5 class="mb-0">Total</h5>
												<h5 class="mb-0 ms-auto">$489.00</h5>
											</div>
											<button class="btn btn-light w-100">Checkout</button>
										</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="form-elements.html#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								
								<div class="profile-image">
									<img src="{{asset('') }}profile/{{ Auth::guard('admin')->user()->image}}"  class="user-img" alt="user avatar">
								</div>
							
                            
                            <div class="user-info">
                                <p class="user-name mb-0"> {{ Auth::guard('admin')->user()->name}} </p>
                                <p class="designattion mb-0">{{ Auth::guard('admin')->user()->role}} {{ Auth::guard('admin')->user()->phone}} </p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center" href="/admin/profile"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="/admin/profile/edit"> <i class="bx bx-cog fs-5"></i> <span>Settings</span>
                            </a>
                            </li>
                            
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;" onclick="this.closest('form').submit();">
                                        <i class="bx bx-log-out-circle"></i><span>Logout</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
				</nav>
			</div>
		</header>
		<div class="primary-menu">
            <nav class="navbar navbar-expand-lg align-items-center">
             

               <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                 <div class="offcanvas-header border-bottom">
                     <div class="d-flex align-items-center">
                         
                         <div class="">
                             
                         </div>
                     </div>
                   <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                 </div>
                 <div class="offcanvas-body">
                  <ul class="navbar-nav align-items-center flex-grow-1">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">
                            <div class="d-flex align-items-center">
                                <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                                <div class="menu-title ms-2">Home</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="parent-icon"><i class='bx bx-cube'></i></div>
                                <div class="menu-title ms-2">Adjunct Faculty Jobs</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/List_of_jobs_advatised_ext"><i class='bx bx-briefcase-alt'></i>Advatised   Jobs</a></li>
                            
                            <li><a class="dropdown-item" href="/Adjunct_Faculty_applications"><i class='bx bx-briefcase-alt'></i>Applications</a></li>
                            <li><a class="dropdown-item" href="/Adjunct_Faculty"><i class='bx bx-envelope'></i>Adjunct_Faculty  Users</a></li>
                        </ul>
                    </li>
                    
                
                    <!-- Jobs -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="parent-icon"><i class='bx bx-cube'></i></div>
                                <div class="menu-title ms-2">Jobs</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Jobs_applied_to"><i class='bx bx-briefcase-alt'></i>Jobs Applied To</a></li>
                            <li><a class="dropdown-item" href="/List_of_jobs_advatised"><i class='bx bx-envelope'></i>Jobs Advertised</a></li>
                        </ul>
                    </li>
                
                    <!-- Applicants -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="parent-icon"><i class='bx bx-user-circle'></i></div>
                                <div class="menu-title ms-2">External Applications</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/List_of_jobs_External"><i class='bx bx-briefcase-alt'></i>Advatised External   Jobs</a></li>
                            
                            <li><a class="dropdown-item" href="/External_applications"><i class='bx bx-briefcase-alt'></i>External Applications</a></li>
                            <li><a class="dropdown-item" href="/External_Users"><i class='bx bx-envelope'></i>External  Users</a></li>
                        </ul>
                    </li>
                
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="parent-icon"><i class='bx bx-user-circle'></i></div>
                                <div class="menu-title ms-2">Applicants</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/All_the_staff_to_apply"><i class='bx bx-radio-circle'></i>Applicants Data</a></li>
                            <li><a class="dropdown-item" href="/Qualified_Canidates"><i class='bx bx-radio-circle'></i>Qualified Candidates</a></li>
                            <li><a class="dropdown-item" href="/NotQualified_Canidates"><i class='bx bx-radio-circle'></i>Not Qualified Candidates</a></li>
                        </ul>
                    </li>
                    <!-- Account Management -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="parent-icon"><i class='bx bx-lock'></i></div>
                                <div class="menu-title ms-2">Account Management</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Datatable/admin"><i class='bx bx-radio-circle'></i>Admins Data</a></li>
                           
                            <li><a class="dropdown-item" href="/Upload_profesionalbodies"><i class='bx bx-radio-circle'></i>Upload Professional Bodies</a></li>
                        </ul>
                    </li>
                
                    <!-- Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="parent-icon"><i class='bx bx-user'></i></div>
                                <div class="menu-title ms-2">Profile</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/admin/profile"><i class='bx bx-wine'></i>My Profile</a></li>
                            <li><a class="dropdown-item" href="/admin/profile/edit"><i class='bx bx-cog'></i>Update Profile</a></li>
                            <li><a class="dropdown-item" href="/Provide_proffecional_info"><i class='bx bx-cog'></i>Compiled  Documents  with  user  guide</a></li>
                            
                        </ul>
                    </li>
                
                    <!-- Logout -->
                    <li class="nav-item">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger border border-primary rounded-pill px-4 py-2 d-flex align-items-center">
                                <i class="bx bx-log-out-circle me-2 text-white"></i>
                                <span class="text-white">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
                <style>
                  .navbar-nav {
                      display: flex;
                      align-items: center;
                      gap: 1rem;
                  }
              
                  .nav-item {
                      position: relative;
                  }
              
                  .nav-link {
                      display: flex;
                      align-items: center;
                      padding: 0.5rem 1rem;
                      color: #000000; /* Black color */
                      font-weight: bold; /* Bold text */
                      text-decoration: none;
                      transition: background-color 0.3s ease;
                  }
              
                  .nav-link:hover {
                      background-color: #f8f9fa;
                      border-radius: 4px;
                  }
              
                  .dropdown-menu {
                      display: none;
                      position: absolute;
                      top: 100%;
                      left: 0;
                      background-color: #318fa9;
                      border: 1px solid #ddd;
                      border-radius: 4px;
                      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                      z-index: 1000;
                  }
              
                  .dropdown-menu.show {
                      display: block;
                  }
              
                  .dropdown-item {
                      display: flex;
                      align-items: center;
                      padding: 0.5rem 1rem;
                      color: #333;
                      text-decoration: none;
                      transition: background-color 0.3s ease;
                  }
              
                  .dropdown-item:hover {
                      background-color: #1179E1FF;
                  }
              
                  .btn-danger {
                      background-color: #dc3545;
                      border-color: #dc3545;
                  }
              
                  .btn-danger:hover {
                      background-color: #c82333;
                      border-color: #bd2130;
                  }
              </style>
                 </div>
               </div>
           </nav>
     </div>
     <!--end navigation-->
    </div>
<br>
<br>
<br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
  