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
        <div class="sidenav-menu"  hidden="true">

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
                <i class="ti ti-circle align-middle"></i>
            </button>

            <!-- Full Sidebar Menu Close Button -->
            <button class="button-close-fullsidebar">
                <i class="ti ti-x align-middle"></i>
            </button>

            <div data-simplebar>

                <!--- Sidenav Menu -->
                <ul class="side-nav">

                    <li class="side-nav-item">
                        <a href="/home" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                            <span class="menu-text"> Dashboard </span>
                            <span class="badge bg-success rounded-pill">5</span>
                        </a>
                    </li>

                    <li class="side-nav-title mt-2">Profile</li>

                    <li class="side-nav-item">
                        <a href="/pay" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-message-filled"></i></span>
                            <span class="menu-text"> Update Profile</span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="/Whats_app" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-calendar-filled"></i></span>
                            <span class="menu-text"> Password  Reset</span>
                        </a>
                    </li>

                   

                    

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="layouts-hover.html#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-basket-filled"></i></span>
                            <span class="menu-text"> Programs </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="/Programs_to_ai" class="side-nav-link">
                                        <span class="menu-text">Programs</span>
                                    </a>
                                </li>
                                
                                
                                
                               
                                
                               
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="layouts-hover.html#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-file-invoice"></i></span>
                            <span class="menu-text"> Admins</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarInvoice">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a href="apps-invoices.html" class="side-nav-link">
                                        <span class="menu-text">All  Users</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="apps-invoice-details.html" class="side-nav-link">
                                        <span class="menu-text">Role Management</span>
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
                   

                    <!-- Horizontal Menu Toggle Button -->
                 

                    <!-- Button Trigger Search Modal -->
                  

                    <!-- Mega Menu Dropdown -->
                    
                </div>

                <div class="d-flex align-items-center gap-2">

                    <!-- Search for small devices -->
                   

                    <!-- Language Dropdown -->
                    

                    <!-- Notification Dropdown -->
                   

                    <!-- Apps Dropdown -->
                   

                    <!-- Button Trigger Customizer Offcanvas -->
                    
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
                                <img src="{{ Auth::guard('invent')->user()->profile ? asset(Auth::guard('invent')->user()->profile) : asset('assets/images/default-profile.png') }}" width="24" class="rounded-circle me-lg-2 d-flex" alt="user-image">
                                <span class="d-lg-flex flex-column gap-1 d-none">
                                    {{ Auth::guard('invent')->user()->name}}
                                </span>
                                <i class="ti ti-chevron-down d-none d-lg-block align-middle ms-2"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ti ti-user-hexagon me-1 fs-17 align-middle"></i>
                                    <span class="align-middle">My Account</span>
                                </a>

                                
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item fw-semibold text-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
  <i class="ti ti-settings me-1 fs-17 align-middle"></i>
  <span class="align-middle">Change Password</span>
</a>

                               
                                <div class="dropdown-divider"></div>

                              
                              <form id="logout-form" action="{{ route('invent.logout') }}" method="POST" class="d-none">
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
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title" id="changePasswordLabel">
          <i class="ti ti-lock me-2"></i>Change Password
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="changePasswordForm">
        @csrf
        <div class="modal-body p-4">

          <!-- Alert Messages -->
          <div id="passwordAlert" class="alert d-none"></div>

          <!-- Current Password -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Current Password</label>
            <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
          </div>

          <!-- Security Key -->
          <div class="mb-3">
           
            <input  type="hidden" name="securitykey" value="{{ Auth::guard('invent')->user()->securitykey }}" required>
          </div>

          <!-- New Password -->
          <div class="mb-3">
            <label class="form-label fw-semibold">New Password</label>
            <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
          </div>

          <!-- Confirm New Password -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm new password" required>
          </div>

        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="ti ti-refresh me-1"></i> Update Password
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

  $('#changePasswordForm').on('submit', function (e) {
    e.preventDefault();

    let form = $(this);
    let alertBox = $('#passwordAlert');
    alertBox.removeClass('alert-danger alert-success').addClass('d-none').text('');

    $.ajax({
      url: "{{ route('invent.updatePassword') }}",
      method: "POST",
      data: form.serialize(),
      beforeSend: function() {
        form.find('button[type=submit]').prop('disabled', true).html('<i class="ti ti-loader me-1"></i> Processing...');
      },
      success: function(response) {
        if (response.status === 'success') {
          alertBox.removeClass('d-none').addClass('alert alert-success').text(response.message);
          setTimeout(() => {
            window.location.href = "{{ route('invent') }}"; // Redirect to login page
          }, 2000);
        } else {
          alertBox.removeClass('d-none').addClass('alert alert-danger').text(response.message);
        }
      },
      error: function(xhr) {
        form.find('button[type=submit]').prop('disabled', false).html('<i class="ti ti-refresh me-1"></i> Update Password');
        if (xhr.responseJSON && xhr.responseJSON.message) {
          alertBox.removeClass('d-none').addClass('alert alert-danger').text(xhr.responseJSON.message);
        } else {
          alertBox.removeClass('d-none').addClass('alert alert-danger').text('Something went wrong. Please try again.');
        }
      },
      complete: function() {
        form.find('button[type=submit]').prop('disabled', false).html('<i class="ti ti-refresh me-1"></i> Update Password');
      }
    });
  });

});
</script>

