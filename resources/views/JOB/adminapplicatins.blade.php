

@include('admin.Dashboard.header')

<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

<div class="table-responsive">
   <table id="internalDataTable" class="table mb-0"   style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>S/NO</th>
            <th>Employee Bio Data</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Ethnicity</th>
            <th>Disability</th>
            <th>Academic</th>
            <th>Professional Qualification</th>
            <th>Short Course</th>
            <th>Professional Bodies</th>
             <th>Work Experience</th>
             <th>Years  of Experence</th>
              <th>Professional Licence</th>
             <th>Consultancy Assignments</th>
        <th>Research Assignments</th>
        <th>Publications</th>
        <th>Teaching Experience</th>
        <th>Food Handlers Certificate</th>

        <th>Association Membership</th>

           
            
           
          
            
            <th>Application Info</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $entry)
            @php
                $ext = $entry['hr'];
                $dob = $ext?->dob;
                $age = $dob ? \Carbon\Carbon::parse($dob)->age : '-';
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>

                <!-- Personal Info -->
              <td>
    <strong>Name:</strong>
    {{ $ext?->name ? ucwords(strtolower($ext->name)) : '-' }}<br>

    <strong>Email:</strong>
    {{ $ext?->email ? strtolower($ext->email) : '-' }}<br>

    <strong>ID Number:</strong>
    {{ $ext?->idnumber ? strtoupper($ext->idnumber) : '-' }}<br>

    <strong>Nationality:</strong>
    {{ $ext?->nationality ? ucwords(strtolower($ext->nationality)) : '-' }}<br>

    <strong>Date of Birth:</strong>
    {{ $dob ? \Carbon\Carbon::parse($dob)->format('d M Y') : '-' }}<br>

    <strong>Mobile No:</strong>
    {{ $ext?->mobile_no ?? '-' }}<br>

    <strong>Postal Address:</strong>
    {{ $ext?->postal_address ? ucwords(strtolower($ext->postal_address)) : '-' }}
</td>


                <!-- Age -->
                <td>{{ $age }}</td>

                <!-- Gender -->
                <td>{{ $ext?->gender ?? '-' }}</td>

                <!-- Ethnicity -->
                <td>{{ $ext?->ethnicity ?? '-' }}</td>

                <!-- Disability -->
                <td>
                    {{ $ext?->disability ?? '-' }}
                    @if($ext?->disability_description)
                        <br><small>Type: {{ $ext->disability_description }}</small>
                    @endif
                    @if($ext?->documentName)
                        <br>
                        <a href="{{ asset('uploads/PWD/' . $ext->documentName) }}" 
                           target="_blank" 
                           class="btn btn-sm btn-outline-primary mt-1">
                            Download
                        </a>
                    @endif
                </td>

                <!-- Continue with Academic, Work Experience, etc... -->



              <td>
    @forelse($entry['education_academic'] as $a)
        <div style="margin-bottom: 15px; padding: 10px; border-bottom: 1px solid #e0e0e0;">
            
            <strong>Institution:</strong>
            {{ ucwords(strtolower($a->institution)) }}<br>

            <strong>Course:</strong>
            {{ ucwords(strtolower($a->course)) }}<br>

            <strong>Education Type:</strong>
            {{ ucwords(strtolower($a->Education_type)) }}<br>

            <strong>Duration:</strong>
            {{ \Carbon\Carbon::parse($a->stdate)->format('M Y') }}
            –
            {{ \Carbon\Carbon::parse($a->enddate)->format('M Y') }}<br>

            <strong>Grade:</strong>
            {{ $a->grade ?? 'N/A' }}<br>

            <strong>Year of Graduation:</strong>
            {{ $a->enddate ? \Carbon\Carbon::parse($a->enddate)->format('Y') : 'N/A' }}<br>

            @if($a->document_name)
                <a href="{{ asset('uploads/Academic/' . $a->document_name) }}"
                   class="btn btn-sm btn-outline-primary mt-2"
                   target="_blank"
                   download>
                    📄 Download Academic Document
                </a>
            @else
                <em>No document uploaded</em>
            @endif

        </div>
    @empty
        <em>No academic records provided.</em>
    @endforelse
