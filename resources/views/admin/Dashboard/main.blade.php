<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-body">
    
        <!-- ====================== DASHBOARD STAT CARDS ====================== -->
<div class="row mb-4">

    <!-- INTERNAL JOB ADVERTS -->
    <div class="col-md-4">
        <div class="card radius-10" style="background:#0d6efd;color:white;">
            <div class="card-body text-center">
                <h4>Total Internal Job Adverts</h4>
                <h1 style="font-size:55px;font-weight:bold;">{{ $internalJobs }}</h1>
            </div>
        </div>
    </div>

    <!-- EXTERNAL JOB ADVERTS -->
    <div class="col-md-4">
        <div class="card radius-10" style="background:#198754;color:white;">
            <div class="card-body text-center">
                <h4>Total External Job Adverts</h4>
                <h1 style="font-size:55px;font-weight:bold;">{{ $externalJobs }}</h1>
            </div>
        </div>
    </div>

    <!-- ADJUNCT JOB ADVERTS -->
    <div class="col-md-4">
        <div class="card radius-10" style="background:#ffc107;color:black;">
            <div class="card-body text-center">
                <h4>Total Adjunct Job Adverts</h4>
                <h1 style="font-size:55px;font-weight:bold;">{{ $adjunctJobs }}</h1>
            </div>
        </div>
    </div>

</div>


<!-- ====================== APPLICATION COUNTERS ====================== -->
<div class="row mb-4">

    <!-- INTERNAL APPLICATIONS -->
    <div class="col-md-4">
        <div class="card radius-10" style="background:#6610f2;color:white;">
            <div class="card-body text-center">
                <h4>Total Internal Applications</h4>
                <h1 style="font-size:55px;font-weight:bold;">{{ $internalApps }}</h1>
            </div>
        </div>
    </div>

    <!-- EXTERNAL APPLICATIONS -->
    <div class="col-md-4">
        <div class="card radius-10" style="background:#dc3545;color:white;">
            <div class="card-body text-center">
                <h4>Total External Applications</h4>
                <h1 style="font-size:55px;font-weight:bold;">{{ $externalApps }}</h1>
            </div>
        </div>
    </div>

    <!-- ADJUNCT APPLICATIONS -->
    <div class="col-md-4">
        <div class="card radius-10" style="background:#fd7e14;color:white;">
            <div class="card-body text-center">
                <h4>Total Adjunct Applications</h4>
                <h1 style="font-size:55px;font-weight:bold;">{{ $adjunctApps }}</h1>
            </div>
        </div>
    </div>

</div>
<!-- ====================== END DASHBOARD STAT CARDS ====================== -->

           </div>
         </div><!--end row-->
       </div>
</div>