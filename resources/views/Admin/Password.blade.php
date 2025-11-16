<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Reset Password | KSG AI Innovations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Innovation management system" name="description" />
    <meta content="KSG AI" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-dark.png') }}">

    <!-- Vendor css -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="h-100">

    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-3 m-xxl-5 px-xxl-4">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-3 p-xxl-4 mb-0 shadow-sm">

                    <a href="{{ route('Admin.Dashboard') }}" class="auth-brand mb-3">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo" height="24" class="logo-dark">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo light" height="24" class="logo-light">
                    </a>

                    <h4 class="fw-semibold mb-2">Admin Password Reset</h4>
                    <p class="text-muted mb-4">Enter your admin email to receive a password reset link.</p>

                    <!-- ADMIN PASSWORD RESET FORM -->
                    <form action="{{ route('admin.password.email') }}" method="POST" class="text-start mb-3">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Admin Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your admin email" required>
                        </div>

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary">Send Reset Link</button>
                        </div>
                    </form>

                    <p class="text-muted fs-14 mb-4">
                        Remember your password?
                        <a href="{{ route('admin') }}" class="fw-semibold text-dark ms-1">Login here</a>
                    </p>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    @if(session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '{{ session('success') }}',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif

                    @if(session('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: '{{ session('error') }}',
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'Try Again'
                            });
                        </script>
                    @endif

                    <p class="mt-auto mb-0 text-muted">
                        <script>document.write(new Date().getFullYear())</script> © Dexa - By
                        <span class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Dexasolutions.ltd</span>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
