


        <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-transparent">
                    <div class="card mb-0 shadow-none">
                        <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                            <i class="ti ti-search fs-22"></i>
                            <input type="search" class="form-control border-0" id="search-modal-input" placeholder="Search for actions, people,">
                            <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">
            {{-- resources/views/components/horizontal-tabs.blade.php --}}
@php
    $activeTab = $activeTab ?? 'home';
@endphp

<style>
.horizontal-tabs {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    width: 100%;
}

.horizontal-tabs .tab {
    position: relative;
    flex: 1; /* flexible width for all tabs */
    height: 50px;
    background-color: #8B4513; /* brown */
    color: #fff;
    font-weight: 500;
    text-align: center;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.horizontal-tabs .tab.active {
    background-color: #006400; /* dark green active */
}

.horizontal-tabs .tab:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -2px; /* overlap small to connect */
    width: 4px; /* vertical spacing for line height */
    height: 4px;
    background-color: #6B3E1C; /* can adjust line color */
    z-index: 0;
    width: 100%; /* full horizontal line */
    height: 4px;
    background-color: #6B3E1C;
    transform: translateY(-50%);
}

.horizontal-tabs a {
    display: block;
    width: 100%;
    height: 100%;
    color: inherit;
    text-decoration: none;
    line-height: 50px;
    z-index: 1;
}

@media (max-width: 768px) {
    .horizontal-tabs {
        flex-direction: column;
        gap: 0.5rem;
    }

    .horizontal-tabs .tab {
        width: 100%;
    }

    .horizontal-tabs .tab:not(:last-child)::after {
        display: none;
    }
}
</style>

<div class="horizontal-tabs">
    <div class="tab {{ $activeTab === 'home' ? 'active' : '' }}">
        <a href="{{ route('Invent.Dashboard') }}">Home</a>
    </div>
    <div class="tab {{ $activeTab === 'problem' ? 'active' : '' }}">
        <a href="{{ route('problem.solve') }}">Problem to Solve</a>
    </div>
    <div class="tab {{ $activeTab === 'innovation' ? 'active' : '' }}">
        <a href="{{ route('innovation') }}">Innovation</a>
    </div>
    <div class="tab {{ $activeTab === 'confirmation' ? 'active' : '' }}">
        <a href="{{ route('confirmation') }}">Confirmation</a>
    </div>
    <div class="tab {{ $activeTab === 'report' ? 'active' : '' }}">
        <a href="{{ route('report') }}">Report</a>
    </div>
    <div class="tab {{ $activeTab === 'my_innovations' ? 'active' : '' }}">
        <a href="{{ route('my.innovations') }}">My Innovations</a>
    </div>
</div>

            <div class="page-container">
                


                <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 text-uppercase fw-bold mb-0"></h4>
                    </div>

                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="/Home">KSG</a></li>

                           
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>




  

                        <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 text-uppercase fw-bold mb-0">My Profile</h4>
                    </div>

                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="/Home">Home</a></li>
                            
                           
                        </ol>
                    </div>
                </div>
                      <div class="row">
                    <div class="col-xl-5 col-lg-12">
                        <div class="card bg-body">
                            <div class="card-body">
                                <!-- Crossfade -->
                                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                   <div id="profileCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner text-center" role="listbox">
        <div class="carousel-item active">
            <img src="{{ Auth::guard('invent')->user()->profile ? asset(Auth::guard('invent')->user()->profile) : asset('assets/images/default-profile.png') }}" 
                 alt="Profile Picture" 
                 class="img-fluid bg-body shadow-none rounded">
        </div>
        {{-- You can add more images if you have multiple profile pics --}}
    </div>

    <div class="carousel-indicators m-0 mt-2 d-lg-flex d-none position-static h-100 rounded gap-1">
        <button type="button" data-bs-target="#profileCarousel" data-bs-slide-to="0" 
                class="h-auto rounded bg-light-subtle border active" 
                style="width: auto !important;">
            <img src="{{ Auth::guard('invent')->user()->profile ? asset(Auth::guard('invent')->user()->profile) : asset('assets/images/default-profile.png') }}" 
                 class="d-block avatar-xl" 
                 alt="Profile Thumbnail">
        </button>
        {{-- Add more thumbnail buttons if needed --}}
    </div>
    
    
</div>

                                </div>
                            </div>
                                                        
                            
                            @php
    $isOnline = Auth::guard('invent')->user()->is_online ?? false;
@endphp

<span class="position-absolute top-0 end-0 p-5 pt-3 z-1">
    <div data-toggler="on">
        <!-- 🌐 Heart Button (Online/Offline) -->
        <button type="button" class="btn btn-icon btn-secondary rounded-circle" data-toggler-on>
            <iconify-icon 
                icon="solar:heart-angle-bold-duotone" 
                class="fs-22 {{ $isOnline ? 'text-neon-green glow' : 'text-dull-gray' }}">
            </iconify-icon>
        </button>
    </div>
