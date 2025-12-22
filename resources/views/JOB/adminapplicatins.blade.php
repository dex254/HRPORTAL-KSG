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

@include('admin.Dashboard.footer')

