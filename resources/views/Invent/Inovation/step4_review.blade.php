@include('Invent.Dashboard.header')

<div class="page-content">
    <div class="page-container">
        <div class="container mt-4">

            <!-- Welcome Message -->
            <div class="alert alert-primary rounded-3 shadow-sm">
                <h4 class="mb-0">Welcome,                                     {{ Auth::guard('invent')->user()->name}} 👋</h4>
                <p class="mb-0">You're on the final step of your innovation submission. Please review all details before finalizing.</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between">
                    <h4 class="header-title mb-0">Step 4: Review & Submit</h4>
                </div>

                <div class="card-body">

                    <!-- Step 1: Problem -->
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header bg-light fw-bold">Step 1: Problem Description</div>
                        <div class="card-body">
                            <p><strong>Title:</strong> {{ $data['step1']['title'] ?? 'N/A' }}</p>
                            <p><strong>Industry:</strong> {!! $data['step1']['industry'] ?? 'N/A' !!}</p>
                            <p><strong>Content:</strong> {!! $data['step1']['content'] ?? 'N/A' !!}</p>
                            <p><strong>Security Key:</strong> {{ $data['step1']['securitykey'] ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Step 2: Innovation Details -->
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header bg-light fw-bold">Step 2: Innovation Details</div>
                        <div class="card-body">
                            <p><strong>Type of Innovation:</strong> {{ $data['step2']['innovation_type'] ?? 'N/A' }}</p>
                            <p><strong>Link:</strong> 
                                @if(!empty($data['step2']['link']))
                                    <a href="{{ $data['step2']['link'] }}" target="_blank">{{ $data['step2']['link'] }}</a>
                                @else
                                    N/A
                                @endif
                            </p>
                            <p><strong>Attachment:</strong> 
                                @if(!empty($data['step2']['attachment']))
                                    <a href="{{ asset('storage/'.$data['step2']['attachment']) }}" 
                                       target="_blank" class="btn btn-sm btn-info">
                                        View / Download
                                    </a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Step 3: Evidence -->
                    <div class="card mb-3 shadow-sm">
                        <div class="card-header bg-light fw-bold">Step 3: Evidence</div>
                        <div class="card-body">
                            <p><strong>Evidence File:</strong> 
                                @if(!empty($data['step3']['evidence']))
                                    <a href="{{ asset('storage/'.$data['step3']['evidence']) }}" 
                                       target="_blank" class="btn btn-sm btn-success">
                                        View / Download
                                    </a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Final Submit Form -->
                    <form method="POST" action="{{ route('innovation.final.submit') }}" 
                          onsubmit="return confirm('Are you sure you want to submit this innovation? Once submitted, it cannot be edited.');">
                        @csrf
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                ✅ Generate PDF Report & Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@include('Invent.Dashboard.footer')
