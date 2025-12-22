@include('admin.Dashboard.header')



	<!--wrapper-->
	<div class="wrapper">
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Account Management</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col">
						<div class="card">
							<div class="card-body">
								<ul class="list-group">
									<li class="list-group-item active" aria-current="true"><strong>CURRENT ADMIN USER DETAILS</strong></li>
									<li class="list-group-item"><strong>Full Name: </strong> <span> {{ Auth::guard('admin')->user()->name}}  </span></li>
									<li class="list-group-item"><strong>E-Mail Address: </strong><span>{{ Auth::guard('admin')->user()->email}}</span></li>
									<li class="list-group-item"><strong>ID or Passport No.: </strong><span>{{ Auth::guard('admin')->user()->idnumber}}</span></li>
									<li class="list-group-item"><strong>Contact: </strong><span>{{ Auth::guard('admin')->user()->phone}}</span></li>
									<li class="list-group-item"><strong>Role: </strong><span>{{ Auth::guard('admin')->user()->role}}</span></li>
									
								</ul>
							</div>
						</div>
					</div>
                </div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body">
								<h5 class="d-flex align-items-center mb-3">Key in new details:</h5>
                                <br>
								<form class="row g-3" action="{{ route('admin.profile.update.post') }}" method="POST"  enctype="multipart/form-data">
									@csrf


									<div class="row mb-3">
                                        <div>
                                            <label for="formFileLg" class="form-label">Choose  a profile picture</label>
                                            <input class="form-control form-control-lg" id="formFileLg" name="image" type="file" multiple>
                                        </div>
                                    </div>
								<div class="row mb-3">
									<div class="col-sm-3">
										<p>First Name:</p>
									</div>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="name" value="{{ Auth::guard('admin')->user()->name}}" />
									</div>
								</div>
							
							
								<div class="row mb-3">
									<div class="col-sm-3">
										<p>E-Mail Address:</p>
									</div>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="email" value="{{ Auth::guard('admin')->user()->email}}" />
									</div>
								</div>
							
								<div class="row mb-3">
									<div class="col-sm-3">
										<p>Contact:</p>
									</div>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="phone" value="{{ Auth::guard('admin')->user()->phone}}" />
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-sm-3">
										<p>Campus:</p>
									</div>
										<div id="campus" class="col-sm-9">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="campus" id="LowerKabete" value="Lower Kabete" 
												{{ (Auth::guard('admin')->user()->campus == 'Lower Kabete') ? 'checked' : '' }}>
												<label class="form-check-label" for="LowerKabete">Lower Kabete</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="campus" id="eLDi" value="eLDi" 
												{{ (Auth::guard('admin')->user()->campus == 'eLDi') ? 'checked' : '' }}>
												<label class="form-check-label" for="eLDi">eLDi</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="campus" id="Mombasa" value="Mombasa" 
												{{ (Auth::guard('admin')->user()->campus == 'Mombasa') ? 'checked' : '' }}>
												<label class="form-check-label" for="Mombasa">Mombasa</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="campus" id="Matuga" value="Matuga" 
												{{ (Auth::guard('admin')->user()->campus == 'Matuga') ? 'checked' : '' }}>
												<label class="form-check-label" for="Matuga">Matuga</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="campus" id="Embu" value="Embu" 
												{{ (Auth::guard('admin')->user()->campus == 'Embu') ? 'checked' : '' }}>
												<label class="form-check-label" for="Embu">Embu</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="campus" id="Baringo" value="Baringo" 
												{{ (Auth::guard('admin')->user()->campus == 'Baringo') ? 'checked' : '' }}>
												<label class="form-check-label" for="Baringo">Baringo</label>
											</div>
										</div>
									</div>
								
								
								<div class="row">
									<div class="col-sm-3"></div>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-light px-4">Save Changes</button>
										</div>
									</div>
								</form>
								</div>
							</div>
						</div>
					</div>
            	</div>
        	</div>
    	</div>
		<!--end page wrapper -->
	</div>
	<!--end wrapper-->




	@include('admin.Dashboard.footer')
