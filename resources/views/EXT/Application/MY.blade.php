@include('EXT.Dashboard.header')
@include('EXT.Dashboard.Status')
<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">My applications</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                    </nav>
                </div>
                
            </div> <!--end breadcrumb-->
            <div class="d-flex justify-content-start mt-4">
                <style>
                    /* Previous Button */
                    .previous-btn {
                        background-color: rgb(127, 98, 44);
                        color: white;
                        border: none;
                        padding: 12px 24px;
                        font-size: 16px;
                        cursor: pointer;
                        transition: background-color 0.3s ease, color 0.3s ease;
                        text-decoration: none;
                        display: inline-block;
                        margin: 10px;
                        border-radius: 5px;
                    }
                    
                    .previous-btn:hover {
                        background-color: white;
                        color: rgb(127, 98, 44);
                        border: 1px solid rgb(127, 98, 44);
                    }
                    
                    /* Next Button */
                    .next-btn {
                        background-color: rgb(203, 211, 0);
                        color: black;
                        border: none;
                        padding: 12px 24px;
                        font-size: 16px;
                        cursor: pointer;
                        transition: background-color 0.3s ease, color 0.3s ease;
                        text-decoration: none;
                        display: inline-block;
                        margin: 10px;
                        border-radius: 5px;
                    }
                    
                    .next-btn:hover {
                        background-color: white;
                        color: black;
                        border: 1px solid black;
                    }
                    </style>
                    
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="{{ route('EXT.Report.User') }}" class="previous-btn">Previous</a>
                    
                        <button onclick="location.href='{{ route('EXT.Application.Jobs') }}'" class="next-btn">
                            Next
                        </button>
                    </div>
                    
                
               
            </div>
            <br>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                           
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
                                    <th>Ref No</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Applied On</th>
                                    <th>CV</th>
                                    <th>Bio Data</th>
                                    <th>Cover Letter</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                <tr>
                                    <td>{{ $application->Ref_No }}</td>
                        <td>{{ $application->designation }}</td>
                        <td>
                            <span class="badge badge-{{ $application->status == 'Applied' ? 'success' : 'secondary' }}">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($application->datetime)->format('d M Y, h:i A') }}</td>
                        <td>
                            @if ($application->cv)
                                <a href="{{ asset($application->cv) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fa fa-file-pdf"></i> View CV
                                </a>
                            @else
                                <span class="text-danger">No CV</span>
                            @endif
                        </td>
                        <td>
                            @if ($application->my_bio)
                                <a href="{{ asset($application->my_bio) }}" target="_blank" class="btn btn-dark btn-sm">
                                    <i class="fa fa-file-pdf"></i> View Bio
                                </a>
                            @else
                                <span class="text-danger">No bio</span>
                            @endif
                        </td>
                        <td>
                            @if ($application->cover_letter)
                                <a href="{{ asset($application->cover_letter) }}" target="_blank" class="btn btn-warning btn-sm">
                                    <i class="fa fa-file-pdf"></i> View Cover Letter
                                </a>
                            @else
                                <span class="text-danger">No Cover Letter</span>
                            @endif
                        <td>
                            <a href="{{ route('EXT.Application.Details', ['id' => $application->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i> View Details
                            </a>
                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Ref No</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th>Applied On</th>
                                    <th>CV</th>
                                    <th>Bio Data</th>
                                    <th>Cover Letter</th>
                                    <th>Action</th>
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

@include('EXT.Dashboard.footer')