</td>
<td>
    @forelse($entry['education_professional'] as $p)
        <div style="margin-bottom: 15px; padding: 10px; border-bottom: 1px solid #e0e0e0;">

            <strong>Institution:</strong>
            {{ ucwords(strtolower($p->institution)) }}<br>

            <strong>Course:</strong>
            {{ ucwords(strtolower($p->course)) }}<br>

            <strong>Duration:</strong>
            {{ \Carbon\Carbon::parse($p->stdate)->format('M Y') }}
            –
            {{ \Carbon\Carbon::parse($p->enddate)->format('M Y') }}<br>

            <strong>Grade:</strong>
            {{ $p->grade ?? 'N/A' }}
             @if($p->document_name)
                <a href="{{ asset('uploads/Academic/' . $p->document_name) }}"
                   class="btn btn-sm btn-outline-primary mt-2"
                   target="_blank"
                   download>
                    📄 Download Academic Document
                </a>
            @else
                <em>No document uploaded</em>
            @endif

        </div>
    @empty
        <em>No professional qualifications provided.</em>
    @endforelse
</td>
<td>
    @forelse($entry['education_training'] as $af)
        <div style="margin-bottom: 15px; padding: 8px; border-bottom: 1px solid #ddd;">

            <strong>Institution:</strong>
            {{ ucwords(strtolower($af->institution)) }}<br>

            <strong>Course:</strong>
            {{ ucwords(strtolower($af->course)) }}<br>

            <strong>Duration:</strong>
            {{ \Carbon\Carbon::parse($af->stdate)->format('M Y') }}
            –
            {{ \Carbon\Carbon::parse($af->enddate)->format('M Y') }}<br>

            <strong>Grade:</strong>
            {{ $af->grade ?? 'N/A' }}<br>

            @if($af->document_name)
                <a href="{{ asset('uploads/Academic/' . $af->document_name) }}" 
                   class="btn btn-sm btn-outline-primary mt-1" 
                   target="_blank" 
                   download>
                    📄 Download Document
                </a>
            @else
                <em>No document uploaded</em>
            @endif
        </div>
    @empty
        <em>No training records provided.</em>
    @endforelse
</td>



<td>
    @forelse($entry['profecionalbodies'] as $pb)
        <div style="margin-bottom: 10px;">
            <strong>{{ ucwords(strtolower($pb->name)) }}</strong><br>
            <strong>Membership No:</strong> {{ strtolower($pb->membership_no) }}<br>
            <strong>Status:</strong> {{ strtolower($pb->status) }}<br>

            @if ($pb->document_name)
                <a href="{{ asset('uploads/Profecionalbody/' . $pb->document_name) }}" 
                   class="btn btn-sm btn-outline-primary mt-1" 
                   target="_blank" 
                   download>
                    Download Document
                </a>
            @else
                <em>no document uploaded</em>
            @endif
        </div>
    @empty
        <em>no membership records</em>
    @endforelse
</td>

<td>
    @forelse($entry['experiences'] as $index => $e)
        @php
            $start = \Carbon\Carbon::parse($e->stdate);
            $end = $e->enddate ? \Carbon\Carbon::parse($e->enddate) : \Carbon\Carbon::now();
            $years = $end->diffInYears($start);
            $months = $end->diffInMonths($start) % 12;
        @endphp

        <div style="margin-bottom: 10px;">
            {{ $index + 1 }}. <strong>Organization:</strong> {{ ucwords(strtolower($e->employer)) }}<br>
            <strong>Job Title:</strong> {{ ucwords(strtolower($e->job_title)) }}<br>
            <strong>Duration:</strong> {{ $start->format('M Y') }} – {{ $e->enddate ? $end->format('M Y') : 'present' }}<br>
            <strong>Total years of experience:</strong> {{ $years }} yr{{ $years > 1 ? 's' : '' }} {{ $months > 0 ? $months . ' mo' : '' }}
        </div>
    @empty
        <em>no experience records</em>
    @endforelse
