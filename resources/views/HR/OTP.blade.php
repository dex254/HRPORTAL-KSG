<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('')}}assets/images/KSG Logo (1).png" type="image/png" />

    <!-- Styles & Plugins -->
    <link href="{{asset('')}}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="{{asset('')}}assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{asset('')}}assets/js/pace.min.js"></script>

    <!-- Bootstrap & App CSS -->
    <link href="{{asset('')}}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('')}}assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{asset('')}}assets/css/app.css" rel="stylesheet">
    <link href="{{asset('')}}assets/css/icons.css" rel="stylesheet">

    <title>KSG Career Portal</title>

    <style>
        body {
            background-color: #ffffff;
            color: #000000;
        }

        .login-container {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0px 8px 16px rgba(0, 100, 0, 0.3);
            max-width: 500px;
            margin: 0 auto;
            border: 1px solid #e0e0e0;
        }

        .login-container .btn {
            background-color: #8B4513;
            color: #ffffff;
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            transition: 0.3s ease;
        }

        .login-container .btn:hover {
            background-color: #ffffff;
            color: #8B4513;
            border: 1px solid #8B4513;
        }

        .alert-success {
            background: yellow;
            color: black;
            border: 1px solid #ccc;
        }

        .alert-danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        label, h4, h5, a, .form-control, .text-danger {
            color: #000 !important;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
        }

        /* Assistant Button */
        #assistant-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #39FF14;
            color: #000;
            border-radius: 5px;
            padding: 10px 15px;
            z-index: 1000;
        }

        #assistant-button:hover {
            background-color: #2ecc71;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5">

            <div class="container">
                <div class="row">
                    <div class="col mx-auto">

                        <div class="login-container">
                            <div class="card-body p-4">

                                <div class="text-center mb-3">
                                    <img src="{{asset('')}}assets/images/KSG Logo (1).png" width="80" alt="KSG Logo">
                                    <h4 class="mt-2">KSG Career Portal</h4>
                                </div>

                                <!-- Success Message -->
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

                                <div class="text-center mb-4">
                                    <h4>Welcome Back!</h4>
                                </div>

                                <!-- OTP Login Form -->
                                <form action="{{ route('OTP') }}" method="POST" class="row g-3">
                                    @csrf
                                    <input type="hidden" name="upn_no" value="{{ session('upn_no') }}">

                                    <div class="col-12">
                                        <label class="form-label">Enter Temporary Password / OTP:</label>
                                        <input type="text" name="password" class="form-control" placeholder="Enter OTP">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn">Sign in</button>
                                        </div>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('HR.resendOtp') }}" class="mt-3 text-center">
                                    @csrf
                                    <button type="submit" class="btn btn-sm" style="background:#39FF14; color:#000; border:none;">
                                        Resend OTP
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{asset('')}}assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('')}}assets/js/jquery.min.js"></script>

</body>
</html>
