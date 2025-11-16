@include('Admin.Dashboard.header')


<div class="page-content">
    <div class="page-container">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="header-title">Admin  Data</h4>
            </div>

        <div class="card-body">
            <p class="text-muted">
                Below is a list of all admins currently registered in the system.
            </p>

            <div class="table-responsive-sm">
                <table id="adminsTable" class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Dashboard</th>
                            <th>Online</th>
                            <th>Login Time</th>
                            <th>Logout Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($admins as $index => $admin)
                            <tr data-id="{{ $admin->id }}">
                                <td>{{ $index + 1 }}</td>

                                <!-- Profile -->
                                <td>
                                    <img src="{{ $admin->profile ? asset('storage/' . $admin->profile) : asset('assets/images/users/default-avatar.png') }}"
                                        class="rounded-circle avatar-sm" alt="profile">
                                </td>

                                <!-- Name -->
                                <td>{{ $admin->name }}</td>

                                <!-- Editable Email -->
                                <td>
                                    <input type="email" class="form-control email-input" value="{{ $admin->email }}">
                                </td>

                                <td>{{ $admin->phone }}</td>

                                <!-- Status Toggle -->
                                <td>
                                    <input type="checkbox" class="status-toggle" {{ $admin->status ? 'checked' : '' }}>
                                </td>

                                <!-- Role Dropdown -->
                                <td>
                                    <select class="form-select role-select">
                                        <option value="dex" {{ $admin->role == 'dex' ? 'selected' : '' }}>Dex</option>
                                        <option value="Sadmin" {{ $admin->role == 'Sadmin' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="admin_assistant" {{ $admin->role == 'admin_assistant' ? 'selected' : '' }}>Admin Assistant</option>
                                        <option value="user" {{ $admin->role == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </td>

                                <!-- Dashboard Dropdown -->
                                <td>
                                    <select class="form-select dash-select">
                                        <option value="innovation" {{ $admin->dash == 'innovation' ? 'selected' : '' }}>Innovation</option>
                                        <option value="CTDRT" {{ $admin->dash == 'CTDRT' ? 'selected' : '' }}>CTDRT</option>
                                        <option value="dual" {{ $admin->dash == 'dual' ? 'selected' : '' }}>Dual Access</option>
                                    </select>
                                </td>

                                <!-- Online Status -->
                                <td>{{ $admin->is_online ? 'Online' : 'Offline' }}</td>

                                <td>{{ $admin->login_time?->format('d M Y, h:i A') }}</td>
                                <td>{{ $admin->logout_time?->format('d M Y, h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted py-3">
                                    No admins found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@include('Admin.Dashboard.footer')

<script>
$(document).ready(function(){
    // On change for email, role, dashboard, status
    $('#adminsTable').on('change', '.email-input, .status-toggle, .role-select, .dash-select', function(){
        let row = $(this).closest('tr');
        let id = row.data('id');

        let email = row.find('.email-input').val();
        let status = row.find('.status-toggle').is(':checked') ? 1 : 0;
        let role = row.find('.role-select').val();
        let dash = row.find('.dash-select').val();

        $.ajax({
            url: "{{ route('admin.update') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                email: email,
                status: status,
                role: role,
                dash: dash
            },
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Updated',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });
            },
            error: function(xhr){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update admin.',
                });
            }
        });
    });
});
</script>
