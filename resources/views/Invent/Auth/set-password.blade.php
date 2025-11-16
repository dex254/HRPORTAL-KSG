<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Set New Password | KSG Innovations Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="KSG Innovations Portal" name="description" />
    <meta content="KSG" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-dark.png') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="h-100">

    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-4 mb-0">
                    <a href="{{ route('invent') }}" class="auth-brand mb-3">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo" height="24" class="logo-dark">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo light" height="24" class="logo-light">
                    </a>

                    <h4 class="fw-semibold mb-2">Set Your New Password</h4>
                    <p class="text-muted mb-4">Please choose a strong password for your Innovations account.</p>

                    <form action="{{ route('invent.password.update') }}" method="POST" class="text-start mb-3">
                        @csrf
                        <input type="hidden" name="reset_token" value="{{ $invent->reset_token }}">

                        <div class="mb-3 position-relative">
                            <label class="form-label" for="password">New Password</label>
                            <div class="input-group password-wrapper">
                                <input type="password" id="password" name="password" class="form-control password-input" placeholder="Enter new password" oninput="checkPasswordStrength()">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <small id="password-strength" class="text-muted mt-1 d-block">Use at least 8 characters including uppercase, lowercase, number, and symbol.</small>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <div class="input-group password-wrapper">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control password-input" placeholder="Confirm new password">
                                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Reset Password</button>
                        </div>
                    </form>

                    <p class="text-center mt-3">
                        <a href="{{ route('invent') }}" class="fw-semibold text-dark">Back to Login</a>
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
                            title: 'Error',
                            text: '{{ session('error') }}',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'Try Again'
                        });
                        </script>
                    @endif

                    <p class="mt-auto mb-0 text-muted text-center">
                        © {{ date('Y') }} Kenya School of Government (KSG) — Innovations Portal
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });

    // Check password strength
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthText = document.getElementById('password-strength');
        let strength = 'Weak';
        let color = 'red';

        const regexes = [
            /[A-Z]/,  // Uppercase
            /[a-z]/,  // Lowercase
            /[0-9]/,  // Number
            /[@$!%*?&#]/ // Symbol
        ];
        let passed = regexes.reduce((acc, regex) => acc + regex.test(password), 0);

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
