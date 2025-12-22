@include('admin.Dashboard.header')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Applications</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                           
                            <li class="breadcrumb-item active" aria-current="page">Applicatins</li>
                        </ol>
                    </nav>
                </div>
                
            </div> <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            <a href="/" class="btn btn-light radius-30 mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i>
                            </a>
                        </div>
                    </div>
                    @if ($errors->any() || session('success') || session('error'))
    <div class="alert alert-{{ $errors->any() ? 'danger' : (session('error') ? 'danger' : 'success') }}" role="alert">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @elseif (session('error'))
            {{ session('error') }} <!-- Display custom error message -->
        @else
            {{ session('success') }}
        @endif
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success" id="success-message">
        {{ session('status') }}
    </div>
@endif

<!-- General Error Message (For form errors or custom validation errors) -->
@if ($errors->any() || session('error'))
    <div class="alert alert-danger" id="error-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @if (session('error'))
                <li>{{ session('error') }}</li> <!-- Display "already applied" error -->
            @endif
        </ul>
    </div>
@endif

<!-- Style for alert boxes -->
<style>
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: block;
    }

    .alert-success {
        background-color: yellow;
        color: #333;
        border: 1px solid #ccc;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<!-- Flickering effect using JavaScript -->
<script>
    function flickerEffect(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            let visible = true;
            setInterval(() => {
                element.style.visibility = visible ? 'hidden' : 'visible';
                visible = !visible;
            }, 470);
        }
    }

    if (document.getElementById('success-message')) {
        flickerEffect('success-message');
    }

    if (document.getElementById('error-message')) {
        flickerEffect('error-message');
    }
</script>
<div class="table-responsive">
    <table id="example2" class="table mb-0">
        <thead class="table-light">
            
            <tr>
                <th>#</th>
                <th>UPN No</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Job Group</th>
                <th>Campus</th>
                <th>Job Code</th>
                <th>ID Number</th>
                <th>Ethnicity</th>
                <th>DOB</th>
                <th>Disability</th>
                <th>Gender</th>
                <th>First Appointment</th>
                <th>Current Appointment</th>
                <th>Home County</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Academic Qualifications</th>
                <th>Ongoing Courses</th>
                <th>Career Guidelines</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hrDetails as $index => $hr)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $hr->upn_no }}</td>
                    <td>{{ $hr->name }}</td>
                    <td>{{ $hr->designation }}</td>
                    <td>{{ $hr->job_group }}</td>
                    <td>{{ $hr->campus }}</td>
                    <td>{{ $hr->job_code }}</td>
                    <td>{{ $hr->idnumber }}</td>
                    <td>{{ $hr->ethnicity }}</td>
                    <td>{{ $hr->dob }}</td>
                    <td>{{ $hr->disability }}</td>
                    <td>{{ $hr->gender }}</td>
                    <td>{{ $hr->first_date_of_appointment }}</td>
                    <td>{{ $hr->current_date_of_appointment }}</td>
                    <td>{{ $hr->home_county }}</td>
                    <td>{{ $hr->email }}</td>
                    <td>{{ $hr->phone }}</td>
                    <td>{{ $hr->academic_qualifications }}</td>
                    <td>{{ $hr->ongoing_long_courses }}</td>
                    <td>{{ $hr->career_guideline_requirements }}</td>
                    <td>{{ $hr->status }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>UPN No</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Job Group</th>
                <th>Campus</th>
                <th>Job Code</th>
                <th>ID Number</th>
                <th>Ethnicity</th>
                <th>DOB</th>
                <th>Disability</th>
                <th>Gender</th>
                <th>First Appointment</th>
                <th>Current Appointment</th>
                <th>Home County</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Academic Qualifications</th>
                <th>Ongoing Courses</th>
                <th>Career Guidelines</th>
                <th>Status</th>
            </tr>
                            </tfoot>
                        </table>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detailes   Applicat  data</h5>
                            <hr/>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Biodata
                              </button>
                            </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">	<strong><table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <td>{{ $hr->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>New  UPN</th>
                                                    <td>{{ $hr->upn_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Designation</th>
                                                    <td>{{ $hr->designation }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Job Group</th>
                                                    <td>{{ $hr->job_group }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Id  Number</th>
                                                    <td>{{ $hr->idnumber }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    
                                                        <td>{{ $hr->phone }}</td>
                                                    
                                               
                                                <tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        
                                                            <td>{{ $hr->email }}</td>
                                                        
                                                   
                                                    <tr>
                                                <tr>
                                                    <th>campus</th>
                                                    <td>{{ $hr->campus }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Job  Code</th>
                                                    <td>{{ $hr->job_code }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td>{{ $hr->gender }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date  of  Birth</th>
                                                    <td>{{ $hr->dob }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Disabiliry</th>
                                                    
                                                        <td>{{ $hr->disability }}</td>:<td>{{ $hr->disability_description }}</td>
                                                    
                                               
                                                <tr>
                                                    <th>Ethnicity</th>
                                                   
                                                        
                                                        <td>{{ $hr->ethnicity }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Home  County</th>
                                                       
                                                            
                                                            <td>{{ $hr->home_county }}</td>
                                                        </tr>
                                              
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                  {{ $hr->application_status }}
                                                        </tr>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Accademic  Data
                              </button>
                            </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">	<strong>Academic Data.</strong> {{ $hr->academic_qualifications }}</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Proffesional  Experince
                              </button>
                            </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">	<strong>Dates of Appointment:{{ $hr->first_date_of_appointment }}</strong>to<strong>{{ $hr->current_date_of_appointment }}.<br></strong>On  going  Long  Couses: {{ $hr->ongoing_long_courses }} <br><strong> Carrer  Guidelines:{{ $hr->career_guideline_requirements }}</strong><br>.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





</div>
</div>
</div>
</div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('admin.Dashboard.footer')
