<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/KSG Logo (1).png') }}" type="image/png" />
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


<style>
    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #f4f6f8;
    }

    .center-screen {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .registration-card {
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 0 25px rgba(76, 175, 80, 0.3);
        padding: 40px;
        width: 100%;
        max-width: 600px;
        color: #000;
    }

    .btn-primary {
        background-color: #4CAF50;
        border: none;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    label {
        font-weight: 500;
    }

    .help-contact {
        margin-top: 20px;
        font-size: 14px;
        color: #555;
        text-align: center;
    }

    .help-contact strong {
        color: #000;
    }
</style>




<div class="center-screen">
    <div class="registration-card">
        <div class="text-center mb-3">
            <img src="{{ asset('assets/images/KSG Logo (1).png') }}" alt="KSG Logo" style="height: 100px;">
        </div>
        <h4 class="mb-4 text-center class"   style="color: #CD853F;">Forgot Password</h4>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form action="{{ route('EXT.reset') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">Enter Your Email</label>
                <input type="email" name="email" class="form-control" required placeholder="yourname@example.com">
            </div>
            @error('email')
            <div class="error-message" style="color: red;">{{ $message }}</div>
        @enderror
            <div class="d-grid">
                <button type="submit" class="btn rounded-3 py-2" style="background-color: #CD853F; color: white;">Send Password Reset</button>
            </div>
        </form>
        <div class="text-center mt-4">
            <p class="mb-0">Login? <a href="{{ route('EXT.Login') }}" class="text-decoration-none"style="color: #CD853F;">Login here</a></p>
        </div>

        <div class="help-contact">
            <p>Need help?  <strong ><a href="mailto:complaints@ksg.ac.ke?subject=Help" class="mb-4 text-center" style="color: #CD853F;">
                complaints@ksg.ac.ke
            </a>
            
            </strong></p>
        </div>
    </div>
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