<style>
.modal-content {
  border-radius: 1rem;
}
.form-control:focus {
  border-color: #007bff;
  box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}
#passwordAlert {
  transition: all 0.3s ease-in-out;
}
</style>




        <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-transparent">
                    <div class="card mb-0 shadow-none">
                        <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                            <i class="ti ti-search fs-22"></i>
                            <input type="search" class="form-control border-0" id="search-modal-input" placeholder="Search for actions, people,">
                            <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            {{-- resources/views/components/horizontal-tabs.blade.php --}}
@php
    use Illuminate\Support\Facades\Route;
    $currentRoute = Route::currentRouteName();
@endphp

<style>
/* Circular Step Tabs with Labels */
.step-tabs {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
}

.step-tab {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.step-tab .step {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 3px solid #8B4513; /* brown border */
    background-color: #fff; /* white inside */
    display: flex;
    align-items: center;
    justify-content: center;
    color: #8B4513;
    font-weight: bold;
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease;
}

.step-tab .step.active {
    box-shadow: 0 0 12px 4px rgba(57, 255, 20, 0.3); /* translucent neon green glow */
    border-color: #4CAF50; /* optional brighter border for active */
}

.step-tab span.label {
    margin-top: 6px;
    font-size: 0.875rem;
    text-align: center;
    color: #333;
    font-weight: 500;
}

.step-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}

.step-navigation .btn {
    min-width: 120px;
}
</style>

<div class="step-tabs">

    <div class="step-tab">
        <a href="{{ route('Invent.Dashboard') }}" class="step {{ $currentRoute === 'Invent.Dashboard' ? 'active' : '' }}">
            <span>🏠</span>
        </a>
        <span class="label">Home</span>
    </div>

    <div class="step-tab">
        <a href="{{ route('innovation.step1') }}" class="step {{ $currentRoute === 'innovation.step1' ? 'active' : '' }}">
            <span>1</span>
        </a>
        <span class="label">Problem</span>
    </div>

    <div class="step-tab">
        <a href="{{ route('innovation.step2') }}" class="step {{ $currentRoute === 'innovation.step2' ? 'active' : '' }}">
            <span>2</span>
        </a>
        <span class="label">Innovation</span>
    </div>

    <div class="step-tab">
        <a href="{{ route('innovation.step3') }}" class="step {{ $currentRoute === 'innovation.step3' ? 'active' : '' }}">
            <span>3</span>
        </a>
        <span class="label">Evidence</span>
    </div>

    <div class="step-tab">
        <a href="{{ route('innovation.step4') }}" class="step {{ $currentRoute === 'innovation.step4' ? 'active' : '' }}">
            <span>4</span>
        </a>
        <span class="label">Review</span>
    </div>

    <div class="step-tab">
        <a href="{{ route('innovation.my') }}" class="step {{ $currentRoute === 'innovation.my' ? 'active' : '' }}">
            <span>📋</span>
        </a>
        <span class="label">My Innovations</span>
    </div>

</div>

{{-- Navigation buttons --}}
<div class="step-navigation">
    @php
        $prevRoute = '';
        $nextRoute = '';
        switch($currentRoute) {
            case 'innovation.step1': $prevRoute = 'Invent.Dashboard'; $nextRoute = 'innovation.step2'; break;
            case 'innovation.step2': $prevRoute = 'innovation.step1'; $nextRoute = 'innovation.step3'; break;
            case 'innovation.step3': $prevRoute = 'innovation.step2'; $nextRoute = 'innovation.step4'; break;
            case 'innovation.step4': $prevRoute = 'innovation.step3'; $nextRoute = 'innovation.my'; break;
            default: $prevRoute = 'Invent.Dashboard'; $nextRoute = 'innovation.step1';
        }
    @endphp

    <a href="{{ route($prevRoute) }}" class="btn btn-outline-secondary">⬅ Back</a>
    <a href="{{ route($nextRoute) }}" class="btn btn-success">Next ➡</a>
</div>
