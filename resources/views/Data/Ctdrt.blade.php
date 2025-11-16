@include('Admin.Dashboard.header')

<div class="page-content">
    <div class="page-container">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">Nominations</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="ctdrtTable" class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Country</th>
                                <th>County</th>
                                <th>Subcounty</th>
                                <th>Nominee Name</th>
                                <th>Work Station</th>
                                <th>Designation</th>
                                <th>Duties</th>
                                <th>Outstanding Behavior</th>
                                <th>Justification</th>
                                <th>Lessons</th>
                                <th>Attachment</th>
                                <th>IP Address</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nominations as $index => $nomination)
                                <tr>
                                    <td>{{ $nominations->firstItem() + $index }}</td>
                                    <td>{{ $nomination->country }}</td>
                                    <td>{{ $nomination->county }}</td>
                                    <td>{{ $nomination->subcounty }}</td>
                                    <td>{{ $nomination->nominee_name }}</td>
                                    <td>{{ $nomination->work_station }}</td>
                                    <td>{{ $nomination->designation }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($nomination->duties, 50) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($nomination->outstanding_behavior, 50) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($nomination->justification, 50) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($nomination->lessons, 50) }}</td>
                                    <td>
                                        @if($nomination->attachment_path)
                                            <a href="{{ asset('storage/' . $nomination->attachment_path) }}" target="_blank">View</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>{{ $nomination->ip_address ?? '—' }}</td>
                                    <td>{{ $nomination->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-center text-muted py-3">
                                        No nominations found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $nominations->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@include('Admin.Dashboard.footer')
