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
                                                <td>{{ $extjobs->Designation }}</td>
                                            </tr>
                                            <tr>
                                                <th>Job Group</th>
                                                <td>{{ $extjobs->Job_Group }}</td>
                                            </tr>
                                            <tr>
                                                <th>Proposed No. of Positions</th>
                                                <td>{{ $extjobs->Proposed_No_of_Positions }}</td>
                                            </tr>
                                            <tr>
                                                <th>AE</th>
                                                <td>{{ $extjobs->AE }}</td>
                                            </tr>
                                            <tr>
                                                <th>IP</th>
                                                <td>{{ $extjobs->IP }}</td>
                                            </tr>
                                            <tr>
                                                <th>Var</th>
                                                <td>{{ $extjobs->Var }}</td>
                                            </tr>
                                            <tr>
                                                <th>Reference Number</th>
                                                <td>{{ $extjobs->Ref_NO }}</td>
                                            </tr>
                                            <tr>
                                                <th>Start Date</th>
                                                <td>{{ \Carbon\Carbon::parse($extjobs->datefrom)->format('d M, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Deadline</th>
                                                <td>{{ \Carbon\Carbon::parse($extjobs->deadline)->format('d M, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <span class="badge bg-{{ $extjobs->status == 'Open' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($extjobs->status) }}
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
                <form action="{{ route('EXT.Update.ext', ['id' => $extjobs->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="Designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" name="Designation" value="{{ $extjobs->Designation }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="Job_Group" class="form-label">Job Group</label>
                            <select class="form-select" name="Job_Group" required>
                                <option value="">-- Select Job Group --</option>
                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="KSG{{ $i }}" {{ $extjobs->Job_Group == "KSG$i" ? 'selected' : '' }}>KSG{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                                 <div class="col-md-6">
    <label>Level</label>
    <style>
        .custom-select {
            background-color: white;
            color: black;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-select:focus {
            border-color: rgb(127, 98, 44);
            outline: none;
            box-shadow: 0px 0px 5px rgba(127, 98, 44, 0.5);
        }
    </style>
    <select class="custom-select" name="level" id="levelOfEducation" required>
        <option value="">Select Level</option>
        <option value="O level" {{ $extjobs->level == 'O level' ? 'selected' : '' }}>O level</option>
        <option value="A level" {{ $extjobs->level == 'A level' ? 'selected' : '' }}>A level</option>
        <option value="Certificate" {{ $extjobs->level == 'Certificate' ? 'selected' : '' }}>Certificate</option>
        <option value="Diploma" {{ $extjobs->level == 'Diploma' ? 'selected' : '' }}>Diploma</option>
        <option value="Bachelor's Degree" {{ $extjobs->level == "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
        <option value="Master's Degree" {{ $extjobs->level == "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
        <option value="Doctorate" {{ $extjobs->level == 'Doctorate' ? 'selected' : '' }}>Doctorate (PhD)</option>
        <option value="Other" {{ $extjobs->level == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
</div>

                        <div class="col-md-6">
                            <label for="Proposed_No_of_Positions" class="form-label">Proposed No of Positions</label>
                            <input type="number" class="form-control" name="Proposed_No_of_Positions" value="{{ $extjobs->Proposed_No_of_Positions }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="AE" class="form-label">AE</label>
                            <input type="text" class="form-control" name="AE" value="{{ $extjobs->AE }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="IP" class="form-label">IP</label>
                            <input type="text" class="form-control" name="IP" value="{{ $extjobs->IP }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="Var" class="form-label">Var</label>
                            <input type="text" class="form-control" name="Var" value="{{ $extjobs->Var }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="Ref_NO" class="form-label">Reference Number</label>
                            <input type="text" class="form-control" name="Ref_NO" value="{{ $extjobs->Ref_NO }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="datefrom" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="datefrom" value="{{ $extjobs->datefrom }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" name="deadline" value="{{ $extjobs->deadline }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="Open" {{ $extjobs->status == 'Open' ? 'selected' : '' }}>Open</option>
                                <option value="Closed" {{ $extjobs->status == 'Closed' ? 'selected' : '' }}>Closed</option>
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
