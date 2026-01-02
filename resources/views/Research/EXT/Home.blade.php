@include('EXT.Dashboard.header')
@include('EXT.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    Research and Publications & Consultancy in the Public Service
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <!-- Optional Breadcrumbs -->
                    </nav>
                </div>

                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    <strong>Important Notice:</strong> This section is <strong>not mandatory for all applicants</strong>.  
                    Only specific job positions require Research and Publications or Consultancy in the Public Service.  
                    <br><br>
                    If the position you are applying for does not require this information, or if you do not have any
                    relevant records to declare, you may <strong>proceed to the next section</strong>.
                </div>
            </div>
            <!--end breadcrumb-->

            <!-- Navigation Buttons -->
            <div class="ms-auto mb-4">
                <div class="d-flex justify-content-start gap-3">
                    <a href="{{ route('EXT.Special.Licence') }}" class="btn previous-button px-4 py-2">Previous</a>
                    <button onclick="location.href='{{ route('EXT.Ref.User') }}'" class="btn next-button px-4 py-2">Next</button>
                </div>

                <style>
                    .previous-button {
                        background-color: rgb(127, 98, 44);
                        color: white;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }
                    .previous-button:hover {
                        background-color: white;
                        color: rgb(127, 98, 44);
                        border: 1px solid rgb(127, 98, 44);
                    }
                    .next-button {
                        background-color: rgb(203, 211, 0);
                        color: black;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }
                    .next-button:hover {
                        background-color: white;
                        color: black;
                        border: 1px solid black;
                    }
                </style>
            </div>

            <!-- Flash Messages -->
            @if ($errors->any() || session('success') || session('error'))
                <div class="alert alert-{{ $errors->any() ? 'danger' : (session('error') ? 'danger' : 'success') }}" role="alert">
                    @if ($errors->any())
                        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                    @elseif(session('error'))
                        {{ session('error') }}
                    @else
                        {{ session('success') }}
                    @endif
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success" id="success-message">{{ session('status') }}</div>
            @endif

            <!-- Tables Section -->

            <!-- CONSULTANCY ASSIGNMENTS -->
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="fw-bold">Consultancy Assignments</h2>
                        <div class="consultancy-button-wrapper text-center mb-3">
    <!-- Button -->
    <button class="btn add-qualification-button px-4 py-2 shadow" onclick="openModal('academicModal')">
        Add Consultancy Assignments
    </button>

    <!-- Message below button -->
    <p class="button-message mt-2">Click to add Consultancy Assignments</p>
</div>

<style>
/* Neon Green Button */
.add-qualification-button {
    background-color: #39ff14; /* Neon Green */
    color: black; /* Text color for neon contrast */
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 0 10px #39ff14, 0 0 20px #39ff14, 0 0 30px #39ff14;
}

/* Hover effect */
.add-qualification-button:hover {
    background-color: #32cd32; /* Slight darker green */
    color: white;
    box-shadow: 0 0 15px #32cd32, 0 0 30px #32cd32, 0 0 45px #32cd32;
}

/* Message below button */
.button-message {
    font-size: 14px;
    color: #39ff14;
    font-weight: 500;
}
</style>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Client</th>
                                    <th>Sector</th>
                                    <th>Completed</th>
                                    <th>Completion Date</th>
                                    
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($other as $index => $record)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $record->Client }}</td>
                                        <td>{{ $record->Sector }}</td>
                                        <td>{{ $record->completed }}</td>
                                        <td>{{ \Carbon\Carbon::parse($record->compedate)->format('d M Y') }}</td>
                                       
                                        <td>
                                            @if($record->document_name)
                                                <a href="{{ asset('uploads/Other/' . $record->document_name) }}" target="_blank" class="btn btn-sm view-button"><i class="bi bi-book"></i> View</a>
                                            @else
                                                <span class="text-danger">No Document</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('Experience.Researchdestroyotherext', $record->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center text-muted">No records found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- RESEARCH ASSIGNMENTS -->
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="fw-bold">Research Assignments</h2>
                        <div class="research-button-wrapper text-center mb-3">
    <!-- Button -->
    <button class="btn short-course-button px-4 py-2 shadow" onclick="openModal('trainingModal')">
        Add Research Assignment
    </button>

    <!-- Optional message below button -->
    <p class="button-message mt-2">Click to add Research Assignment</p>
</div>

<style>
/* Royal Brown Button */
.short-course-button {
    background-color: #6a3f1d; /* Royal Brown */
    color: white; /* Text color */
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 0 6px #6a3f1d, 0 0 12px #6a3f1d, 0 0 18px #6a3f1d;
}

/* Hover effect */
.short-course-button:hover {
    background-color: #502d15; /* Darker brown on hover */
    color: white;
    box-shadow: 0 0 10px #502d15, 0 0 20px #502d15, 0 0 30px #502d15;
}

/* Message below button */
.button-message {
    font-size: 14px;
    color: #6a3f1d;
    font-weight: 500;
}
</style>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Client</th>
                                    <th>Sector</th>
                                    <th>Completed</th>
                                    <th>Completion Date</th>
                                    <th>Amount</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($others as $index => $record)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $record->Client }}</td>
                                        <td>{{ $record->Sector }}</td>
                                        <td>{{ $record->completed }}</td>
                                        <td>{{ \Carbon\Carbon::parse($record->compedate)->format('d M Y') }}</td>
                                        <td>{{ $record->Amount ?? 'N/A' }}</td>
                                        <td>
                                            @if($record->document_name)
                                                <a href="{{ asset('uploads/Other/' . $record->document_name) }}" target="_blank" class="btn btn-sm view-button"><i class="bi bi-book"></i> View</a>
                                            @else
                                                <span class="text-danger">No Document</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('Experience.Researchdestroyother', $record->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center text-muted">No records found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- PUBLICATIONS -->
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="fw-bold">Publications</h2>
                        <div class="publication-button-wrapper text-center mb-3">
    <button class="btn publication-button px-4 py-2" onclick="openModal('publicationModal')">
        <i class="bi bi-plus-circle"></i> Add Publication
    </button>
    <p class="button-message mt-2">Click to add a Publication</p>
</div>

<style>
/* Royal Navy Blue Button */
.publication-button {
    background-color: #1b3b6f; /* Royal Navy Blue */
    color: white; /* Text color */
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 0 6px #1b3b6f, 0 0 12px #1b3b6f, 0 0 18px #1b3b6f;
}

/* Hover effect */
.publication-button:hover {
    background-color: #142a50; /* Darker navy on hover */
    color: white;
    box-shadow: 0 0 10px #142a50, 0 0 20px #142a50, 0 0 30px #142a50;
}

/* Message below button */
.button-message {
    font-size: 14px;
    color: #1b3b6f;
    font-weight: 500;
}
</style>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Journal / Publisher</th>
                                    <th>Type / Title</th>
                                    <th>Publication Date</th>
                                   
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($publications as $index => $pub)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pub->Client }}</td>
                                        <td>{{ $pub->completed }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pub->compedate)->format('d M Y') }}</td>
                                        
                                        <td>
                                            @if($pub->document_name)
                                                <a href="{{ asset('uploads/Other/' . $pub->document_name) }}" target="_blank" class="btn btn-sm view-button"><i class="bi bi-book"></i> View</a>
                                            @else
                                                <span class="text-danger">No Document</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('Experience.Researchdestroyother', $pub->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this publication?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="text-center text-muted">No publications found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> <!-- page-content -->
    </div> <!-- page-wrapper -->
</div> <!-- wrapper -->

@include('EXT.Dashboard.footer')

<!-- Modals and Scripts -->
@include('EXT.Research.Modals') {{-- You can extract your modals & scripts into a partial for cleaner code --}}
