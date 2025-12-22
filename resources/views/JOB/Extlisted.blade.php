@include('admin.Dashboard.header')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Job Listings</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Advatised  Jobs</li>
                        </ol>
                    </nav>
                </div>
                
            </div> <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            <a href="/Create_a_new_jod_advart_ext" class="btn btn-light radius-30 mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i>Add  a  new  advart
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
                                    <th>S/NO.</th>
                                    <th>Area</th>
                                    <th>Specialization </th>
                                    <th>Level </th>
                                    <th>Proposed No of Positions</th>
                                    <th>AE</th>
                                    <th>IP</th>
                                    <th>Var</th>
                                    <th>Reference No</th>
                                    <th>Start Date</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobexts as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->area }}</td>
                                    <td>{{ $record->Specialization }}</td>
                                    <td>{{ $record->level }}</td>
                                    <td>{{ $record->Proposed_No_of_Positions }}</td>
                                    <td>{{ $record->AE }}</td>
                                    <td>{{ $record->IP }}</td>
                                    <td>{{ $record->Var }}</td>
                                    <td>{{ $record->Ref_NO }}</td>
                                    <td>{{ $record->datefrom }}</td>
                                    <td>{{ $record->deadline }}</td>
                                    <td>{{ $record->status }}</td>
                                    <td>
   

    <!-- Edit Button -->
      <a  href="{{ route('JOB.Ext.Detail', ['id' => $record->id]) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i> View
                                        </a>
</td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>S/NO.</th>
                                    <th>Area</th>
                                    <th>Specialization </th>
                                    <th>Level </th>
                                    <th>Proposed No of Positions</th>
                                    <th>AE</th>
                                    <th>IP</th>
                                    <th>Var</th>
                                    <th>Reference No</th>
                                    <th>Start Date</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Edit Modal -->


                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('admin.Dashboard.footer')

