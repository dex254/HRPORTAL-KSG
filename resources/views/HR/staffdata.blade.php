@include('admin.Dashboard.header')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Management</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Staff Members</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-light">Outputs</button>
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            <a class="dropdown-item" href="javascript:;">Copy</a>
                            <a class="dropdown-item" href="javascript:;">Excel</a>
                            <a class="dropdown-item" href="javascript:;">PDF</a>
                            <a class="dropdown-item" href="javascript:;">Print</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div>
                    </div>
                </div>
            </div> <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            <a href="/Uplosd_the_staff_for_application" class="btn btn-light radius-30 mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i>Add New Staff
                            </a>
                        </div>
                    </div>
                    @if ($errors->any() || session('success'))
                    <div class="alert alert-{{ $errors->any() ? 'danger' : 'success' }}" role="alert">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
    @if ($errors->any())
        <div class="alert alert-danger" id="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Style for alert boxes -->
    <style>
        .alert {
            padding: 15px; /* Add some padding */
            border-radius: 5px; /* Round corners */
            margin-bottom: 20px; /* Space between messages */
            display: block; /* Ensure the message is displayed as a block element */
        }
    
        .alert-success {
            background-color: yellow; /* Yellow background for success */
            color: #333; /* Dark text color */
            border: 1px solid #ccc; /* Border for the alert */
        }
    
        .alert-danger {
            background-color: #f8d7da; /* Light red background for errors */
            color: #721c24; /* Dark red text color */
            border: 1px solid #f5c6cb; /* Border for the alert */
        }
    </style>
    
    <!-- Flickering effect using JavaScript -->
    <script>
        // Function to add flicker effect
        function flickerEffect(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                let visible = true;
                setInterval(() => {
                    element.style.visibility = visible ? 'hidden' : 'visible';
                    visible = !visible;
                }, 470); // 500ms flicker interval
            }
        }
    
        // Apply flicker effect to success or error messages
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
                <th>Payroll Number</th>
                <th>UPN No</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Job Group</th>
                <th>Campus</th>
                <th>Job Designation</th>
                <th>Job Code</th>
                <th>ID Number</th>
                <th>Ethnicity</th>
                <th>Date of Birth</th>
                <th>Disability</th>
                <th>Gender</th>
                <th>1st Date of Appointment</th>
                <th>Current Date of Appointment</th>
                <th>Home County</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hr as $index => $record)
            <tr>
                <form action="{{ route('hr.update', $record->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Use PUT for updating a record -->
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $record->payroll_num }}</td>
                    <td>{{ $record->upn_no }}</td>
                    
                    <!-- Editable Name -->
                    <td><input type="text" name="name" value="{{ $record->name }}" class="form-control form-control-sm"></td>
                    
                    <td>{{ $record->designation }}</td>
                    
                    <!-- Editable Job Group -->
                    <td>
                        <select name="job_group" class="form-select form-select-sm">
                            @for ($i = 1; $i <= 13; $i++)
                                <option value="KSG {{ $i }}" {{ $record->job_group == "KSG $i" ? 'selected' : '' }}>
                                    KSG {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </td>
                    
                    <!-- Editable Campus -->
                    <td>
                        @php $campuses = ['Lower Kabete','e-Learning and Development Institute','Baringo','Mombasa','Matuga']; @endphp
                        <select name="campus" class="form-select form-select-sm">
                            @foreach($campuses as $campus)
                                <option value="{{ $campus }}" {{ $record->campus == $campus ? 'selected' : '' }}>{{ $campus }}</option>
                            @endforeach
                        </select>
                    </td>
                    
                    <td>{{ $record->job_designation }}</td>
                    <td>{{ $record->job_code }}</td>
                    <td>{{ $record->idnumber }}</td>
                    <td>{{ $record->ethnicity }}</td>
                    <td>{{ $record->dob }}</td>
                    <td>{{ $record->disability }}</td>
                    <td>{{ $record->gender }}</td>
                    <td>{{ $record->first_date_of_appointment }}</td>
                    <td>{{ $record->current_date_of_appointment }}</td>
                    
                    <!-- Editable Home County -->
                    <td>
                        @php
                            $counties = ['Baringo','Bomet','Bungoma','Busia','Elgeyo Marakwet','Embu','Garissa','Homa Bay','Isiolo','Kajiado','Kakamega','Kericho','Kiambu','Kilifi','Kirinyaga','Kisii','Kisumu','Kitui','Kwale','Laikipia','Lamu','Machakos','Makueni','Mandera','Marsabit','Meru','Migori','Mombasa','Murang\'a','Nairobi','Nakuru','Nandi','Narok','Nyamira','Nyandarua','Nyeri','Samburu','Siaya','Taita Taveta','Tana River','Tharaka Nithi','Trans Nzoia','Turkana','Uasin Gishu','Vihiga','Wajir','West Pokot'];
                        @endphp
                        <select name="home_county" class="form-select form-select-sm">
                            @foreach($counties as $county)
                                <option value="{{ $county }}" {{ $record->home_county == $county ? 'selected' : '' }}>{{ $county }}</option>
                            @endforeach
                        </select>
                    </td>
                    
                    <!-- Editable Email -->
                    <td><input type="email" name="email" value="{{ $record->email }}" class="form-control form-control-sm"></td>
                    
                    <!-- Editable Phone -->
                    <td><input type="text" name="phone" value="{{ $record->phone }}" class="form-control form-control-sm"></td>
                    
                    <!-- Update Button -->
                    <td>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


                    </div>
                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('admin.Dashboard.footer')

