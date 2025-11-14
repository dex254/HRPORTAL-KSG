@include('Invent.Dashboard.header')

<div class="page-content">
    <div class="page-container">
        <div class="container mt-4">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Step 3: Upload Evidence / Proof of Ownership</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('innovation.step.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden field to identify step -->
                        <input type="hidden" name="step" value="step3">

                        

                        <div class="mb-3">
                            <label class="form-label fw-bold">Upload Evidence</label>
                            <input type="file" name="evidence" class="form-control" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" required>
                            <small class="text-muted">Maximum file size: 10 MB</small>
                        </div>

                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary">Next Step</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Invent.Dashboard.footer')
