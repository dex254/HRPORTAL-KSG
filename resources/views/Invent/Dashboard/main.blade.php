


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
                                             <h3 class="mb-0 fw-bold">{{ $innovationCount }}</h3>
                                        </div>
                                       
                                    </div>
                                </div>
    
                        </div>
                        
                    </div> <!-- end col -->
                </div> <!-- end row -->
                

                       

                    </div> <!-- end col-->

                   
                </div> <!-- end row-->

            </div> <!-- container -->

            <!-- Footer Start -->
 


