@include('admin.Dashboard.header')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Job Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">Job Details</h5>
                                    <br>
                                    <br>
                                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#updateJobModal">
                                        Update Job Details
                                    </button>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Designation</th>
                                                <td>{{ $jobexts->Designation }}</td>
                                            </tr>
                                            <tr>
                                                <th>Job Group</th>
                                                <td>{{ $jobexts->Job_Group }}</td>
                                            </tr>
                                            <tr>
                                                <th>Proposed No. of Positions</th>
                                                <td>{{ $jobexts->Proposed_No_of_Positions }}</td>
                                            </tr>
                                            <tr>
                                                <th>AE</th>
                                                <td>{{ $jobexts->AE }}</td>
                                            </tr>
                                            <tr>
                                                <th>IP</th>
                                                <td>{{ $jobexts->IP }}</td>
                                            </tr>
                                            <tr>
                                                <th>Var</th>
                                                <td>{{ $jobexts->Var }}</td>
                                            </tr>
                                            <tr>
                                                <th>Reference Number</th>
                                                <td>{{ $jobexts->Ref_NO }}</td>
                                            </tr>
                                            <tr>
                                                <th>Start Date</th>
                                                <td>{{ \Carbon\Carbon::parse($jobexts->datefrom)->format('d M, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Deadline</th>
                                                <td>{{ \Carbon\Carbon::parse($jobexts->deadline)->format('d M, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <span class="badge bg-{{ $jobexts->status == 'Open' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($jobexts->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</div>
<!--end wrapper--><div class="modal fade" id="updateJobModal" tabindex="-1" aria-labelledby="updateJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateJobModalLabel">Update Job Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('JOB.update', ['s_no' => $jobexts->s_no]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="Designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" name="Designation" value="{{ $jobexts->Designation }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="Job_Group" class="form-label">Job Group</label>
                            <select class="form-select" name="Job_Group" required>
                                <option value="">-- Select Job Group --</option>
                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="KSG{{ $i }}" {{ $jobexts->Job_Group == "KSG$i" ? 'selected' : '' }}>KSG{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="Proposed_No_of_Positions" class="form-label">Proposed No of Positions</label>
                            <input type="number" class="form-control" name="Proposed_No_of_Positions" value="{{ $jobexts->Proposed_No_of_Positions }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="AE" class="form-label">AE</label>
                            <input type="text" class="form-control" name="AE" value="{{ $jobexts->AE }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="IP" class="form-label">IP</label>
                            <input type="text" class="form-control" name="IP" value="{{ $jobexts->IP }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="Var" class="form-label">Var</label>
                            <input type="text" class="form-control" name="Var" value="{{ $jobexts->Var }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="Ref_NO" class="form-label">Reference Number</label>
                            <input type="text" class="form-control" name="Ref_NO" value="{{ $jobexts->Ref_NO }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="datefrom" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="datefrom" value="{{ $jobexts->datefrom }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" name="deadline" value="{{ $jobexts->deadline }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="Open" {{ $jobexts->status == 'Open' ? 'selected' : '' }}>Open</option>
                                <option value="Closed" {{ $jobexts->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.Dashboard.footer')
