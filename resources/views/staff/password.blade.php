<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('') }}assets/images/KSG Logo (1).png" type="image/png" />
	<!--plugins-->
	<link href="{{asset('') }}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('') }}assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{asset('') }}assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('') }}assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{asset('') }}assets/css/app.css" rel="stylesheet">
	<link href="{{asset('') }}assets/css/icons.css" rel="stylesheet">
	<title> Staff Sign In || KSG Laptop Request System</title>
</head>

<body class="bg-theme bg-theme12">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-cover">
			<div class="">
				<div class="row g-0">
					<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
							<div class="card-body">
                                 <img src="{{asset('') }}assets/images/login-images/forgot-password-cover.svg" class="img-fluid" width="600" alt=""/>
							</div>
						</div>
					</div>
					<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right bg-light align-items-center justify-content-center">
						<div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
							<div class="card-body p-sm-5">
								<div class="p-3">
                                    <!-- Success Message -->
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<!-- General Error Message (For form errors or custom validation errors) -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

									<div class="text-center">
										<img src="assets/images/icons/forgot-2.png" width="100" alt="" />
									</div>
									<h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
									<p class="text-muted">Enter your registered Email   to  reset  your password</p>
                                    <form action="{{ route('password.mail') }}" method="POST">
                                        @csrf
									<div class="my-4">
										<label class="form-label">Email</label>
										<input type="email" id="email" name="email" class="form-control" placeholder="user.example@ksg.ac.ke" />
									</div>
									<input type="hidden"  name="status" value="Reset" />
									<input type="hidden" id="current_datetime" name="created_at" value="">
									<script>
										document.addEventListener('DOMContentLoaded', function () {
											// Get the current date and time in ISO format
											var currentDateTime = new Date().toISOString();
											
											// Set the value of the hidden input to the current date and time
											document.getElementById('current_datetime').value = currentDateTime;
										});
										document.addEventListener('DOMContentLoaded', function () {
    // Get current date and time
    var now = new Date();

    // Format the date as YYYY-MM-DD HH:MM:SS
    var formattedDateTime = now.getFullYear() + '-' 
                            + ('0' + (now.getMonth() + 1)).slice(-2) + '-'
                            + ('0' + now.getDate()).slice(-2) + ' '
                            + ('0' + now.getHours()).slice(-2) + ':'
                            + ('0' + now.getMinutes()).slice(-2) + ':'
                            + ('0' + now.getSeconds()).slice(-2);

    // Set the value of the hidden field to the formatted date/time
    document.getElementById('current_datetime').value = formattedDateTime;
});
									</script>
									<div class="d-grid gap-2">
										<button type="submit" class="btn btn-white">Send</button>
										<a href="/"   class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to
											Login</a>
                                            
									</div>
                                    </form>
                                    
                                    
                                    
                                   
								</div>
                                <div class="col">
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=denis.kiplagat@ksg.ac.ke&su=Kindly%20take%20action%20on%20my%20account&body=Change%20my%20credentials%20to:%0AEmail:%20........%20........%20......%20%0APhone%20Number:%20.....%20.....%20......%20.....%20%0AID%20Number:%20........%20........%20......%20%0ADepartment%20KSG:%20.....%20.....%20......%20.....%20"><button type="button" class="btn btn-primary px-5">Send an email for any other changes to the account</button></a>
                                </div>
                                
                                 
                                
						</div>
					</div>

				</div>
				<!--end row-->
			</div>
		</div>
	</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">


</div>
<!--end switcher-->
<!-- Bootstrap JS -->
<script src="{{asset('') }}assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{asset('') }}assets/js/jquery.min.js"></script>
<!--Password show & hide js -->
<script>
$(document).ready(function () {
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
});
</script>


<script>
$(".switcher-btn").on("click", function() {
$(".switcher-wrapper").toggleClass("switcher-toggled")
}), $(".close-switcher").on("click", function() {
$(".switcher-wrapper").removeClass("switcher-toggled")
}),


$('#theme1').click(theme1);
$('#theme2').click(theme2);
$('#theme3').click(theme3);
$('#theme4').click(theme4);
$('#theme5').click(theme5);
$('#theme6').click(theme6);
$('#theme7').click(theme7);
$('#theme8').click(theme8);
$('#theme9').click(theme9);
$('#theme10').click(theme10);
$('#theme11').click(theme11);
$('#theme12').click(theme12);
$('#theme13').click(theme13);
$('#theme14').click(theme14);
$('#theme15').click(theme15);

function theme1() {
$('body').attr('class', 'bg-theme bg-theme1');
}

function theme2() {
$('body').attr('class', 'bg-theme bg-theme2');
}

function theme3() {
$('body').attr('class', 'bg-theme bg-theme3');
}

function theme4() {
$('body').attr('class', 'bg-theme bg-theme4');
}

function theme5() {
$('body').attr('class', 'bg-theme bg-theme5');
}

function theme6() {
$('body').attr('class', 'bg-theme bg-theme6');
}

function theme7() {
$('body').attr('class', 'bg-theme bg-theme7');
}

function theme8() {
$('body').attr('class', 'bg-theme bg-theme8');
}

function theme9() {
$('body').attr('class', 'bg-theme bg-theme9');
}

function theme10() {
$('body').attr('class', 'bg-theme bg-theme10');
}

function theme11() {
$('body').attr('class', 'bg-theme bg-theme11');
}

function theme12() {
$('body').attr('class', 'bg-theme bg-theme12');
}

function theme13() {
$('body').attr('class', 'bg-theme bg-theme13');
}

function theme14() {
$('body').attr('class', 'bg-theme bg-theme14');
}

function theme15() {
$('body').attr('class', 'bg-theme bg-theme15');
}

</script>


</body>

</html>

