@include('staff.Dashboard.header')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Programs</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All programs in ksg</li>
                        </ol>
                    </nav>
                </div>
               
            </div> <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                   
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
    
      <th >Programs#</th>
      <th>Program Name</th>
      <th >Program Serial Number</th>
      <th>Campus</th>
     
      <th >Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($programs as $program)
    <tr>
      <td>{{ $program->id }}</td>
      <td>{{ $program->proname }}</td>
      <td>{{ $program->code }}</td>
      <td>{{ $program->campus }}</td>
      
      <td>
        @if ($program->status === 'Available')
        <span class="badge bg-success">Available</span>
        @elseif ($program->status === 'Unavailable')
        <span class="badge bg-dark">Unavailable</span>
        @endif
      </td>
      <td>
        <div class="d-flex order-actions">
          <a href="{{ route('program.protopicslec', ['code' => $program->code]) }}" 
              class="ms-3" 
              data-bs-toggle="tooltip" 
              data-bs-placement="top" 
              title="Add" 
              onclick="confirmChangePassword('{{ $program->code }}');">
               <i class="bx bxs-edit"></i>
           </a>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>Programs#</th>
      <th>Program Name</th>
      <th>Program Serial Number</th>
      <th>Campus</th>
      <th>Status</th>
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

@include('staff.Dashboard.footer')

