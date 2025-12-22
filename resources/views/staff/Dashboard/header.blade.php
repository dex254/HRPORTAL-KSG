<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/dashtreme/demo/vertical/dashboard-alternate.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 May 2024 07:17:23 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('') }}assets/images/KSG Logo (1).png" type="image/png" />
	<!--plugins-->
	<link href="{{asset('') }}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/highcharts/css/highcharts-white.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="{{asset('') }}assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('') }}assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{asset('') }}assets/js/pace.min.js"></script>
	<link href="{{asset('') }}assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="{{asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('') }}assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{asset('') }}assets/css/app.css" rel="stylesheet">
	<link href="{{asset('') }}assets/css/icons.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Include jQuery (necessary for DataTables) -->
    <link href="{{asset('assets/css/dataTables.dataTables.min.css') }}" rel="stylesheet">
	
	<title>KSG Monitoring, Evaluation and  Reporting </title>
</head>

<body  class="bg-theme bg-theme1" >
    
    
	<!--wrapper-->
	<div  class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
                    <img src="{{asset('') }}assets/images/output-onlinepngtools (3).png" class="logo-icon" alt="logo icon" height = "66px" width = "70px">
                </div>

                <div>
                    <img src="{{asset('') }}assets/images/COA_Line__1.png" class="logo-icon" alt="logo icon" height = "66px" width = "5px">
                </div>

                <div>
                    <img src="{{asset('') }}assets/images/KSG Logo (1).png" class="logo-icon" alt="logo icon" height = "66px" width = "90px">
                
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
                </div>
			 </div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="/staff/Dashboard" >
						<div class="parent-icon"><i class="fas fa-home"></i>
						</div>
						<div class="menu-title">Home</div>
					</a>
					
				</li>
				<li>
					<a href="/Diary/staff"  >
						<div class="parent-icon">
							<i class="fas fa-journal-whills"></i>
						</div>
												
						<div class="menu-title"> Diary </div>
					</a>
				</li>

				<li class="menu-label">MONTHLY WORKLOAD</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fas fa-chalkboard-teacher"></i>
						</div>
						<div class="menu-title">Training</div>
					</a>
					<ul>
						<li> <a href="/Datatable/programlec"><i class='bx bx-radio-circle'></i>PROGRAMS</a>
						</li>
						<li> <a href="/My_class_contacthours"><i class='bx bx-radio-circle'></i>CLASS CONTACT HOURS</a>
						</li>
						<li> <a href="/My_facilitation_evaluation"><i class='bx bx-radio-circle'></i>FACILITATOR EVALUATION</a>
						</li>
						<li> <a href="/Progarms_I_have_coordinated"><i class='bx bx-radio-circle'></i>PROGRAMS COORDINATED</a>
						</li>
						<li> <a href="/My_coordination_evaluation"><i class='bx bx-radio-circle'></i>COORDINATOR EVALUATION</a>
						</li>
						<li> <a href="/Curriculum_Reveiwed"><i class='bx bx-radio-circle'></i>CURRICULUM REVIEWED</a>
						</li>
						<li> <a href="/Curriculum_developed_and_rolled_out"><i class='bx bx-radio-circle'></i>NEW CURRRICULUM DEVELOPED & ROLLED OUT</a>
						</li>
						<li> <a href="/Assesment_and_Evaluations"><i class='bx bx-radio-circle'></i>ASSESMENT & EVALUATION</a>
						</li>
						
						
						
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-bulb' style="font-size: 32px;"></i>
						</div>
						<div class="menu-title">Research</div>
					</a>
					<ul>
						<li> <a href="/Research/qualityresearchcompleted"><i class='bx bx-radio-circle'></i>QUALITY RESEARCH COMPLETED</a>
						</li>
						<li> <a href="/Research/advisorybriefssubmitted"><i class='bx bx-radio-circle'></i>ADVISORY BRIEFS SUBMITTED</a>
						</li>
						<li> <a href="/Research/participationorganizationofsymposiaconferences"><i class='bx bx-radio-circle'></i>ORGANIZATION & PARTICIPATION OF SYMPOSIAS/CONFERENCES</a>
						</li>
						
						
						
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-consulting"></i>
						</div>
						<div class="menu-title">Consultancy </div>
					</a>
					<ul>
						<li> <a href="/Consultancy/SuccessfulandCompletedConsultancyProjects"><i class='bx bx-radio-circle'></i>SUCCESSFUL & COMPLETED CONSULTANCY PROJECTS</a>
						</li>
						
						
						<li> <a href="/Consultancy/SubmissionofInceptionFinalConsultancyandExitReports"><i class='bx bx-radio-circle'></i>SUBMISSION OF INCEPTION REPORTS, FINAL CONSULTANCY & EXIT REPORTS</a>
						</li>
						<li> <a href="/Consultancy/RevenueRemittedtoKSGAccount"><i class='bx bx-radio-circle'></i>REVENUE REMMITED TO KSG ACCOUNT</a>
						</li>
						
						
						
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-first-aid"></i>
						</div>
						<div class="menu-title">Special Assignment</div>
					</a>
					<ul>
						<li> <a href="/SpecialAssignment/Appendix14"><i class='bx bx-radio-circle'></i>SPECIAL ASSIGNMENT FROM DIRECTORATES, CAMPUSES, INSTITUTES & DEPARTMENTS</a>
						</li>
						
						
						<li> <a href="/SpecialAssignment/Appendix15"><i class='bx bx-radio-circle'></i>OUTREACH SERVICES</a>
						</li>
						<li> <a href="/SpecialAssignment/Appendix16"><i class='bx bx-radio-circle'></i>OTHER ACTIVITIES DURING THE REVIEW MONTH</a>
						</li>
						
						
						
					</ul>
				</li>
				<li class="menu-label">Performance</li>
				<li>
					<a  class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="lni lni-stats-up"></i>
						</div>
						<div class="menu-title">Performance Appraisal </div>
					</a>
					<ul>
						<li> <a href="/meals/newsn"><i class='bx bx-radio-circle'></i>TARGET SETTING</a>
						</li>
						<li> <a href="/meals/newsn"><i class='bx bx-radio-circle'></i>APPRAISAL REPORT</a>
						</li>
						
						
					</ul>
				</li>
			
				
				
				
				
				
				
				<li class="menu-label"> Reports  </li>
				
			
				
				
				
				
				
				<li>
					<a href="/docs/index">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">Monthly Workload Report</div>
					</a>
				</li>
				<li class="menu-label">KSG Help</li>
				<li>
					<a href="/sapport/staff" target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title"> Help</div>
					</a>
				</li>
				
				<li>
				<form method="POST" action="{{ route('staff.logout') }}">
					@csrf
					<button  class="btn btn-warning px-5 radius-30" type="submit"><i class="lni lni-power-switch"></i>Logout</button>
				</form></li>
			</ul>
			
			<!--end navigation-->
		</div>
        <header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
				<div class="d-flex align-items-center" style="position: absolute; left: 60px;">
								<!-- Circle Indicator -->
								<div class="user-status" style="width: 12px; height: 12px; background-color: {{ Auth::guard('staff')->user()->is_online == 1 ? '#28a745' : '#dc3545' }}; border-radius: 50%; margin-right: 8px;"></div>

								<!-- Status Text -->
								<span style="font-weight: bold; font-size: 16px; color: white;">
									{{ Auth::guard('staff')->user()->is_online == 1 ? 'Online' : 'Offline' }}
								</span>
							</div>
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
						
					</div>
					
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
								<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
								</a>
							</li>
							

							<li class="nav-item dropdown dropdown-app">
								
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="app-container p-2 my-2">
									  <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
										
										
				
									  </div><!--end row-->
				
									</div>
								</div>
							</li>

							<li class="nav-item dropdown dropdown-large">
								
								<div class="dropdown-menu dropdown-menu-end">
									
									<div class="header-notifications-list">
									
										
										
										
										
										
										
										
										
									</div>
									
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
							
								
									
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									
									<div class="header-message-list">
										
										
										
									
										
										
										
										
										
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">
											<div class="d-flex align-items-center justify-content-between mb-3">
												<h5 class="mb-0">Total</h5>
												<h5 class="mb-0 ms-auto">$489.00</h5>
											</div>
											<button class="btn btn-light w-100">Checkout</button>
										</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="form-elements.html#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<div class="profile-image">
									<img src="{{asset('') }}profile/{{ Auth::guard('staff')->user()->image}}"  class="user-img" alt="user avatar">
								</div>
							
                            
                            <div class="user-info">
                                <p class="user-name mb-0"> {{ Auth::guard('staff')->user()->name}}, </p>
                                <p class="designattion mb-0">{{ Auth::guard('staff')->user()->designation}}: {{ Auth::guard('staff')->user()->campus}} </p>
                            </div>
                        </a>
						
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center" href="/staff/profile"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="/staff/profile/edit"> <i class="bx bx-cog fs-5"></i> <span>Settings</span>
                            </a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href=""><i class="bx bx-download fs-5"></i><span>Device Allocated pdfs</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href=""><i class="bx bx-download fs-5"></i><span>Downloads</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('staff.logout') }}">
                                    @csrf
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;" onclick="this.closest('form').submit();">
									<i class="lni lni-power-switch"></i><span>Logout</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
				</nav>
			</div>
		</header>
