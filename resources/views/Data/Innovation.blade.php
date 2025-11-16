@include('Admin.Dashboard.header')


<div class="page-content">
    <div class="page-container">

        <div class="card">
            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                <h4 class="header-title">Invent Innovations Dashboard</h4>
            </div>

            <div class="card-body">
                <p class="text-muted">List of invent users and their innovations based on security key.</p>

              <div class="table-responsive">
    <table id="innovationTable" class="table table-striped table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Invent</th>
                <th>Email</th>
                <th>Status</th>
                <th>Online</th>
                <th>Login Time</th>
                <th>Logout Time</th>
                <th>Innovation #</th>
                <th>Title</th>
                <th>Type</th>
                <th>Attachment</th>
                <th>Link</th>
                <th>Evidence</th>
                <th>Report PDF</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                @if($user->innovations->count())
                    @foreach($user->innovations as $innovation)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $user->is_online ? 'Online' : 'Offline' }}</td>
                            <td>{{ $user->login_time ? $user->login_time->format('d M Y, h:i A') : 'Never' }}</td>
                            <td>{{ $user->logout_time ? $user->logout_time->format('d M Y, h:i A') : '—' }}</td>

                            <td>{{ $innovation->innovation_number }}</td>
                            <td>{{ $innovation->title }}</td>
                            <td>{{ $innovation->innovation_type }}</td>
                            
                               <td>
                    @if($innovation->attachment)
                        <a href="{{ asset(
                            str_starts_with($innovation->attachment, 'storage/')
                            ? $innovation->attachment
                            : 'storage/' . $innovation->attachment
                        ) }}"
                        target="_blank"
                        class="btn btn-sm btn-info">
                            View / Download
                        </a>
                    @else
                        N/A
                    @endif
                            </td>
                            <td>
                                @if($innovation->link)
                                    <a href="{{ $innovation->link }}" target="_blank">Link</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td> @if($innovation->evidence)
                        <a href="{{ asset(
                            str_starts_with($innovation->evidence, 'storage/')
                            ? $innovation->evidence
                            : 'storage/' . $innovation->evidence
                        ) }}"
                        target="_blank"
                        class="btn btn-sm btn-success">
                            View / Download
                        </a>
                    @else
                        N/A
                    @endif</td>
                            <td>
                               @if($innovation->report_pdf)
                        <a href="{{ asset(
                            str_starts_with($innovation->report_pdf, 'storage/')
                            ? $innovation->report_pdf
                            : 'storage/' . $innovation->report_pdf
                        ) }}"
                        target="_blank"
                        class="btn btn-sm btn-warning">
                            View / Download Report
                        </a>
                    @else
                        N/A
                    @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $user->is_online ? 'Online' : 'Offline' }}</td>
                        <td>{{ $user->login_time ? $user->login_time->format('d M Y, h:i A') : 'Never' }}</td>
                        <td>{{ $user->logout_time ? $user->logout_time->format('d M Y, h:i A') : '—' }}</td>
                        <td colspan="7" class="text-center text-muted">No innovations found</td>
                    </tr>
                @endif
            @empty
                <tr>
                    @for($i=0; $i<13; $i++)
                        <td class="text-center text-muted">—</td>
                    @endfor
                </tr>
            @endforelse
        </tbody>
    </table>
</div>



    </div>
</div>


@include('Admin.Dashboard.footer')
