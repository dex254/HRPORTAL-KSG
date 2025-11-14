@include('Invent.Dashboard.header')

<div class="page-content">
    <div class="page-container">
        <div class="container mt-4">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Step 1: State the Problem You’re Trying to Solve</h4>
                </div>

                <div class="card-body">
                    <form id="problemForm" method="POST" action="{{ route('innovation.step.store') }}">
                        @csrf
                         <input type="hidden" name="step" value="step1">
                        <input type="hidden" name="securitykey" value="{{ Auth::guard('invent')->user()->securitykey }}">

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter title here" required>
                        </div>

                        <p class="text-muted mb-2">Describe your problem below:</p>
                        <div id="snow-editor" style="height: 300px; border: 1px solid #ddd; border-radius: 5px;"></div>
                        <input type="hidden" name="content" id="hidden-content">

                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary">Next Step</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const quill = new Quill('#snow-editor', { theme: 'snow' });
                document.getElementById('problemForm').onsubmit = function () {
                    document.getElementById('hidden-content').value = quill.root.innerHTML;
                };
            });
        </script>
    </div>
</div>

@include('Invent.Dashboard.footer')
