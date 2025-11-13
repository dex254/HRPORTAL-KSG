@include('Invent.Dashboard.header')

<div class="page-content">
    <div class="page-container">
        <div class="container mt-4">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Step 4: Review and Submit</h4>
                </div>

                <div class="card-body">
                    <h5 class="fw-bold">Please review your innovation submission before finalizing:</h5>

                    <ul class="list-group mt-3">
                        <li class="list-group-item"><strong>Title:</strong> {{ session('innovation.title') }}</li>
                        <li class="list-group-item"><strong>Problem:</strong> {!! session('innovation.content') !!}</li>
                        <li class="list-group-item"><strong>Type:</strong> {{ session('innovation.innovation_type') }}</li>
                        <li class="list-group-item"><strong>Link:</strong> {{ session('innovation.link') }}</li>
                        <li class="list-group-item"><strong>Attachment:</strong> {{ session('innovation.attachment') }}</li>
                        <li class="list-group-item"><strong>Evidence:</strong> {{ session('innovation.evidence') }}</li>
                    </ul>

                    <form method="POST" action="{{ route('innovation.final.submit') }}">
                        @csrf
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-danger">Generate PDF Report & Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Invent.Dashboard.footer')
