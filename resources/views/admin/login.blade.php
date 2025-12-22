<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Login | KSG AI Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin dashboard login for Kenya School of Government" name="description" />
    <meta content="KSG" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('') }}DEXA/assets/images/logo-dark.png">

    <!-- Theme Config Js -->
    <script src="{{asset('') }}DEXA/assets/js/config.js"></script>

    <!-- Vendor css -->
    <link href="{{asset('') }}DEXA/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('') }}DEXA/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('') }}DEXA/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">

                    <!-- LOGO -->
                    <a href="#" class="auth-brand mb-3">
                        <img src="{{asset('') }}DEXA/assets/images/logo-dark.png" alt="dark logo" height="30" class="logo-dark">
                        <img src="{{asset('') }}DEXA/assets/images/logo.png" alt="logo light" height="30" class="logo-light">
                    </a>

                    <!-- TITLE -->
                    <h4 class="fw-semibold mb-2">Admin Login</h4>
                    <p class="text-muted mb-4">Enter your credentials to access the admin dashboard.</p>

                    <!-- LOGIN FORM -->
                    <form method="POST" action="{{ route('admin') }}" class="text-start mb-3">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label" for="admin-email">Email</label>
                            <input
                                type="email"
                                id="admin-email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter admin email"
                                required
                            >
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Password + Eye Toggle --}}
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

                        <div class="mb-3 position-relative">
                            <label class="form-label" for="admin-password">Password</label>

                            <div class="input-group password-wrapper" data-target="admin-password">
                                <input
                                    type="password"
                                    id="admin-password"
                                    name="password"
                                    class="form-control password-input"
                                    placeholder="Enter password"
                                    autocomplete="current-password"
                                >
                                <button type="button" class="btn btn-outline-secondary toggle-password" aria-label="Show password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Password Animation Styles -->
                        <style>
                            .password-wrapper { display:flex; align-items:center; position:relative; }
                            .password-input {
                                transition: opacity 180ms ease, transform 220ms ease, box-shadow 220ms ease;
                            }
                            .password-wrapper.animating .password-input {
                                opacity:0; transform:translateY(-4px) scale(0.997); box-shadow:0 6px 18px rgba(0,0,0,0.06);
                            }
                            .password-wrapper.active .password-input {
                                box-shadow:0 6px 18px rgba(0,204,102,0.12);
                            }
                            .toggle-password {
                                border-top-left-radius:0; border-bottom-left-radius:0;
                                width:44px; height:44px;
                                display:flex; align-items:center; justify-content:center;
                                transition:all 220ms ease;
                            }
                            .password-wrapper.active .toggle-password {
                                transform:scale(1.06); background:#004d00; color:#fff;
                            }
                            .toggle-password i { transition:transform 300ms ease; }
                            .password-wrapper.active .toggle-password i { transform:rotateY(180deg); }
                        </style>

                        <!-- Password Toggle Script -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const wrappers = document.querySelectorAll('.password-wrapper');
                                wrappers.forEach(wrapper => {
                                    const btn = wrapper.querySelector('.toggle-password');
                                    const input = wrapper.querySelector('.password-input');
                                    const icon = btn.querySelector('i');

                                    btn.addEventListener('click', function () {
                                        if (wrapper.classList.contains('animating')) return;
                                        wrapper.classList.add('animating');

                                        setTimeout(() => {
                                            if (input.type === 'password') {
                                                input.type = 'text';
                                                wrapper.classList.add('active');
                                                icon.classList.replace('fa-eye', 'fa-eye-slash');
                                            } else {
                                                input.type = 'password';
                                                wrapper.classList.remove('active');
                                                icon.classList.replace('fa-eye-slash', 'fa-eye');
                                            }

                                            setTimeout(() => {
                                                wrapper.classList.remove('animating');
                                                input.focus();
                                                const value = input.value;
                                                input.value = '';
                                                input.value = value;
                                            }, 180);
                                        }, 180);
                                    });
                                });
                            });
                        </script>

                        {{-- Forgot Password --}}
                        <div class="d-flex justify-content-between mb-3">
                            <div></div>
                            <a href="{{ route('admin.forgot.password') }}" class="text-muted border-bottom border-dashed">
                                Forgot Password?
                            </a>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>

                    <!-- SweetAlert -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    @if(session('success'))
                    <script>
                        Swal.fire({ icon: 'success', title: 'Success', text: '{{ session('success') }}' });
                    </script>
                    @endif

                    @if(session('error'))
                    <script>
                        Swal.fire({ icon: 'error', title: 'Login Failed', text: '{{ session('error') }}' });
                    </script>
                    @endif

                    @if ($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Validation Error',
                            html: `{!! implode('<br>', $errors->all()) !!}`
                        });
                    </script>
                    @endif

                    <p class="mt-auto mb-0 text-muted">
    <script>document.write(new Date().getFullYear())</script> © Dexa –
    <span class="developer-name"
          data-hover="Denis Kiplagat">
        Developed by KSG Software Engineering Team
    </span>
</p>

                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('') }}DEXA/assets/js/vendor.min.js"></script>
    <script src="{{asset('') }}DEXA/assets/js/app.js"></script>

</body>
</html>