</span>

<!-- 🟢 Online/Offline Badge -->
<span class="position-absolute top-0 start-0 p-5 pt-2 z-1">
    @if($isOnline)
        <span class="badge bg-success text-white fs-14 glow-soft">Online</span>
    @else
        <span class="badge bg-danger text-white fs-14">Offline</span>
    @endif
</span>

<!-- ✅ Inline Styles -->
<style>
    /* Heart glow + color states */
    .text-neon-green {
        color: #00ff88 !important;
    }

    .text-dull-gray {
        color: #666 !important;
        opacity: 0.6;
    }

    .glow {
        text-shadow: 0 0 6px #00ff88, 0 0 12px #00ff88, 0 0 18px #00ff88;
        animation: pulseGlow 1.6s infinite alternate;
    }

    @keyframes pulseGlow {
        from { text-shadow: 0 0 4px #00ff88, 0 0 8px #00ff88; }
        to { text-shadow: 0 0 12px #00ff88, 0 0 20px #00ff88; }
    }

    .glow-soft {
        box-shadow: 0 0 8px rgba(0, 255, 100, 0.6);
    }

    /* Button hover */
    .btn-icon:hover iconify-icon {
        transform: scale(1.15);
        transition: all 0.25s ease;
    }

    /* Badge font + placement tweaks */
    .badge {
        padding: 0.4rem 0.8rem;
        font-weight: 600;
        border-radius: 12px;
        letter-spacing: 0.3px;
    }
</style>

                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="bg-body-secondary shadow rounded p-3">
        <form method="POST" action="{{ route('invent.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="securitykey" value="{{ Auth::guard('invent')->user()->securitykey }}">


            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::guard('invent')->user()->name) }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', Auth::guard('invent')->user()->phone) }}" required>
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

           

            <div class="mb-3">
                <label for="profile" class="form-label fw-semibold">Profile Picture</label>
                <input type="file" name="profile" id="profile" class="form-control">
                @if(Auth::guard('invent')->user()->profile)
                    <img src="{{ asset('storage/' . Auth::guard('invent')->user()->profile) }}" alt="Profile Image" class="mt-2 rounded-circle" width="80" height="80">
                @endif
                @error('profile')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Update Profile</button>
            </div>
        </form>
    </div> <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted fs-13 text-uppercase" title="Number of Orders">{{ \Carbon\Carbon::now()->format('F Y') }}</h5>
                                        <div class="d-flex align-items-center justify-content-center gap-2 my-2 py-1">
                                            <div class="user-img fs-42 flex-shrink-0">
                                                <span class="avatar-title text-bg-primary rounded-circle fs-22">
                                                    <iconify-icon icon="solar:case-round-minimalistic-bold-duotone"></iconify-icon>
                                                </span>
                                            </div>
                                            <h3 class="mb-0 fw-bold">Innovations</h3>
                                        </div>
                                        <p class="mb-0 text-muted">
                                            <span class="text-danger me-2"><i class="ti ti-caret-down-filled"></i> 9.19%</span>
                                            <span class="text-nowrap">This month</span>
                                        </p>
                                    </div>
                                </div>
    
                        </div>
                        
                    </div> <!-- end col -->
                </div> <!-- end row -->
                

                        <div class="card-header border-bottom border-dashed d-flex align-items-center">
    <h4 class="header-title">Registered Agents</h4>
</div>
<div class="card-body">
    <p class="text-muted">
        Below is a list of all agents currently registered in the system.
    </p>
    <div class="table-responsive-sm">
        <table id="agentsTable" class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Campus</th>
                    <th>Role</th>
                    <th>Last Login</th>
                    
                </tr>
            </thead>
            <tbody>
                @forelse($invents as $index => $a)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($a->profile)
                                <img src="{{ asset('storage/' . $a->profile) }}" alt="profile"
                                    class="me-2 avatar-sm rounded-circle" />
                            @else
                                <img src="{{ asset('assets/images/users/default-avatar.png') }}"
                                    alt="default" class="me-2 avatar-sm rounded-circle" />
                            @endif
                        </td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->phone }}</td>
                        <td>
                            <span class="badge {{ $a->status === 'Active' ? 'bg-success' : 'bg-danger' }}">
                                {{ $a->status }}
                            </span>
                        </td>
                        <td>{{ $a->campus ?? 'N/A' }}</td>
                        <td>{{ ucfirst($a->role ?? 'N/A') }}</td>
                        <td>{{ $a->login_time ? $a->login_time->format('d M Y, h:i A') : 'Never' }}</td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">No agents found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> <!-- end table-responsive-->
</div>


                    </div> <!-- end col-->

                   
                </div> <!-- end row-->

            </div> <!-- container -->

            <!-- Footer Start -->
 


