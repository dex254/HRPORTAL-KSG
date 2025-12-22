<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Set New Password | KSG Admin Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="KSG Admin Portal" name="description" />
    <meta content="KSG" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('DEXA/assets/images/logo-dark.png') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('DEXA/assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('DEXA/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('DEXA/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('DEXA/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="h-100">

    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-4 mb-0">
                    
                    <a href="{{ route('admin') }}" class="auth-brand mb-3">
                        <img src="{{ asset('DEXA/assets/images/logo-dark.png') }}" alt="dark logo" height="24">
                    </a>

                    <h4 class="fw-semibold mb-2">Set Your Admin Password</h4>

                    <p class="text-muted mb-2">
                        This is a <strong>protected administrator dashboard</strong>.  
                        For security, you must set a strong password to continue.
                    </p>

                    <p class="text-danger fw-semibold mb-4">
                        Use a strong password containing uppercase, lowercase, numbers, and symbols.
                    </p>

                    <form action="{{ route('admin.password.update') }}" method="POST" class="text-start mb-3">
                        @csrf
                        <input type="hidden" name="reset_token" value="{{ $admin->reset_token }}">

                        <!-- New Password -->
                        <div class="mb-3 position-relative">
                            <label class="form-label" for="password">New Password</label>
                            <div class="input-group password-wrapper">
                                <input type="password" id="password" name="password" class="form-control password-input"
                                       placeholder="Enter new admin password" oninput="checkPasswordStrength()">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <small id="password-strength" class="text-muted mt-1 d-block">
                                Must be 8+ characters long and very secure.
                            </small>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3 position-relative">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <div class="input-group password-wrapper">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control password-input" placeholder="Confirm your new password">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Reset Admin Password</button>
                        </div>
                    </form>

                    <p class="text-center mt-3">
                        <a href="{{ route('admin') }}" class="fw-semibold text-dark">Back to Admin Login</a>
                    </p>

                    <!-- Alerts -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            confirmButtonColor: '#3085d6'
                        });
                    </script>
                    @endif

                    @if(session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ session('error') }}',
                            confirmButtonColor: '#d33'
                        });
                    </script>
                    @endif

                    <p class="mt-auto mb-0 text-muted text-center">
                        © {{ date('Y') }} Kenya School of Government (KSG) — Admin Portal
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('DEXA/assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('DEXA/assets/js/app.js') }}"></script>

    <script>
    // Toggle Password
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const target = document.getElementById(this.dataset.target);
                const icon = this.querySelector('i');

                if (target.type === 'password') {
                    target.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    target.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });
    });

    // Password Strength Check
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthText = document.getElementById('password-strength');
        let strength = 'Weak';
        let color = 'red';

        const checks = [
            /[A-Z]/,
            /[a-z]/,
            /[0-9]/,
            /[@$!%*?&#]/
        ];

        const passed = checks.filter(regex => regex.test(password)).length;

        if (password.length >= 8 && passed === 4) {
            strength = 'Strong';
            color = 'green';
        } else if (password.length >= 6 && passed >= 2) {
            strength = 'Medium';
            color = 'orange';
        }

        strengthText.innerText = `Password Strength: ${strength}`;
        strengthText.style.color = color;
    }
    </script>

</body>

</html>