</td>

 <td>
        @forelse($entry['years_of_experence'] as $y)
            {{ $y->years }}<br>
        @empty
            N/A
        @endforelse
    </td>



                <!-- Other Training -->
              <td>
    @forelse($entry['licence'] as $o)
        <div style="margin-bottom: 10px;">
            <strong>Qualification:</strong> {{ strtolower($o->has_license) }}<br>
            <strong>Name:</strong> {{ strtolower($o->license_name) }} on {{ \Carbon\Carbon::parse($o->license_date)->format('d M Y') }}<br>
            <strong>Client:</strong> {{ strtolower($o->Client) }}<br>
            <strong>Amount:</strong> KES {{ number_format($o->Amount, 2) }}<br>
            <strong>File:</strong> 
            @if ($o->document_name)
                <a href="{{ asset('uploads/Licence/' . $o->document_name) }}" 
                   class="btn btn-sm btn-outline-primary mt-1" 
                   target="_blank" 
                   download>
                    Download Document
                </a>
            @else
                <em>no document uploaded</em>
            @endif
        </div>
    @empty
        <em>no consultancy assignments and research assignments</em>
    @endforelse
</td>


<!-- CONSULTANCY ASSIGNMENTS -->
<td>
    @forelse($entry['other_consultancy'] as $c)
        <div style="margin-bottom: 10px;">
            <strong>Client:</strong> {{ ucwords(strtolower($c->Client)) ?? 'n/a' }}<br>
            <strong>Sector:</strong> {{ ucwords(strtolower($c->Sector)) ?? 'n/a' }}<br>
            <strong>Completed:</strong> {{ strtolower($c->completed) ?? 'n/a' }}<br>
            <strong>Completion Date:</strong> {{ !empty($c->compedate) ? \Carbon\Carbon::parse($c->compedate)->format('d M Y') : 'n/a' }}<br>
            <strong>File:</strong> 
            @if(!empty($c->document_name))
                <a href="{{ asset('uploads/Other/' . $c->document_name) }}" target="_blank">view</a>
            @else
                <em>no document</em>
            @endif
        </div>
    @empty
        <em>no consultancy assignments</em>
    @endforelse
</td>


<!-- RESEARCH ASSIGNMENTS -->
<td>
    @forelse($entry['other_research'] as $r)
        <div style="margin-bottom: 10px;">
            <strong>Client:</strong> {{ ucwords(strtolower($r->Client)) ?? 'n/a' }}<br>
            <strong>Sector:</strong> {{ ucwords(strtolower($r->Sector)) ?? 'n/a' }}<br>
            <strong>Completed:</strong> {{ strtolower($r->completed) ?? 'n/a' }}<br>
            <strong>Completion Date:</strong> {{ !empty($r->compedate) ? \Carbon\Carbon::parse($r->compedate)->format('d M Y') : 'n/a' }}<br>
            <strong>Amount:</strong> {{ strtolower($r->Amount) ?? 'n/a' }}<br>
            <strong>File:</strong> 
            @if(!empty($r->document_name))
                <a href="{{ asset('uploads/Other/' . $r->document_name) }}" target="_blank">view</a>
            @else
                <em>no document</em>
            @endif
        </div>
    @empty
        <em>no research assignments</em>
    @endforelse
</td>


<!-- PUBLICATIONS -->
<td>
    @forelse($entry['publications'] as $p)
        <div style="margin-bottom: 10px;">
            <strong>Journal / Publisher:</strong> {{ ucwords(strtolower($p->Client)) ?? 'n/a' }}<br>
            <strong>Type / Title:</strong> {{ ucwords(strtolower($p->completed)) ?? 'n/a' }}<br>
            <strong>Publication Date:</strong> {{ !empty($p->compedate) ? \Carbon\Carbon::parse($p->compedate)->format('d M Y') : 'n/a' }}<br>
            <strong>File:</strong> 
            @if(!empty($p->document_name))
                <a href="{{ asset('uploads/Other/' . $p->document_name) }}" target="_blank">view</a>
            @else
                <em>no document</em>
            @endif
        </div>
    @empty
        <em>no publications</em>
    @endforelse
