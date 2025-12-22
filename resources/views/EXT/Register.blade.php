<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('') }}dex/images/KSG Logo (1).png" type="image/png" />
    <!--plugins-->
    <link href="{{asset('') }}dex/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{asset('') }}dex/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{asset('') }}dex/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('') }}dex/css/pace.min.css" rel="stylesheet" />
    <script src="{{asset('') }}dex/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('') }}dex/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('') }}dex/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{asset('') }}dex/css/app.css" rel="stylesheet">
    <link href="{{asset('') }}dex/css/icons.css" rel="stylesheet">
    <title>KSG Career Portal</title>
    <body>
   <style>
    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #f4f6f8; /* Optional: subtle background for contrast */
    }

    .center-screen {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .custom-login-card {
        background-color: white;
        border: none;
        border-radius: 20px;
        box-shadow: 0 0 30px rgba(199, 162, 15, 0.3); /* Soft green shadow */
        width: 100%;
        max-width: 900px;
    }

    .badge.bg-primary {
        background-color: #4CAF50 !important; /* Green for step badges */
    }

    .btn-primary {
        background-color: #4CAF50;
        border: none;
    }

    .btn-primary:hover {
        background-color: #43a047;
    }

    .text-primary {
        color: #4CAF50 !important;
    }

    .bg-primary {
        background-color: #4CAF50 !important;
    }

    .bg-opacity-10 {
        background-color: rgba(76, 175, 80, 0.1) !important;
    }
</style>
 {{-- Success or Status Popup --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SUCCESS MESSAGE --}}
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

{{-- ERROR MESSAGE --}}
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

{{-- INFO / GENERAL MESSAGE --}}
@if(session('message') || session('info'))
<script>
Swal.fire({
    icon: 'info',
    title: 'Notice',
    text: '{{ session('message') ?? session('info') }}',
    confirmButtonColor: '#3085d6',
});
</script>
@endif

{{-- WARNING MESSAGE --}}
@if(session('warning'))
<script>
Swal.fire({
    icon: 'warning',
    title: 'Warning',
    text: '{{ session('warning') }}',
    confirmButtonColor: '#f39c12',
});
</script>
@endif

{{-- VALIDATION ERRORS --}}
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

<div class="center-screen">
    
    <div class="card custom-login-card m-3">
        <div class="row g-0">
            <!-- Left Side - Login Form -->
            <div class="col-md-6 p-4 p-sm-5">
                
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/images/KSG Logo (1).png') }}" alt="KSG Logo" style="height: 100px;">
                        </div>
                       
                        <p class="text-muted"  style="color: #CD853F;">Register</p>
                    </div>

                    <form class="row g-3" action="{{ route('EXT.User') }}" method="POST">
                        @csrf
                        <div class="col-12 position-relative">
                           
                            <label for="inputEmailAddress" class="form-label ms-4">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-3 ps-4" id="inputEmailAddress" placeholder="user@example.com"  value="{{ old('email') }}">
                            
                        </div>

                        <!-- Password -->
                        <!-- Password Field -->
<div class="col-12 position-relative mb-3">
    <label for="password" class="form-label ms-4">Password</label>
    <div class="input-group rounded-3">
        <input type="password" name="password" class="form-control border-end-0 rounded-start-3 ps-4" id="password" placeholder="Enter Password">
        <span class="input-group-text bg-transparent rounded-end-3 toggle-password" data-target="password" style="cursor: pointer;">
            <i class="bx bx-hide transition-icon"></i>
        </span>
    </div>
</div>

<!-- Confirm Password Field -->
<div class="col-12 position-relative mb-3">
    <label for="password_confirmation" class="form-label ms-4">Confirm Password</label>
    <div class="input-group rounded-3">
        <input type="password" name="password_confirmation" class="form-control border-end-0 rounded-start-3 ps-4" id="password_confirmation" placeholder="Confirm Password">
        <span class="input-group-text bg-transparent rounded-end-3 toggle-password" data-target="password_confirmation" style="cursor: pointer;">
            <i class="bx bx-hide transition-icon"></i>
        </span>
    </div>
</div>
<style>
.transition-icon {
    transition: transform 0.3s ease;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.toggle-password');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            } else {
                input.type = 'password';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            }

            icon.classList.add('transition-icon');
        });
    });
});
</script>

                        <!-- Remember Me -->
                        <div class="col-12 position-relative">
                           
                            <div class="d-flex justify-content-between align-items-center ps-4">
                                <div class="form-check form-switch">
                                   
                                </div>
                                <a href="/Password" class="text-decoration-none"style="color: #CD853F;">Forgot Password?</a>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="col-12 position-relative">
                            
                            <div class="d-grid ps-4">
                                <button type="submit" class="btn rounded-3 py-2" style="background-color: #CD853F; color: white;">Sign In</button>
                            </div>
                            
                        </div>
                    </form>

                    <div class="text-center mt-4">
                       <p class="mb-0">
    Don't have an account? 
    <a href="{{ route('EXT.Login') }}" class="text-muted">
         Sign in.
    </a>
</p>

                    </div>
                </div>
            </div>

            <!-- Right Side - Info Panel -->
            <div class="col-md-6 d-none d-md-block bg-primary bg-opacity-10 rounded-end-4">
                <div class="d-flex flex-column justify-content-center h-100 p-4 p-sm-5">
                    <div class="text-center mb-4">
                        <img href="{{asset('') }}assets/images/KSG Logo (1).png" type="image/png"  class="img-fluid mb-3" style="max-width: 180px;">
                        <h4 class="text-decoration-none"  style="color: #CD853F;">Kenya  School  of Government </h4>
                        <h4 class="text-decoration-none"  style="color: #CD853F;">Welcome Back!</h4>
                        <p class="text-muted">Manage  your dashboard with ease</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3"  style="color: #CD853F">Quick  Tips:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bx bx-check-circle text-primary me-2"></i> Use strong passwords</li>
                            <li class="mb-2"><i class="bx bx-check-circle text-primary me-2"></i> Keep your credentials secure</li>
                            <li class="mb-2"><i class="bx bx-check-circle text-primary me-2"></i> Log out after each session</li>
                        </ul>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{asset('') }}dex/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{asset('') }}dex/js/jquery.min.js"></script>
</body>

</html>