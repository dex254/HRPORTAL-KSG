<!DOCTYPE html>
<html lang="en" data-sidenav-size="sm-hover">

<head>
    <meta charset="utf-8" />
    <title>Adexa  solutions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('') }}assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="{{asset('') }}assets/js/config.js"></script>

    <!-- Vendor css -->
    <link href="{{asset('') }}assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('') }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables CSS -->
      <link href="{{ asset('datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('datatables/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">

    
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- Sidenav Menu Start -->
        <div class="sidenav-menu">

            <!-- Brand Logo -->
            <a href="index.html" class="logo">
                <span class="logo-light">
                    <span class="logo-lg"><img src="{{asset('') }}assets/images/logo-dark.png" alt="logo"></span>
                    <span class="logo-sm text-center"><img src="{{asset('') }}assets/images/logo-dark.png" alt="small logo"></span>
                </span>

                <span class="logo-dark">
                    <span class="logo-lg"><img src="{{asset('') }}assets/images/logo-dark.png" alt="dark logo"></span>
                    <span class="logo-sm text-center"><img src="{{asset('') }}assets/images/logo-dark.png" alt="small logo"></span>
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
             <button class="button-sm-hover">
               <iconify-icon icon="solar:bookmark-broken" class="fs-2"></iconify-icon>
            </button>

            <!-- Full Sidebar Menu Close Button -->
            <button class="button-close-fullsidebar">
                <i class="ti ti-x align-middle"></i>
            </button>

            <div data-simplebar>

                <!--- Sidenav Menu -->
                <ul class="side-nav">

                    <li class="side-nav-item">
                        <a href="/Dashboard" class="side-nav-link">
                            <span class="menu-icon">  <iconify-icon icon="solar:city-linear" class="fs-2"></iconify-icon> 
                            <span class="menu-text"> Dashboard </span>
                            <span class="badge bg-success rounded-pill">KSG</span>
                        </a>
                    </li>

                    <li class="side-nav-title mt-2">Data</li>

                    <li class="side-nav-item">
                        <a href="/Ctdrt" class="side-nav-link">
                            <span class="menu-icon"><iconify-icon icon="solar:checklist-broken" class="fs-2"></iconify-icon> </span>
                            <span class="menu-text"> Catch Them Doing the Right Thing</span>
                        </a>
                    </li>

                   
                     <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="layouts-hover.html#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice" class="side-nav-link">
                            <span class="menu-icon"><iconify-icon icon="solar:crop-bold-duotone" class="fs-2"></iconify-icon>    </span>
                            <span class="menu-text"> Innovations</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarInvoice">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="/Innovations" class="side-nav-link">
                                         <span class="menu-icon">    <iconify-icon icon="solar:chart-2-bold" class="fs-2"></iconify-icon> </span>
                                        <span class="menu-text">All Innovations</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="/admin_inventions" class="side-nav-link">
                                         <span class="menu-icon">    <iconify-icon icon="solar:backpack-broken" class="fs-2"></iconify-icon>   </span>
                                        <span class="menu-text">Innovaters</span>
                                    </a>
                                </li>
                                
                                <li class="side-nav-item">
                                    <a href="apps-invoice-create.html" class="side-nav-link">
                                        <span class="menu-text">Deactivate  Users</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                   

                    

                   
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="layouts-hover.html#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice" class="side-nav-link">
                            <span class="menu-icon"><iconify-icon icon="solar:bill-check-line-duotone" class="fs-2"></iconify-icon>    </span>
                            <span class="menu-text"> Admins</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarInvoice">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="/Admin_register" class="side-nav-link">
                                         <span class="menu-icon">  <iconify-icon icon="solar:add-circle-line-duotone" class="fs-2"></iconify-icon> </span>
                                        <span class="menu-text">Add Admins</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="/Admin_data" class="side-nav-link">
                                         <span class="menu-icon">  <iconify-icon icon="solar:chair-2-linear" class="fs-2"></iconify-icon> </span>
                                        <span class="menu-text">All  Users</span>
                                    </a>
                                </li>
                                
                                <li class="side-nav-item">
                                    <a href="apps-invoice-create.html" class="side-nav-link">
                                        <span class="menu-text">Deactivate  Users</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    

                    

                    

                    <li class="side-nav-title mt-2">Components</li>

                   

                  
                   

                   

                    

                   

                    

                    

                   

                   
                </ul>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Sidenav Menu End -->


        <!-- Topbar Start -->
        <header class="app-topbar">
            <div class="page-container topbar-menu">
                <div class="d-flex align-items-center gap-2">

                    <!-- Brand Logo -->
                    <a href="index.html" class="logo">
                        <span class="logo-light">
                            <span class="logo-lg"><img src="{{asset('') }}assets/images/logo.png" alt="logo"></span>
                            <span class="logo-sm"><img src="{{asset('') }}assets/images/logo-sm.png" alt="small logo"></span>
                        </span>

                        <span class="logo-dark">
                            <span class="logo-lg"><img src="{{asset('') }}assets/images/logo-dark.png" alt="dark logo"></span>
                            <span class="logo-sm"><img src="{{asset('') }}assets/images/logo-sm.png" alt="small logo"></span>
                        </span>
                    </a>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="sidenav-toggle-button btn btn-secondary btn-icon">
                        <i class="ti ti-menu-deep fs-24"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="topnav-toggle-button" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="ti ti-menu-deep fs-22"></i>
                    </button>

                    <!-- Button Trigger Search Modal -->
                  

                    <!-- Mega Menu Dropdown -->
                     <!-- end topbar-item -->
                </div>

                <div class="d-flex align-items-center gap-2">

                    <!-- Search for small devices -->
                    <div class="topbar-item d-flex d-xl-none">
                        <button class="topbar-link btn btn-outline-primary btn-icon" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                            <i class="ti ti-search fs-22"></i>
                        </button>
                    </div>

                    <!-- Language Dropdown -->
                    

                    <!-- Notification Dropdown -->
                   

                    <!-- Apps Dropdown -->
                   

                    <!-- Button Trigger Customizer Offcanvas -->
                    <div class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link btn btn-outline-primary btn-icon" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" type="button">
                            <iconify-icon icon="solar:accessibility-bold-duotone" class="fs-2"></iconify-icon> 
                        </button>
                    </div>

                    <!-- Light/Dark Mode Button -->
                   <div class="topbar-item d-none d-sm-flex">
                        <button class="topbar-link btn btn-outline-primary btn-icon" id="light-dark-mode" type="button">
                             <iconify-icon icon="solar:atom-bold-duotone" class="fs-2"></iconify-icon> 
                        </button>
                    </div>

                    <!-- User Dropdown -->
                    <div class="topbar-item">
                        <div class="dropdown">
                            <a class="topbar-link btn btn-outline-primary dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown" data-bs-offset="0,22" type="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ Auth::guard('admin')->user()->profile ? asset(Auth::guard('admin')->user()->profile) : asset('assets/images/default-profile.png') }}" width="24" class="rounded-circle me-lg-2 d-flex" alt="user-image">
                                <span class="d-lg-flex flex-column gap-1 d-none">
                                    {{ Auth::guard('admin')->user()->name}}
                                </span>
                                <i class="ti ti-chevron-down d-none d-lg-block align-middle ms-2"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <iconify-icon icon="solar:backspace-line-duotone" class="fs-2"></iconify-icon>
                                    <span class="align-middle">My Account</span>
                                </a>

                                
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item fw-semibold text-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
   <iconify-icon icon="solar:accessibility-bold-duotone" class="fs-2"></iconify-icon>     
  <span class="align-middle">Change Password</span>
</a>

                               
                                <div class="dropdown-divider"></div>

                              
                              <form id="logout-form" action="{{ route('Admin.logout') }}" method="POST" class="d-none">
    @csrf
</form>

<!-- ✅ Logout Button (Dropdown or Anywhere) -->
<a href="#" 
   class="dropdown-item fw-semibold text-danger d-flex align-items-center gap-2 py-2 px-3 logout-link"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

    <i class="ti ti-logout fs-18"></i>
    <span>Sign Out</span>
</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Topbar End -->

        <!-- Search Modal --><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '{{ session('success') }}',
    confirmButtonColor: '#3085d6',
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Login Failed',
    text: '{{ session('error') }}',
    confirmButtonColor: '#d33',
});
</script>
@endif

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