</td>

<!-- TEACHING EXPERIENCE -->
<td>
    @forelse($entry['teachings'] as $t)
        <div style="margin-bottom: 10px;">
            <strong>Teaching Areas:</strong> {{ ucwords(strtolower($t->teaching_areas)) ?? 'n/a' }}<br>
            <strong>Employer:</strong> {{ ucwords(strtolower($t->employer)) ?? 'n/a' }}<br>
            <strong>Designation:</strong> {{ ucwords(strtolower($t->job_title)) ?? 'n/a' }}<br>
            <strong>Country:</strong> {{ ucwords(strtolower($t->country)) ?? 'n/a' }}<br>
            <strong>Start Date:</strong> {{ $t->stdate ?? 'n/a' }}<br>
            <strong>End Date:</strong> {{ $t->enddate ?? 'n/a' }}<br>
            <strong>Location:</strong> {{ ucwords(strtolower($t->location)) ?? 'n/a' }}<br>
            <strong>Job Description:</strong> {{ strtolower($t->duties) ?? 'n/a' }}<br>
            <strong>Duties & Responsibilities:</strong> {{ strtolower($t->achievements) ?? 'n/a' }}
        </div>
    @empty
        <em>no teaching experience</em>
    @endforelse
</td>
<!-- ASSOCIATION MEMBERSHIP -->
<td>
    @forelse($entry['associations'] as $assoc)
        <div style="margin-bottom: 10px;">
            <strong>Am I a member:</strong> {{ strtolower($assoc->condition) ?? 'n/a' }}<br>
            <strong>Association Name:</strong> {{ ucwords(strtolower($assoc->association_name)) ?? 'n/a' }}<br>
            <strong>Membership Status:</strong> {{ strtolower($assoc->status) ?? 'n/a' }}<br>
            <strong>Document:</strong> 
            @if(!empty($assoc->document_name))
                <a href="{{ asset('uploads/Association/' . $assoc->document_name) }}" target="_blank">view document</a>
            @else
                <em>no document</em>
            @endif<br>
            <strong>Document Name:</strong> {{ strtolower($assoc->document_name) ?? 'n/a' }}
        </div>
    @empty
        <em>no association records</em>
    @endforelse
</td>
<!-- FOOD HANDLERS CERTIFICATE -->
<td>
    @forelse($entry['medical'] as $med)
        <div style="margin-bottom: 10px;">
            <strong>Examination Name:</strong> {{ ucwords(strtolower($med->name_exam)) ?? 'n/a' }}<br>
            <strong>I have:</strong> {{ strtolower($med->condition) ?? 'n/a' }}<br>
            <strong>Date:</strong> {{ !empty($med->date) ? \Carbon\Carbon::parse($med->date)->format('d M Y') : 'n/a' }}<br>
            <strong>Status:</strong> {{ strtolower($med->status) ?? 'n/a' }}<br>
            <strong>Document:</strong>
            @if(!empty($med->document_name))
                <a href="{{ asset('uploads/Medical/' . $med->document_name) }}" target="_blank">view document</a>
            @else
                <em>no document</em>
            @endif<br>
            <strong>Document Name:</strong> {{ strtolower($med->document_name) ?? 'n/a' }}
        </div>
    @empty
        <em>no food handlers certificate</em>
    @endforelse
