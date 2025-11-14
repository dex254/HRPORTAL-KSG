@include('Invent.Dashboard.header')

<div class="page-content">
    <div class="page-container">

        <div class="container mt-4">

            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h4 class="header-title">Innovation Submission Process</h4>
                </div>

                <div class="card-body">

                    <!-- Instructions -->
                    <div class="alert alert-info">
                        <h5 class="fw-bold">Instructions</h5>
                        <p>
                            You are about to begin the <strong>Innovation Submission Process</strong>.
                            This process contains <strong>3 steps</strong>:
                        </p>
                        <ol>
                            <li><strong>Step 1:</strong> State the problem you’re solving</li>
                            <li><strong>Step 2:</strong> Provide innovation details & upload an attachment</li>
                            <li><strong>Step 3:</strong> Upload supporting evidence</li>
                        </ol>
                        <p class="mt-2">
                            Click the button below to start Step 1.
                        </p>
                    </div>

                    <!-- Start Button -->
                    <div class="text-center mt-3">
                        <a href="{{ route('innovation.step1') }}" class="btn btn-primary btn-lg">
                            Start Innovation Submission
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@include('Invent.Dashboard.footer')
