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
        <h4 class="mb-4 text-center class"   style="color: #CD853F;">Reset Password</h4>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
    </div>
    @endif

        <form  action="{{ route('HRPU.set.password') }}" method="POST">
            @csrf
 <input type="hidden" name="reset_token" value="{{ $hrpu->reset_token }}">
           

        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input id="new_password" type="password" class="form-control" name="new_password" required autofocus>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
        </div>
            <div class="d-grid">
                <button type="submit" class="btn rounded-3 py-2" style="background-color: #CD853F; color: white;">Send Password Reset</button>
            </div>
        </form>
        <div class="text-center mt-4">
            <p class="mb-0">Login? <a href="{{ route('HRPU.Login') }}" class="text-decoration-none"style="color: #CD853F;">Login here</a></p>
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