</td>





                <!-- Work Experience -->
             


                <!-- Professional Bodies -->
          
      

                <!-- Latest Application Info -->
               <td>
    @forelse($entry['applications'] as $app)
        <div style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
            <strong>Ref No:</strong> {{ strtolower($app->Ref_No) }}<br>
            <strong>Name:</strong> {{ ucwords(strtolower($app->name)) }}<br>
            <strong>Designation:</strong> {{ ucwords(strtolower($app->designation)) }}<br>
            <strong>Expected Salary:</strong> {{ strtolower($app->Expected) }}<br>
            <strong>Job Group:</strong> {{ strtolower($app->job_group) }}<br>
            <strong>Status:</strong> {{ strtolower($app->status) }}<br>
            <strong>Date:</strong> {{ \Carbon\Carbon::parse($app->created_at)->format('d M Y') }}<br>

            @if($app->cv)
                <a href="{{ asset($app->cv) }}" class="btn btn-sm btn-outline-primary mt-1" download target="_blank">
                    download cv
                </a>
            @endif

            @if($app->cover_letter)
                <a href="{{ asset($app->cover_letter) }}" class="btn btn-sm btn-outline-secondary mt-1" download target="_blank">
                    download cover letter
                </a>
            @endif

            @if($app->my_bio)
                <a href="{{ asset($app->my_bio) }}" class="btn btn-sm btn-outline-success mt-1" download target="_blank">
                    download bio report
                </a>
            @endif
        </div>
    @empty
        <em>no applications</em>
    @endforelse
</td>

            </tr>
        @endforeach
    </tbody>
    </table>
</div>

        </div></div></div>


  


@include('admin.Dashboard.footer')
{{-- @include('admin.Dashboard.header')

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
                                    <th>UPN/No</th>
                                    <th>Name</th>
                                    <th>Job Group</th>
                                    <th>Total Applications</th>
                                     <th>Status Applied </th>
                                     <th> Status Qualified </th>
                                      <th> Status Not Qualified </th>
                                    
                                    
                                    
                                   
                                    <th>Shortlist</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedApplicants as $group)
                                <tr>
                                    <td>{{ $group->upn_no }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->job_group }}</td>
                                    
                                    <td>{{ $group->total_applications }}</td>
                                    <td>{{ $group->applied_count }}</td>
                                    <td class="{{ $group->applied_count != 0 ? 'has-applied' : '' }}">
                                        {{ $group->applied_count }}
                                        @if($group->applied_count > 0)
                                            <span class="flicker-rectangle">VIEW</span>
                                        @endif
                                    </td> <style>
                                        /* Basic table styling */
                                       
                                
                                        /* Style for the flickering rectangle */
                                        .flicker-rectangle {
                                            display: inline-block;
                                            padding: 2px 5px;
                                            background-color: red;
                                            color: white;
                                            font-weight: bold;
                                            border-radius: 3px;
                                            animation: flicker 1s infinite;
                                        }
                                
                                        /* Style for the qualified flickering rectangle */
                                        .flicker-rectangle.qualified {
                                            background-color: green; /* Change color for qualified count */
                                        }
                                
                                        /* Keyframes for flickering effect */
                                        @keyframes flicker {
                                            0% { opacity: 1; }
                                            50% { opacity: 0.5; }
                                            100% { opacity: 1; }
                                        }
                                
                                        /* Optional: Add a class to highlight the cell */
                                        .has-applied {
                                            background-color: #ffe6e6; /* Light red background */
                                        }
                                
                                        .has-qualified {
                                            background-color: #e6ffe6; /* Light green background */
                                        }
                                
                                        /* Button styling */
                                        .btn {
                                            padding: 5px 10px;
                                            background-color: #007bff;
                                            color: white;
                                            text-decoration: none;
                                            border-radius: 3px;
                                            font-size: 14px;
                                        }
                                
                                        .btn:hover {
                                            background-color: #0056b3;
                                        }
                                    </style>
                                     <script>
                                        // Optional JavaScript for flickering effect
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const flickerElements = document.querySelectorAll('.flicker-rectangle');
                                
                                            flickerElements.forEach(element => {
                                                setInterval(() => {
                                                    element.classList.toggle('flicker');
                                                }, 500);
                                            });
                                        });
                                    </script>
                                    <td>{{ $group->not_qualified_count }}</td>
                                    <td>
                                        <a href="{{ route('JOB.Veiwapplicatnts', ['upn_no' => $group->upn_no]) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i> Shortlist
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>UPN/No</th>
                                    <th>Name</th>
                                    <th>Job Group</th>
                                    <th>Total Applications</th>
                                     <th>Status Applied </th>
                                     <th> Status Qualified </th>
                                      <th> Status Not Qualified </th>
                                    
                                    <th>Shortlist</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('admin.Dashboard.footer') --}}