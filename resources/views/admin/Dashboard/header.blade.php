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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
	
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
        @php
    $role = Auth::guard('admin')->user()->role;

    /*
    |--------------------------------------------------------------------------
    | PER-LINK ROLE VISIBILITY (EDIT ROLES HERE ONLY)
    |--------------------------------------------------------------------------
    */
    $can = [
        // Home
        'home' => ['Dex','Super Admin','Admin','Root','HRM','Data','Viewer'],

        // Adjunct Faculty
        'adj_jobs'   => ['Dex','Super Admin','Admin','HRM','Data'],
        'adj_apps'   => ['Dex','Super Admin','Admin','HRM','Data'],
        'adj_users'  => ['Dex','Super Admin'],

        // Internal Applications
        'int_applicants' => ['Dex','Super Admin','Admin'],
        'int_applied'    => ['Dex','Super Admin','Admin','HRM','Data'],
        'int_jobs'       => ['Dex','Super Admin','Admin','HRM','Data'],
        'int_qualified'  => ['Dex','Super Admin','Admin','HRM'],
        'int_not_qual'   => ['Dex','Super Admin','Admin','HRM'],

        // External Applications
        'ext_users' => ['Dex','Super Admin','Admin'],
        'ext_jobs'  => ['Dex','Super Admin','Admin','HRM','Data'],
        'ext_apps'  => ['Dex','Super Admin','Admin','HRM','Data'],

        // Account Management
        'admins' => ['Dex','Super Admin','Admin'],
        'pro_bodies' => ['Dex','Super Admin'],

        // Profile
        'profile_view' => ['Dex','Super Admin','Admin','Root','HRM','Data','Viewer'],
        'profile_edit' => ['Dex','Super Admin','Admin','Root','HRM','Data','Viewer'],
    ];
@endphp
		<div class="primary-menu">
           <nav class="navbar navbar-expand-lg align-items-center">
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
<div class="offcanvas-body">

<ul class="navbar-nav align-items-center flex-grow-1">

{{-- ================= HOME ================= --}}
@if(in_array($role, $can['home']))
<li class="nav-item">
    <a class="nav-link" href="/admin/dashboard">
        <i class='bx bx-home-alt'></i> Home
    </a>
</li>
@endif


{{-- ============ ADJUNCT FACULTY JOBS ============ --}}
@if(
    in_array($role, $can['adj_jobs']) ||
    in_array($role, $can['adj_apps']) ||
    in_array($role, $can['adj_users'])
)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <i class='bx bx-cube'></i> Adjunct Faculty Jobs
    </a>
    <ul class="dropdown-menu">

        @if(in_array($role, $can['adj_jobs']))
        <li><a class="dropdown-item" href="/List_of_jobs_advatised_ext">Advertised Jobs</a></li>
        @endif

        @if(in_array($role, $can['adj_apps']))
        <li><a class="dropdown-item" href="/Adjunct_Faculty_applications">Applications</a></li>
        @endif

        @if(in_array($role, $can['adj_users']))
        <li><a class="dropdown-item" href="/Adjunct_Faculty">Adjunct Users</a></li>
        @endif

    </ul>
</li>
@endif


{{-- ============ INTERNAL APPLICATIONS ============ --}}
@if(
    in_array($role, $can['int_applicants']) ||
    in_array($role, $can['int_applied']) ||
    in_array($role, $can['int_jobs']) ||
    in_array($role, $can['int_qualified']) ||
    in_array($role, $can['int_not_qual'])
)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <i class='bx bx-cube'></i> Internal Applications
    </a>
    <ul class="dropdown-menu">

        @if(in_array($role, $can['int_applicants']))
        <li><a class="dropdown-item" href="/All_the_staff_to_apply">Applicants Data</a></li>
        @endif

        @if(in_array($role, $can['int_applied']))
        <li><a class="dropdown-item" href="/Jobs_applied_to">Jobs Applied To</a></li>
        @endif

        @if(in_array($role, $can['int_jobs']))
        <li><a class="dropdown-item" href="/List_of_jobs_advatised">Jobs Advertised</a></li>
        @endif

        @if(in_array($role, $can['int_qualified']))
        <li><a class="dropdown-item" href="/Qualified_Canidates">Qualified Candidates</a></li>
        @endif

        @if(in_array($role, $can['int_not_qual']))
        <li><a class="dropdown-item" href="/NotQualified_Canidates">Not Qualified Candidates</a></li>
        @endif

    </ul>
</li>
@endif


{{-- ============ EXTERNAL APPLICATIONS ============ --}}
@if(
    in_array($role, $can['ext_users']) ||
    in_array($role, $can['ext_jobs']) ||
    in_array($role, $can['ext_apps'])
)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <i class='bx bx-user-circle'></i> External Applications
    </a>
    <ul class="dropdown-menu">

        @if(in_array($role, $can['ext_users']))
        <li><a class="dropdown-item" href="/External_Users">External Users</a></li>
        @endif

        @if(in_array($role, $can['ext_jobs']))
        <li><a class="dropdown-item" href="/List_of_jobs_External">Advertised External Jobs</a></li>
        @endif

        @if(in_array($role, $can['ext_apps']))
        <li><a class="dropdown-item" href="/External_applications">External Applications</a></li>
        @endif

    </ul>
</li>
@endif


{{-- ============ ACCOUNT MANAGEMENT ============ --}}
@if(
    in_array($role, $can['admins']) ||
    in_array($role, $can['pro_bodies'])
)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <i class='bx bx-lock'></i> Account Management
    </a>
    <ul class="dropdown-menu">

        @if(in_array($role, $can['admins']))
        <li><a class="dropdown-item" href="/Datatable/admin">Admins Data</a></li>
        @endif

        @if(in_array($role, $can['pro_bodies']))
        <li><a class="dropdown-item" href="/Upload_profesionalbodies">Upload Professional Bodies</a></li>
        @endif

    </ul>
</li>
@endif


{{-- ================= PROFILE ================= --}}
@if(
    in_array($role, $can['profile_view']) ||
    in_array($role, $can['profile_edit'])
)
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <i class='bx bx-user'></i> Profile
    </a>
    <ul class="dropdown-menu">

        @if(in_array($role, $can['profile_view']))
        <li><a class="dropdown-item" href="/admin/profile">My Profile</a></li>
        @endif

        @if(in_array($role, $can['profile_edit']))
        <li><a class="dropdown-item" href="/admin/profile/edit">Update Profile</a></li>
        @endif

    </ul>
</li>
@endif


{{-- ================= LOGOUT ================= --}}
<li class="nav-item">
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="btn btn-danger px-4">
            <i class="bx bx-log-out-circle"></i> Logout
        </button>
    </form>
</li>

</ul>
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
  