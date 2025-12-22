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
            <th>Academic</th>
            <th>Consultancy assignments and Research assignments</th>
            <th>Work Experience</th>
             <th>Teaching Experience</th>
            <th>Professional Bodies</th>
            <th>Application Info</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $entry)
            <tr>
                <td>{{ $index }}</td>

                <!-- Personal Info -->
              <td>
    <strong>Name:</strong> {{ $entry['hrpu']?->sname }} {{ $entry['hrpu']?->oname }}<br>
    <strong>UPN:</strong> {{ $entry['hrpu']?->upn_no }}<br>
    <strong>Nationality:</strong> {{ $entry['hrpu']?->nationality ?? '-' }}<br>
    <strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($entry['hrpu']?->dob)->format('d M Y') ?? '-' }}<br>
    <strong>Mobile No:</strong> {{ $entry['hrpu']?->mobile_no ?? '-' }}<br>
    <strong>Postal Address:</strong> {{ $entry['hrpu']?->postal_address ?? '-' }}<br>
    <strong>Email:</strong> {{ $entry['hrpu']?->email }}<br>
    <strong>Online Status:</strong> 
        @if($entry['hrpu']?->online_status === 'online')
            <span style="color: green;">Online</span>
        @else
            <span style="color: gray;">Offline</span>
        @endif
    <br>
    <strong>Login Time:</strong> {{ $entry['hrpu']?->login_time ?? '-' }}<br>
    <strong>Logout Time:</strong> {{ $entry['hrpu']?->logout_time ?? '-' }}<br>
    <strong>Department:</strong> {{ $entry['hrpu']?->department ?? '-' }}
</td>


               <td>
    @forelse($entry['academics'] as $a)
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


                <!-- Other Training -->
               <td>
    @forelse($entry['others'] as $o)
        <div style="margin-bottom: 10px;">
           
            Sector: {{ $o->Sector }}<br>
            Completed: {{ $o->completed }} on {{ \Carbon\Carbon::parse($o->compedate)->format('d M Y') }}<br>
            Client: {{ $o->Client }}<br>
            Amount: KES {{ number_format($o->Amount, 2) }}<br>
            Type: {{ $o->type }}
        </div>
    @empty
        <em>No Consultancy assignments and Research assignments</em>
    @endforelse
</td>


                <!-- Work Experience -->
                <td>
    @forelse($entry['experiences'] as $e)
        <div style="margin-bottom: 10px;">
            <strong>{{ $e->employer }}</strong><br>
            Job Title: {{ $e->job_title }}<br>
            Country: {{ $e->country }}, Location: {{ $e->location }}<br>
            Duration: {{ \Carbon\Carbon::parse($e->stdate)->format('M Y') }} – 
                      {{ $e->enddate ? \Carbon\Carbon::parse($e->enddate)->format('M Y') : 'Present' }}<br>
            Area of Expertise: {{ $e->expartise }}<br>
            Duties: {{ $e->duties }}
        </div>
    @empty
        <em>No experience records</em>
    @endforelse
</td>
 <td>
    @forelse($entry['teachings'] as $ed)
        <div style="margin-bottom: 10px;">
            Teaching areas: {{ $ed->teaching_areas }}<br>
            <strong>{{ $ed->employer }}</strong><br>
            Job Title: {{ $ed->job_title }}<br>
            Country: {{ $ed->country }}, Location: {{ $ed->location }}<br>
            Duration: {{ \Carbon\Carbon::parse($ed->stdate)->format('M Y') }} – 
                      {{ $ed->enddate ? \Carbon\Carbon::parse($ed->enddate)->format('M Y') : 'Present' }}<br>
            Area of Expertise: {{ $ed->expartise }}<br>
            Duties: {{ $ed->duties }}<br>
            @if($ed->teaching_path)
                <a href="{{ asset('/' . $ed->teaching_path) }}" 
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
        <em>No experience records</em>
    @endforelse
</td>

                <!-- Professional Bodies -->
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