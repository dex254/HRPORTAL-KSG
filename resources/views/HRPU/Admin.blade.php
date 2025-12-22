@include('admin.Dashboard.header')

<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            new bootstrap.Alert(alert).close();
        });
    }, 5000); // 5 seconds
</script>

            <div class="table-responsive">
    <table id="example2" class="table mb-0">
 <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>KEY</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile  no</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @forelse ($hrpu as $index => $user)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $user->upn_no }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->mobile_no }}</td>
    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y, h:i A') }}</td>
    <td>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editEmailModal{{ $user->id }}">
            Update Email
        </button>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">No HRPU users found.</td>
</tr>
@endforelse
        </tbody>









         </table>
</div>
@foreach ($hrpu as $entry)
<div class="modal fade" id="editEmailModal{{ $entry->id }}" tabindex="-1" aria-labelledby="editEmailLabel{{ $entry->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('hrpu.updateEmail', $entry->id) }}">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editEmailLabel{{ $entry->id }}">Update Email for {{ $entry->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="email{{ $entry->id }}" class="form-label">New Email</label>
            <input type="email" class="form-control" name="email" id="email{{ $entry->id }}" value="{{ $entry->email }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update Email</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach


        </div></div></div>
<!-- Include Bootstrap JS if not already -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  


@include('admin.Dashboard.footer')