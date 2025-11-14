@include('Invent.Dashboard.header')

<div class="page-content">
    <div class="page-container">
        <div class="container mt-4">

            <!-- Welcome Message -->
            <div class="alert alert-primary rounded-3 shadow-sm">
                <h4 class="mb-0">Hello, {{ Auth::guard('invent')->user()->name }} 👋</h4>
                <p class="mb-0">You can update your innovation details below. After saving, a new PDF report will be generated.</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between">
                    <h4 class="header-title mb-0">Edit Innovation</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('innovation.update', $innovation->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $innovation->title) }}" required>
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Problem / Content</label>
                            <textarea name="content" class="form-control" rows="5" required>{!! old('content', $innovation->content) !!}</textarea>
                        </div>

                        <!-- Innovation Type -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Type of Innovation</label>
                            <input type="text" name="innovation_type" class="form-control" value="{{ old('innovation_type', $innovation->innovation_type) }}" required>
                        </div>

                        <!-- Link -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Link (Optional)</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link', $innovation->link) }}">
                        </div>

                        <!-- Attachment -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Attachment</label><br>
                            @if($innovation->attachment)
                                <a href="{{ asset($innovation->attachment) }}" target="_blank" class="btn btn-sm btn-info mb-2">
                                    View / Download Current Attachment
                                </a><br>
                            @endif
                            <input type="file" name="attachment" class="form-control">
                            <small class="text-muted">Max 5MB. Upload to replace existing file.</small>
                        </div>

                        <!-- Evidence -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Evidence</label><br>
                            @if($innovation->evidence)
                                <a href="{{ asset($innovation->evidence) }}" target="_blank" class="btn btn-sm btn-success mb-2">
                                    View / Download Current Evidence
                                </a><br>
                            @endif
                            <input type="file" name="evidence" class="form-control">
                            <small class="text-muted">Max 10MB. Upload to replace existing file.</small>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                ✅ Update & Regenerate PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@include('Invent.Dashboard.footer')
