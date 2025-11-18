@include('Admin.Dashboard.header')

<div class="page-content">
    <div class="page-container">

        <div class="card">
            <div class="card-header border-bottom border-dashed">
                <h4 class="header-title">Invent User Details</h4>
            </div>

            <div class="card-body">

                <!-- USER SECTION -->
                <div class="d-flex align-items-center mb-4">

                    <!-- Profile Picture -->
                    <div>
                        <img src="{{ asset($user->profile ?? 'default.png') }}"
                             alt="Profile Photo"
                             class="rounded-circle"
                             style="width: 120px; height: 120px; object-fit: cover; border: 2px solid #0d6efd;">
                    </div>

                    <!-- User Info -->
                    <div class="ms-4">
                        <h4 class="fw-bold text-primary mb-1">{{ $user->name }}</h4>

                        <p class="mb-1"><strong class="text-primary">Email:</strong> 
                            {{ $user->email }}
                        </p>

                        <p class="mb-1">
                            <strong class="text-primary">Security Key:</strong> 
                            {{ $user->securitykey }}
                        </p>

                        <p class="mb-1">
                            <strong class="text-primary">Total Innovations:</strong> 
                            {{ $innovationCount }}
                        </p>
                    </div>
                </div>

                <hr>

                <!-- INNOVATION TABLE -->
                <h5 class="fw-bold text-primary mb-3">Innovations</h5>

                <div class="table-responsive">
                    <table id="innovationsdetails" class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Innovation Number</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Attachment</th>
                                <th>Evidence</th>
                                <th>Report PDF</th>
                                <th>Link</th>
                                <th>Date</th>
                                <th>Comments</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($innovations as $index => $innovation)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $innovation->innovation_number }}</td>
                                    <td>{{ $innovation->title }}</td>
                                    <td>{{ $innovation->innovation_type }}</td>

                                    <!-- Attachment -->
                                    <td>
    @if($innovation->attachment)
        <a href="{{ asset($innovation->attachment) }}" 
           target="_blank" class="btn btn-sm btn-info">
           View / Download
        </a>
    @else
        N/A
    @endif
</td>

                                    <!-- Evidence -->
                                    <td>
    @if($innovation->evidence)
        <a href="{{ asset($innovation->evidence) }}" 
           target="_blank" class="btn btn-sm btn-success">
           View / Download
        </a>
    @else
        N/A
    @endif
</td>

                                    <!-- Report PDF -->
                                                              <td>
    @if($innovation->report_pdf)
        <a href="{{ asset($innovation->report_pdf) }}" 
           target="_blank" class="btn btn-sm btn-warning">
           View / Download Report
        </a>
    @else
        N/A
    @endif
</td>

                                    <!-- Link -->
                                    <td>
                                        @if($innovation->link)
                                            <a href="{{ $innovation->link }}" 
                                               target="_blank">
                                                {{ $innovation->link }}
                                            </a>
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td>{{ $innovation->created_at->format('d M Y') }}</td>
                                    <td>{{ $innovation->comments ?? 'N/A' }}</td>
                                    <td>{{ $innovation->status}}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">No innovations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@include('Admin.Dashboard.footer')
