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
    <table  id="innovationsuser" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Invent</th>
            <th>Email</th>
            <th>Status</th>
            <th>Online</th>
            <th>Login Time</th>
            <th>Logout Time</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td> <form action="{{ route('update.invent.email', $user->id) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="email" name="email" value="{{ $user->email }}" 
                           class="form-control form-control-sm" required>

                    <button type="submit" class="btn btn-sm btn-success ms-1">
                        Save
                    </button>
                </form></td>
            <td> <form action="{{ route('update.invent.status', $user->id) }}" method="POST">
    @csrf

    <!-- Hidden field for OFF state -->
    <input type="hidden" name="status" value="Inactive">

    <label class="switch">
        <input type="checkbox"
               onchange="this.form.submit()"
               name="status"
               value="Active"
               {{ $user->status === 'Active' ? 'checked' : '' }}>
        <span class="slider round"></span>
    </label>
</form></td>
            <td>{{ $user->is_online ? 'Online' : 'Offline' }}</td>
            <td>{{ $user->login_time }}</td>
            <td>{{ $user->logout_time }}</td>

            <td>
                <a href="{{ route('inventions.details', $user->id) }}" 
                   class="btn btn-sm btn-primary">
                    View Innovations
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}

</div>



    </div>
</div>


@include('Admin.Dashboard.footer')
<style>
/* SWITCH CONTAINER */
.switch {
  position: relative;
  display: inline-block;
  width: 55px;
  height: 28px;
}

/* HIDE DEFAULT CHECKBOX */
.switch input { display:none; }

/* BACKGROUND TRACK */
.slider {
  position: absolute;
  cursor: pointer;
  inset: 0;
  background-color: #dc3545;   /* RED for inactive */
  transition: .4s;
  border-radius: 34px;
}

/* ROUND KNOB */
.slider:before {
  position: absolute;
  content: "";
  height: 22px;
  width: 22px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

/* WHEN CHECKED → GREEN */
input:checked + .slider {
  background-color: #28a745 !important; /* GREEN for active */
}

/* KNOB MOVES RIGHT WHEN CHECKED */
input:checked + .slider:before {
  transform: translateX(27px);
}
</style>