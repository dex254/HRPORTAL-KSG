@include('Invent.Dashboard.header')

<div class="page-content">
    <div class="page-container">
        <div class="card">
            <div class="card-header border-bottom border-dashed">
                <h4 class="header-title">My Innovations</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
    <table id="innovationsTable" class="table table-striped table-bordered mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Innovation Number</th>
                <th>Title</th>
                <th>Ministry, Industry, Agency, or State Department</th>
                <th>Content</th>
                <th>Type</th>
                <th>Attachment</th>
                <th>Evidence</th>
                <th>Innovation Report</th>
                <th>Link</th>
                <th>Submitted At</th>
                <th>Comments</th>
                <th>Status</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($innovations as $index => $innovation)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $innovation->innovation_number }}</td>
                    <td>{{ $innovation->title }}</td>
                    <td>{{ $innovation->industry }}</td>
                    <td>{!! $innovation->content !!}</td>
                    <td>{{ $innovation->innovation_type ?? 'N/A' }}</td>
                    <td>
                        @if($innovation->attachment)
                            <a href="{{ asset($innovation->attachment) }}" target="_blank" class="btn btn-sm btn-info">View / Download</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($innovation->evidence)
                            <a href="{{ asset($innovation->evidence) }}" target="_blank" class="btn btn-sm btn-success">View / Download</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($innovation->report_pdf)
                            <a href="{{ asset($innovation->report_pdf) }}" target="_blank" class="btn btn-sm btn-warning">View / Download Report</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($innovation->link)
                            <a href="{{ $innovation->link }}" target="_blank">{{ $innovation->link }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $innovation->created_at->format('d M Y, h:i A') }}</td>
                    <td>{{ $innovation->comments ?? 'N/A' }}</td>
                    <td>{{ $innovation->status }}</td>
                    <td>
                        <a href="{{ route('innovation.edit', $innovation->id) }}" class="btn btn-sm btn-warning">Update</a>
                    </td>
                    <td>
                        <form action="{{ route('innovation.delete', $innovation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this innovation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="15" class="text-center text-muted">No innovations submitted yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

            </div>
        </div>
    </div>
</div>

@include('Invent.Dashboard.footer')
