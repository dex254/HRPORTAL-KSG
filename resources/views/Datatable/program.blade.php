@include('Admissions.Dashboard.header')

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
                                <a href="#"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All programs Members</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-light">Upload to create</button>
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            
                            <a class="dropdown-item" href="/Upload_programs_in_exell">Programs Excel</a>
                            
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/Upload_Topics_in_exell">Toics Excel</a>
                        </div>
                    </div>
                </div>
            </div> <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            <a href="/program/admin" class="btn btn-light radius-30 mt-2 mt-lg-0">
                                <i class="bx bxs-plus-square"></i>Add New programs
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
                      <!-- Search Bar -->
                      <div class="table-responsive">
                        <table id="example2" class="table mb-0">
                            <thead class="table-light">
                                <tr>
        <th onclick="sortTable(0)">Programs#</th>
        <th onclick="sortTable(1)">Program Name</th>
        <th onclick="sortTable(2)">Program Serial Number</th>
        <th onclick="sortTable(3)">Campus</th>
        <th onclick="sortTable(4)">Date Created</th>
        <th onclick="sortTable(5)">Status</th>
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
        <td>{{ $program->prodate }}</td>
        <td>
          @if ($program->status === 'Available')
          <span class="badge bg-success">Available</span>
          @elseif ($program->status === 'Unavailable')
          <span class="badge bg-dark">Unavailable</span>
          @endif
        </td>
        <td>
          <div class="d-flex order-actions">
            <a href="{{ route('program.protopics', ['code' => $program->code]) }}" 
                class="ms-3" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                title="Add" 
                onclick="confirmChangePassword('{{ $program->code }}');">
                 <i class="bx bxs-edit"></i>
             </a>
             <a href="javascript:;" class="ms-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" onclick="confirmDelete({{ $program->id }});"><i class='bx bxs-trash'></i></a>
             <form id="delete-form-{{ $program->id }}" action="{{ route('program.delete', $program->id) }}" method="POST" style="display: none;">
                 @csrf
                 @method('DELETE')
             </form>
             <script>
              function confirmDelete(id) {
                  // Prompt the user to confirm deletion
                  if (confirm('Are you sure you want to delete this program?')) {
                      // Submit the form associated with the program to delete
                      document.getElementById('delete-form-' + id).submit();
                  }
              }
          </script>
          
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
        <th>Date Created</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
  
  <script>
  // Real-time search across specific columns (Program Name, Program Code, Program ID)
  function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("program");  // Updated table ID
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) { // Start from index 1 to skip header row
      td = tr[i].getElementsByTagName("td");
      var rowMatches = false; // Flag to check if any cell in the row matches
  
      // Loop through columns Program Name, Program Code, Program ID (columns 1, 2, 0)
      for (var j = 0; j < 3; j++) { // Loop only through the first 3 columns
        var cell = td[j]; // Get the value in the specified column
        if (cell) {
          txtValue = cell.textContent || cell.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            rowMatches = true;
            break; // No need to check further columns if one matches
          }
        }
      }
  
      // Display or hide row based on match
      if (rowMatches) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
  
  // Column specific filtering (Campus and Status columns)
  function filterColumn(colIndex) {
    var filter, table, tr, td, i, txtValue;
    var select = document.getElementById(`filter${getColumnName(colIndex)}`);
    filter = select.value;
    table = document.getElementById("program");  // Updated table ID
    tr = table.getElementsByTagName("tr");
  
    for (i = 1; i < tr.length; i++) { // Start from index 1 to skip header row
      td = tr[i].getElementsByTagName("td");
      var rowMatches = false;
  
      // Check the selected column for a match
      var cell = td[colIndex]; // Get the value in the specified column
      if (cell) {
        txtValue = cell.textContent || cell.innerText;
        if (filter === "" || txtValue.includes(filter)) {
          rowMatches = true;
        }
      }
  
      // Display or hide row based on match
      if (rowMatches) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
  
  // Get the corresponding column name for the dropdown id
  function getColumnName(colIndex) {
    switch (colIndex) {
      case 3: return "Campus"; // Campus filter dropdown
      case 5: return "Status"; // Status filter dropdown
      default: return "";
    }
  }
  
  // Sorting function (for any column)
  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("program");  // Updated table ID
    switching = true;
    dir = "asc"; // Set the sorting direction to ascending
  
    while (switching) {
      switching = false;
      rows = table.rows;
  
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
  
        // Compare values
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        } else if (dir === "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        }
      }
  
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount++;
      } else {
        if (switchcount === 0 && dir === "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
  </script>
  
                    </div>
                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('Admissions.Dashboard.footer')

