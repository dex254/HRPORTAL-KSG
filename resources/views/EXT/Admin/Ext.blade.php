@include('admin.Dashboard.header')

<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

<div class="table-responsive">
   <table id="example2" class="table mb-0">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Personal Info</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Ethnicity</th>
            <th>Disability</th>
            <th>Academic</th>
            <th>Professional Bodies</th>
            <th>Professional qualification where applicable</th>
            <th>Short Courses</th>
            <th>Work Experience</th>
            <th>Cumulative work experience (Years)</th>
            <th>Referees</th>
            
            <th>Application Info</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $entry)
            @php
                $ext = $entry['ext'];
                $dob = $ext?->dob;
                $age = $dob ? \Carbon\Carbon::parse($dob)->age : '-';
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>

                <!-- Personal Info -->
                <td>
                    <strong>Name:</strong> {{ $ext?->name }}<br>
                    <strong>Email:</strong> {{ $ext?->email }}<br>
                    <strong>ID Number:</strong> {{ $ext?->idnumber }}<br>
                    <strong>KEY:</strong> {{ $ext?->upn_no }}<br>
                    <strong>Nationality:</strong> {{ $ext?->nationality ?? '-' }}<br>
                    <strong>Date of Birth:</strong> {{ $dob ? \Carbon\Carbon::parse($dob)->format('d M Y') : '-' }}<br>
                    <strong>Mobile No:</strong> {{ $ext?->mobile_no ?? '-' }}<br>
                    <strong>Postal Address:</strong> {{ $ext?->postal_address ?? '-' }}<br>
                    <strong>Online Status:</strong> 
                        @if($ext?->online_status === 'online')
                            <span style="color: green;">Online</span>
                        @else
                            <span style="color: gray;">Offline</span>
                        @endif<br>
                    <strong>Login Time:</strong> {{ $ext?->login_time ?? '-' }}<br>
                    <strong>Logout Time:</strong> {{ $ext?->logout_time ?? '-' }}<br>
                    <strong>Department:</strong> {{ $ext?->department ?? '-' }}
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
        <div style="margin-bottom: 15px; padding: 8px; border-bottom: 1px solid #ddd;">
            <strong>Institution:</strong> {{ $a->institution }}<br>
            <strong>Course:</strong> {{ $a->course }} ({{ $a->level }})<br>
            <strong>Education Type:</strong> {{ $a->Education_type }}<br>
            <strong>Duration:</strong> {{ \Carbon\Carbon::parse($a->stdate)->format('M Y') }} - {{ \Carbon\Carbon::parse($a->enddate)->format('M Y') }}<br>
            <strong>Grade:</strong> {{ $a->grade ?? 'N/A' }}<br>

            @if($a->document_name)
                <a href="{{ asset('uploads/Academic/' . $a->document_name) }}" 
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
        <em>No academic records</em>
    @endforelse
</td>
<td>
    @forelse($entry['profecionalbodies'] as $pb)
        <div style="margin-bottom: 10px;">
            <strong>{{ $pb->name }}</strong><br>
            Membership No: {{ $pb->membership_no }}<br>
            Status: {{ $pb->status }}<br>

            @if ($pb->document_name)
                <a href="{{ asset('uploads/Profecionalbody/' . $pb->document_name) }}" 
                   class="btn btn-sm btn-outline-primary mt-1" 
                   target="_blank" 
                   download>
                    Download Document
                </a>
            @else
                <em>No document uploaded</em>
            @endif
        </div>
    @empty
        <em>No membership records</em>
    @endforelse
</td>


                <!-- Other Training -->
               <td>
    @forelse($entry['licence'] as $o)
        <div style="margin-bottom: 10px;">
           
            Qualification: {{ $o->has_license }}<br>
            Name: {{ $o->license_name }} on {{ \Carbon\Carbon::parse($o->license_date)->format('d M Y') }}<br>
            Client: {{ $o->Client }}<br>
            Amount: KES {{ number_format($o->Amount, 2) }}<br>
        File: @if ($o->document_name)
                <a href="{{ asset('uploads/Licence/' . $o->document_name) }}" 
                   class="btn btn-sm btn-outline-primary mt-1" 
                   target="_blank" 
                   download>
                    Download Document
                </a>
            @else
                <em>No document uploaded</em>
            @endif
        </div>
   
        </div>
    @empty
        <em>No Consultancy assignments and Research assignments</em>
    @endforelse
