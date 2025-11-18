@include('Admin.Dashboard.header')

<div class="page-content">
    <div class="page-container">

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">Register Admin User</h4>
                    </div>

                    <div class="card-body">

                        <p class="text-muted">
                            Register a new admin and assign system privileges, roles, and dashboard access.
                        </p>

                        <form action="{{ route('Admin.Create') }}" method="POST">
                            @csrf

                            <div class="row g-2">

                                <!-- Name -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                                </div>

                            </div>

                            <div class="row g-2">

                                <!-- Phone -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
                                </div>

                                <!-- Password -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter secure password" required>
                                </div>

                            </div>

                            <!-- STATUS TOGGLE -->
                            <div class="mb-3">
                                <label class="form-label d-block">Status</label>

                                <label class="switch">
                                    <input type="checkbox" name="status" value="1" checked>
                                    <span class="slider round"></span>
                                </label>

                                <small class="text-muted ms-2">
                                    <span id="statusText" class="text-success fw-bold">Active</span>
                                </small>
                            </div>

                            <!-- Toggle CSS -->
                            <style>
                                .switch {
                                    position: relative;
                                    display: inline-block;
                                    width: 60px;
                                    height: 30px;
                                }
                                .switch input {
                                    opacity: 0;
                                    width: 0;
                                    height: 0;
                                }
                                .slider {
                                    position: absolute;
                                    cursor: pointer;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background-color: #dc3545;
                                    transition: .4s;
                                    border-radius: 34px;
                                }
                                .slider:before {
                                    position: absolute;
                                    content: "";
                                    height: 22px;
                                    width: 22px;
                                    left: 4px;
                                    bottom: 4px;
                                    background-color: white;
                                    transition: .4s;
                                    border-radius: 50%;
                                }
                                input:checked + .slider {
                                    background-color: #28a745;
                                }
                                input:checked + .slider:before {
                                    transform: translateX(28px);
                                }
                            </style>

                            <script>
                                document.querySelector('input[name="status"]').addEventListener('change', function() {
                                    let text = document.getElementById('statusText');
                                    if (this.checked) {
                                        text.textContent = "Active";
                                        text.className = "text-success fw-bold";
                                    } else {
                                        text.textContent = "Pending";
                                        text.className = "text-danger fw-bold";
                                    }
                                });
                            </script>

                            <!-- ROLE SELECT -->
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="dex">Dex</option>
                                    <option value="Sadmin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="admin_assistant">Admin Assistant</option>
                                    <option value="user">User</option>
                                </select>
                            </div>

                            <!-- DASH SELECT -->
                            <div class="mb-3">
                                <label class="form-label">Dashboard Access</label>
                                <select name="dash" class="form-select" required>
                                    <option value="" disabled selected>Select Dashboard</option>
                                    <option value="innovation">Innovation</option>
                                    <option value="CTDRT">CTDRT</option>
                                    <option value="dual">Dual Access</option>
                                </select>
                            </div>
                             <div class="mb-3 col-md-6">
                                   
                                    <input type="hidden" name="created_by" value="{{ Auth::guard('admin')->user()->digitalsignature}}" class="form-control" placeholder="Enter phone number" required>
                                </div>

                            <button type="submit" class="btn btn-primary">Register Admin</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@include('Admin.Dashboard.footer')
