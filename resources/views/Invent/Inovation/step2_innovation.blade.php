@include('Invent.Dashboard.header')

<div class="page-content">
    <div class="page-container">
        <div class="container mt-4">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Step 2: Innovation Details</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('innovation.step.store') }}" enctype="multipart/form-data">
                        @csrf
                           <input type="hidden" name="step" value="step2">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Type of Innovation</label>
                            <input type="text" name="innovation_type" class="form-control" placeholder="Enter innovation type" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Attachment</label>
                            <input type="file" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Link (if any)</label>
                            <input type="url" name="link" class="form-control" placeholder="https://example.com">
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