</td>

 <td>
    @forelse($entry['education_training'] as $af)
        <div style="margin-bottom: 15px; padding: 8px; border-bottom: 1px solid #ddd;">
            <strong>Institution:</strong> {{ $af->institution }}<br>
            <strong>Course:</strong> {{ $af->course }} ({{ $af->level }})<br>
            <strong>Education Type:</strong> {{ $af->Education_type }}<br>
            <strong>Duration:</strong> {{ \Carbon\Carbon::parse($a->stdate)->format('M Y') }} - {{ \Carbon\Carbon::parse($a->enddate)->format('M Y') }}<br>
            <strong>Grade:</strong> {{ $af->grade ?? 'N/A' }}<br>

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
        <em>No academic records</em>
    @endforelse
</td>

                <!-- Work Experience -->
                <td>
    @forelse($entry['experiences'] as $e)
        <div style="margin-bottom: 10px;">
            <strong>{{ $e->employer }}</strong><br>
            Job Title: {{ $e->job_title }}<br>
            Country: {{ $e->country }},<br> Location: {{ $e->location }}<br>
            Duration: {{ \Carbon\Carbon::parse($e->stdate)->format('M Y') }} – 
                      {{ $e->enddate ? \Carbon\Carbon::parse($e->enddate)->format('M Y') : 'Present' }}<br>
            Area of Expertise: {{ $e->expartise }}<br>
            Duties: {{ $e->duties }}
        </div>
    @empty
        <em>No experience records</em>
    @endforelse
</td>
<td>{{ $item['cumulative_experience'] ?? 'N/A' }}</td>
 <td>
    @forelse($entry['referees'] as $ed)
        <div style="margin-bottom: 10px;">
           
            <strong>{{ $ed->employer }}</strong><br>
           
            Position: {{ $ed->Position }}, Job: {{ $ed->job_title }} <br>
            
            Referee Name: {{ $ed->refname }}<br>
            Referee Mobile: {{ $ed->refphone }}<br>
             Referee Email: {{ $ed->refemail }}<br>
            
           
        </div>
    @empty
        <em>No experience records</em>
    @endforelse
</td>

                <!-- Professional Bodies -->
          
      

                <!-- Latest Application Info -->
                <td>
                   @forelse($entry['applications'] as $app)
    <div style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
        <strong>Ref No:</strong> {{ $app->Ref_No }}<br>
        <strong>Name:</strong> {{ $app->name }}<br>
        <strong>Designation:</strong> {{ $app->designation }}<br>
        <strong>Expected Salary:</strong> {{ $app->Expected }}<br>
        <strong>Job Group:</strong> {{ $app->job_group }}<br>
        <strong>Status:</strong> {{ $app->status }}<br>
        <strong>Date:</strong> {{ \Carbon\Carbon::parse($app->created_at)->format('d M Y') }}<br>

        @if($app->cv)
            <a href="{{ asset($app->cv) }}" class="btn btn-sm btn-outline-primary mt-1" download target="_blank">
                Download CV
            </a>
        @endif

        @if($app->cover_letter)
            <a href="{{ asset($app->cover_letter) }}" class="btn btn-sm btn-outline-secondary mt-1" download target="_blank">
                Download Cover Letter
            </a>
        @endif

        @if($app->my_bio)
            <a href="{{ asset($app->my_bio) }}" class="btn btn-sm btn-outline-success mt-1" download target="_blank">
                Download Bio Report
            </a>
        @endif
    </div>
@empty
    <em>No applications</em>
@endforelse

                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>

        </div></div></div>


  


@include('admin.Dashboard.footer')