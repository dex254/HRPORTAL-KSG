<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Verify OTP - KSG AI Training</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="KSG AI OTP Verification Page" name="description" />
    <meta content="KSG" name="author" />

    <link rel="shortcut icon" href="{{asset('') }}assets/images/logo-dark.png">

    <!-- Theme Config Js -->
    <script src="{{asset('') }}assets/js/config.js"></script>

    <!-- Vendor css -->
    <link href="{{asset('') }}assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('') }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="auth-bg d-flex min-vh-100 justify-content-center align-items-center">
    <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
        <div class="col-xl-4 col-lg-5 col-md-6">
            <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0">
                <a href="#" class="auth-brand mb-3">
                    <img src="{{asset('') }}assets/images/logo-dark.png" alt="dark logo" height="35" class="logo-dark">
                    <img src="{{asset('') }}assets/images/logo.png" alt="logo light" height="35" class="logo-light">
                </a>

                <h4 class="fw-semibold mb-2">OTP Verification</h4>
                <p class="text-muted mb-4">Enter the 6-digit code sent to your email.</p>

                <!-- ✅ OTP Verification Form -->
<form method="POST" action="{{ route('invent.otp.verify') }}" class="text-start mb-3" id="otpForm">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="otp" id="otpInput"> <!-- Combined OTP -->

    <div class="mb-4 text-center">
        <label for="otp" class="form-label fw-semibold">Enter OTP Code</label>
        <div class="otp-inputs d-flex justify-content-center gap-2 mt-2">
            <input type="text" maxlength="1" class="otp-box" autofocus>
            <input type="text" maxlength="1" class="otp-box">
            <input type="text" maxlength="1" class="otp-box">
            <input type="text" maxlength="1" class="otp-box">
            <input type="text" maxlength="1" class="otp-box">
            <input type="text" maxlength="1" class="otp-box">
        </div>
        @error('otp')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-success">Verify OTP</button>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('invent.resend.otp', ['email' => $email]) }}" class="text-muted border-bottom border-dashed">Resend OTP</a>
    </div>
</form>

<!-- JS to combine OTP inputs -->
<script>
document.getElementById('otpForm').addEventListener('submit', function(e) {
    const otpBoxes = document.querySelectorAll('.otp-box');
    let otp = '';
    otpBoxes.forEach(box => {
        otp += box.value;
    });
    document.getElementById('otpInput').value = otp;
});
</script>


                <!-- SweetAlert Notifications -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#00cc66',
                    });
                </script>
                @endif

                @if(session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Verification Failed',
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

                <p class="mt-auto mb-0">
                    <script>document.write(new Date().getFullYear())</script> © KSG - Powered by 
                    <span class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Dexasolutions.ltd</span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- ✅ Custom OTP Styling -->
<style>
.otp-inputs {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.otp-box {
    width: 50px;
    height: 50px;
    font-size: 22px;
    text-align: center;
    border: 2px solid #00cc66;
    border-radius: 8px;
    transition: all 0.3s ease;
    color: #004d00;
    font-weight: bold;
    background-color: #f8fff8;
}

.otp-box:focus {
    outline: none;
    border-color: #004d00;
    box-shadow: 0 0 12px #39ff14;
}

.btn-success {
    background-color: #004d00 !important;
    border-color: #004d00 !important;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background-color: #39ff14 !important;
    color: #1b1b1b !important;
}

/* For smaller devices */
@media (max-width: 576px) {
    .otp-box {
        width: 42px;
        height: 45px;
        font-size: 18px;
    }
}
</style>

<!-- ✅ OTP Auto-focus Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.otp-box');
    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
});
</script>

<!-- Vendor js -->
<script src="{{asset('') }}assets/js/vendor.min.js"></script>
<script src="{{asset('') }}assets/js/app.js"></script>

</body>
</html>
