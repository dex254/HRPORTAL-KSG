
<footer class="page-footer"  id="footer">
	<p class="mb-0">Copyright © <span id="year"></span>. All rights reserved. <span id="datetime"></span></p>

<script>
    function updateDateTime() {
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        const dateTimeString = now.toLocaleString('en-US', options);

        document.getElementById('year').textContent = now.getFullYear();
        document.getElementById('datetime').textContent = dateTimeString;
    }

    // Update date and time on page load
    updateDateTime();
</script>
</footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
</div>
<div class="switcher-body">
	<div class="d-flex align-items-center">
		<h5 class="mb-0 text-uppercase">Hr Customizer</h5>
		<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
	</div>
	<hr/>
	<p class="mb-0"><HR></HR> Texture</p>
	  <hr>
	  
	  <ul class="switcher">
		<li id="theme1"></li>
		
		<li id="theme3"></li>
		
		<li id="theme5"></li>
		<li id="theme6"></li>
	  </ul>
	   <hr>
	  <p class="mb-0">Hr Background</p>
	  <hr>
	  
	  <ul class="switcher">
		<li id="theme7"></li>
		<li id="theme8"></li>
		<li id="theme9"></li>
		<li id="theme10"></li>
		<li id="theme11"></li>
		<li id="theme12"></li>
		<li id="theme13"></li>
		<li id="theme14"></li>
		<li id="theme15"></li>
	  </ul>
</div>
</div>
<!--end switcher-->
<script>
	function searchTable() {
	  // Declare variables
	  var input, filter, table, tr, td, i, j, txtValue;
	  
	  // Get the search input value
	  input = document.getElementById("searchInput");
	  filter = input.value.toUpperCase();  // Convert input to uppercase for case-insensitive comparison
  
	  // Get the campus filter value
	  var campusFilter = document.getElementById("filterCampus").value.toUpperCase(); // Get selected campus (uppercase)
  
	  // Get the table and rows
	  table = document.getElementById("dataTable");
	  tr = table.getElementsByTagName("tr");
  
	  // Loop through all table rows and hide those who don't match the search query or campus filter
	  for (i = 1; i < tr.length; i++) {  // Start from 1 to skip the header row
		td = tr[i].getElementsByTagName("td");
		var rowMatchesSearch = false;  // Flag to check if the row matches the search
		var rowMatchesCampus = true;  // Flag to check if the row matches the campus filter (defaults to true)
  
		// Loop through all columns in the current row for search input
		for (j = 0; j < td.length; j++) {
		  var cell = td[j];
  
		  if (cell) {  // Check if the cell exists
			txtValue = cell.textContent || cell.innerText;
  
			// Skip the campus column (column 3, index 3) from the search input
			if (j !== 3) {  // Column 3 is the campus column (we'll handle it separately)
			  if (txtValue.toUpperCase().indexOf(filter) > -1) {
				rowMatchesSearch = true;  // If a match is found in any column (except campus)
			  }
			}
  
			// Check if campus filter matches (campus column is at index 3)
			if (j === 3 && campusFilter && txtValue.toUpperCase().indexOf(campusFilter) === -1) {
			  rowMatchesCampus = false;  // If campus doesn't match the selected filter
			}
		  }
		}
  
		// Display or hide the row based on both search and campus filter conditions
		if (rowMatchesSearch && rowMatchesCampus) {
		  tr[i].style.display = "";  // Show row if both search and campus filter match
		} else {
		  tr[i].style.display = "none";  // Hide row if any condition doesn't match
		}
	  }
	}
  </script>
  
<!-- Bootstrap JS -->
<script src="{{asset('') }}assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/js/dataTables.min.js') }}"></script>

<!--plugins-->
<script src="{{asset('') }}assets/js/jquery.min.js"></script>
<script src="{{asset('') }}assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{asset('') }}assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{asset('') }}assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{asset('') }}assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{asset('') }}assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{asset('') }}assets/plugins/highcharts/js/highcharts.js"></script>
<script src="{{asset('') }}assets/plugins/highcharts/js/exporting.js"></script>
<script src="{{asset('') }}assets/plugins/highcharts/js/variable-pie.js"></script>
<script src="{{asset('') }}assets/plugins/highcharts/js/export-data.js"></script>
<script src="{{asset('') }}assets/plugins/highcharts/js/accessibility.js"></script>
<script src="{{asset('') }}assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>

<script>
new PerfectScrollbar('.dashboard-top-countries');
</script>
<script src="{{asset('') }}assets/js/dashboard-alternate.js"></script>
<!--app JS-->
<script>
	  
	$(document).ready(function() {
	$('#example').DataTable()
  });
	
  </script>
  
  
  <script>
	  $(document).ready(function() {
		  var table = $('#example2').DataTable( {
			  lengthChange: false,
			  buttons: [ 'copy', 'excel', 'pdf', 'print']
		  } );
	   
		  table.buttons().container()
			  .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
	  } );
  </script>
  <!--app JS-->
  <script src="{{asset('') }}assets/js/app.js"></script>
  <script src="{{asset('') }}assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('') }}assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
</body>


<!-- Mirrored from codervent.com/dashtreme/demo/vertical/dashboard-alternate.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 May 2024 07:17:28 GMT -->
</html>