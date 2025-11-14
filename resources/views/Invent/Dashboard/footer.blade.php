<footer class="footer">
                <div class="page-container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start">
                            <script>document.write(new Date().getFullYear())</script> © Boron - By <span class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Coderthemes</span>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-md-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
   

    <!-- Vendor js -->
    <script src="{{asset('') }}assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{asset('') }}assets/js/app.js"></script>

    <!-- Apex Chart js -->
    <script src="{{asset('') }}assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Projects Analytics Dashboard App js -->
    <script src="{{asset('') }}assets/js/pages/dashboard-sales.js"></script>
    <!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- DataTables Buttons -->
<script src="{{ asset('datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('datatables/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('datatables/js/jszip.min.js') }}"></script>
<script src="{{ asset('datatables/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('datatables/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('datatables/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('datatables/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('datatables/js/buttons.colVis.min.js') }}"></script>
<script>
$(document).ready(function() {
    var table = $('#agentsTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    });

    // Place buttons properly on top
    table.buttons().container()
        .appendTo('#agentsTable_wrapper .col-md-6:eq(0)');
});
</script>
<script>
$(document).ready(function() {
    var table = $('#innovationsTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    });

    // Place buttons on top
    table.buttons().container()
        .appendTo('#innovationsTable_wrapper .col-md-6:eq(0)');
});
</script>
   

</body>

</html>
