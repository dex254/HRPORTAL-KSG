@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Academic  Qualifications and Short Courses</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    Please provide your academic qualifications  and short courses starting with the most recent .
                </div>
                
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('HR.Dashboard') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>
                
                    <button onclick="location.href='{{ route('Special.ProfessionalBody') }}'" class="btn next-button px-4 py-2">
                        Next
                    </button>
                </div>
                
                <style>
                    /* Previous Button */
                    .previous-button {
                        background-color: rgb(127, 98, 44); /* Requested color */
                        color: white; /* Text color */
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.3s ease, color 0.3s ease;
                    }
                
                    /* Hover effect for Previous Button */
                    .previous-button:hover {
                        background-color: white; /* Turns white on hover */
                        color: rgb(127, 98, 44); /* Text turns to brown */
                        border: 1px solid rgb(127, 98, 44);
                    }
                
                    /* Next Button */
                    .next-button {
                        background-color: rgb(203, 211, 0); /* Requested color */
                        color: black; /* Default text color */
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.3s ease, color 0.3s ease;
                    }
                
                    /* Hover effect for Next Button */
                    .next-button:hover {
                        background-color: white; /* Turns white on hover */
                        color: black; /* Black text on hover */
                        border: 1px solid black;
                    }
                </style>
                
            </div>
            <br>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                       
                        <div class="ms-auto">
                            <div class="d-flex justify-content-start gap-3 mt-4">
                                <button class="btn add-qualification-button text-white px-4 py-2 shadow" onclick="openModal('academicModal')">
                                    Add Academic Qualifications
                                </button>
                                
                                <button type="button" class="btn short-course-button px-4 py-2 shadow" onclick="openModal('trainingModal')">
                                    Add Short Courses
                                </button>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <h2 class="fw-bold">Academic Qualifications</h2>
                            </div>
                            <style>
                                /* Add Academic Qualification Button */
                                .add-qualification-button {
                                    background-color: rgb(127, 98, 44); /* Brown color */
                                    color: white; /* White text */
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: background-color 0.3s ease, color 0.3s ease;
                                }
                            
                                /* Hover effect */
                                .add-qualification-button:hover {
                                    background-color: white; /* Turns white on hover */
                                    color: rgb(127, 98, 44); /* Brown text on hover */
                                    border: 1px solid rgb(127, 98, 44);
                                }
                            
                                /* Add Short Course Button */
                                .short-course-button {
                                    background-color: rgb(203, 211, 0); /* Yellow-green color */
                                    color: black;
                                    border: none;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: background-color 0.3s ease, color 0.3s ease;
                                }
                            
                                /* Hover effect */
                                .short-course-button:hover {
                                    background-color: white;
                                    color: black;
                                    border: 1px solid rgb(203, 211, 0);
                                }
                            </style>
                            
                        </div>
                    </div>
                    @if ($errors->any() || session('success') || session('error'))
    <div class="alert alert-{{ $errors->any() ? 'danger' : (session('error') ? 'danger' : 'success') }}" role="alert">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @elseif (session('error'))
            {{ session('error') }} <!-- Display custom error message -->
        @else
            {{ session('success') }}
        @endif
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success" id="success-message">
        {{ session('status') }}
    </div>
@endif

<!-- General Error Message (For form errors or custom validation errors) -->
@if ($errors->any() || session('error'))
    <div class="alert alert-danger" id="error-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @if (session('error'))
                <li>{{ session('error') }}</li> <!-- Display "already applied" error -->
            @endif
        </ul>
    </div>
@endif

<!-- Style for alert boxes -->
<style>
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: block;
    }

    .alert-success {
        background-color: yellow;
        color: #333;
        border: 1px solid #ccc;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<!-- Flickering effect using JavaScript -->
<script>
    function flickerEffect(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            let visible = true;
            setInterval(() => {
                element.style.visibility = visible ? 'hidden' : 'visible';
                visible = !visible;
            }, 470);
        }
    }

    if (document.getElementById('success-message')) {
        flickerEffect('success-message');
    }

    if (document.getElementById('error-message')) {
        flickerEffect('error-message');
    }
</script>

                    <div class="table-responsive">
                        <table id="example" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                    <th>Institution</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Grade</th>
                    <th>Certificate</th>
                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($academics as $index => $academic)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $academic->institution }}</td>
                                    <td>{{ $academic->course }}</td>
                                    <td>{{ $academic->level }}</td>
                                    <td>{{ date('d M Y', strtotime($academic->stdate)) }}</td>
                                    <td>{{ date('d M Y', strtotime($academic->enddate)) }}</td>
                                    <td>{{ $academic->grade }}</td>
                                    <td>
                                        @if($academic->document_name)
                                        <a href="{{ asset('uploads/Academic/' . $academic->document_name) }}" 
                                            target="_blank" 
                                            class="btn btn-sm view-button">
                                            <i class="bi bi-book"></i> View
                                         </a>
                                         
                                         <style>
                                             /* View Button */
                                             .view-button {
                                                 background-color: rgb(203, 211, 0); /* Yellowish-green color */
                                                 color: black; /* Default text color */
                                                 border: none;
                                                 border-radius: 5px;
                                                 cursor: pointer;
                                                 transition: background-color 0.3s ease, color 0.3s ease;
                                             }
                                         
                                             /* Hover effect */
                                             .view-button:hover {
                                                 background-color: white; /* Turns white on hover */
                                                 color: black; /* Black text on hover */
                                                 border: 1px solid black;
                                             }
                                         </style>
                                         
                                        @else
                                            <span class="text-danger">No Document</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Delete Button -->
                                        <form action="{{ route('academic.destroy', $academic->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">No academic records found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                    <th>Institution</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Grade</th>
                    <th>Certificate</th>
                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                
                <!-- Modal (Hidden by Default) -->
                

                <!-- Popup Modal -->
               <!-- Academic Modal -->
               <div id="academicModal" class="modal">
                <div class="modal-content">
                    <h3 class="modal-title">Add Academic Qualifications</h3>
                    <form action="{{ route('Academic.data') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Fields -->
                        <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                        <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                        <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                        <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                        <input type="hidden" name="Education_type" value="Academic">
            
                        <!-- Input Fields -->
                        <div class="form-group">
                            <label>Level of Education</label>
                            <style>
                                .custom-select {
                                    background-color: white; 
                                    color: black;
                                    border: 1px solid #ccc;
                                    padding: 10px;
                                    font-size: 16px;
                                    width: 100%;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: all 0.3s ease;
                                }
                            
                                .custom-select:focus {
                                    border-color: rgb(127, 98, 44); /* Adds focus effect */
                                    outline: none;
                                    box-shadow: 0px 0px 5px rgba(127, 98, 44, 0.5);
                                }
                            </style>
                            
                            <select class="custom-select" name="level" id="levelOfEducation" required>
                                <option value="">Select Level</option>
                                <option value="O level">O level</option>
                                <option value="A level">A level</option>
                                <option value="Certificate">Certificate</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Bachelor's Degree">Bachelor's Degree</option>
                                <option value="Master's Degree">Master's Degree</option>
                                <option value="Doctorate">Doctorate (PhD)</option>
                                <option value="Other">Other</option>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label>Institution</label>
                            <input type="text" name="institution" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Course Name eg KCSE, Bachelor in Supply  Chain management,Masters  in Business Administration,Doctorate</label>
                            <input type="text" name="course" class="form-control" placeholder="Bachelor in sapply  Chain management" required>
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="stdate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="enddate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Score as per the education level.</label>
                            <input type="text" name="grade" class="form-control" placeholder="B+" >
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
    <label for="formFileMultiple" class="form-label">Certificates (PDF, max 2MB):</label>
    <input class="form-control" type="file" id="pdfUpload" name="document" required accept="application/pdf" />
    <small class="text-muted">Files will be automatically compressed if over 2MB</small>
    <div id="uploadProgress" class="mt-2" style="display:none;">
        <div class="progress">
            <div id="compressionProgress" class="progress-bar" role="progressbar" style="width: 0%"></div>
        </div>
        <p id="statusText" class="small mb-0">Preparing file...</p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.16.0/pdf-lib.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script>
document.getElementById('pdfUpload').addEventListener('change', async function(e) {
    const file = e.target.files[0];
    if (!file) return;
    
    // Show progress bar
    const progressBar = document.getElementById('compressionProgress');
    const statusText = document.getElementById('statusText');
    document.getElementById('uploadProgress').style.display = 'block';
    
    // Check file size (2MB limit)
    if (file.size <= 2 * 1024 * 1024) {
        statusText.textContent = 'File is within size limit (no compression needed)';
        progressBar.style.width = '100%';
        progressBar.classList.add('bg-success');
        return;
    }
    
    try {
        statusText.textContent = 'Reading PDF...';
        progressBar.style.width = '10%';
        
        // Read the file
        const arrayBuffer = await file.arrayBuffer();
        
        statusText.textContent = 'Compressing PDF...';
        progressBar.style.width = '30%';
        
        // Load PDF
        const { PDFDocument } = PDFLib;
        const pdfDoc = await PDFDocument.load(arrayBuffer);
        
        // Simple compression techniques:
        // 1. Remove embedded files
        pdfDoc.getEmbeddedFiles().forEach(file => pdfDoc.removeEmbeddedFile(file));
        
        // 2. Flatten form fields
        const form = pdfDoc.getForm();
        if (form.getFields().length > 0) {
            form.flatten();
        }
        
        // 3. Reduce image quality (if any images exist)
        const pages = pdfDoc.getPages();
        for (let i = 0; i < pages.length; i++) {
            const page = pages[i];
            const images = await page.getImages();
            
            for (const image of images) {
                const embeddedImage = await pdfDoc.embedPng(await image.image.embed());
                page.drawImage(embeddedImage, {
                    x: image.x,
                    y: image.y,
                    width: image.width * 0.9, // Slightly reduce size
                    height: image.height * 0.9,
                    opacity: 1,
                });
            }
        }
        
        statusText.textContent = 'Finalizing compression...';
        progressBar.style.width = '70%';
        
        // Save with compression
        const compressedPdfBytes = await pdfDoc.save({
            useObjectStreams: true,
            // Additional compression options
            useCompression: true,
            // Remove metadata to save space
            removeDefaultInstance: true,
        });
        
        // Check if compression was effective
        if (compressedPdfBytes.length > 2 * 1024 * 1024) {
            throw new Error('Could not compress below 2MB while maintaining quality');
        }
        
        // Create new file with compressed version
        const compressedFile = new File([compressedPdfBytes], file.name, {
            type: 'application/pdf',
            lastModified: Date.now()
        });
        
        // Replace original file in input
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(compressedFile);
        e.target.files = dataTransfer.files;
        
        statusText.textContent = `Compression successful! Final size: ${(compressedPdfBytes.length / 1024 / 1024).toFixed(2)}MB`;
        progressBar.style.width = '100%';
        progressBar.classList.add('bg-success');
        
    } catch (error) {
        console.error('Compression error:', error);
        statusText.textContent = `Error: ${error.message}. Please try a different file.`;
        progressBar.style.width = '100%';
        progressBar.classList.add('bg-danger');
        
        // Clear the file input
        e.target.value = '';
    }
});
</script>

<style>
.progress {
    height: 20px;
    margin-bottom: 5px;
}
.progress-bar {
    transition: width 0.3s ease;
}
</style>
                        </div>
                        <!-- Buttons -->
                        <div class="button-group">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger" onclick="closeModal('academicModal')">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Training Modal -->
            <div id="trainingModal" class="modal">
                <div class="modal-content">
                    <h3 class="modal-title">Add a Short Course</h3>
                    <form action="{{ route('Academic.Training') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Fields -->
                        <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                        <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                        <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                        <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                        <input type="hidden" name="Education_type" value="Training">
            
                        <!-- Input Fields -->
                        <div class="form-group">
                           
                            <input type="hidden" name="level" value="Short  Course">
                        </div>
                        <div class="form-group">
                            <label>Institution</label>
                            <input type="text" name="institution" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Course Name</label>
                            <input type="text" name="course" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="stdate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="enddate" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Score where  applicable eg Distiction/pass</label>
                            <input type="text" name="grade" class="form-control" placeholder="pass" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="formFileMultiple" class="form-label">Certificate (PDF):</label>
                                <input class="form-control" type="file" id="formFileMultiple" name="document" required multiple />
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="button-group">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger" onclick="closeModal('trainingModal')">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
<!-- Buttons to Open Modals -->


<!-- Modal Script -->
<script>
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}
</script>

<!-- Modal Styling -->
<style>
/* Modal Background */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Dimmed background */
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1050;
    padding: 20px; /* Allows content to be centered better */
    overflow-y: auto; /* Enables scrolling if modal is too large */
}

/* Modal Content */
.modal-content {
    width: 80%; /* More adjustable width */
    max-width: 900px; /* Ensures it does not get too wide */
    min-width: 300px; /* Prevents it from being too small */
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    text-align: center;
    max-height: 90vh; /* Prevents modal from exceeding screen height */
    overflow-y: auto; /* Enables internal scrolling if content is long */
}

/* Title Styling */
.modal-title {
    color: black;
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Label Styling */
label {
    color: black;
    display: block;
    text-align: left;
    font-weight: bold;
    margin-top: 10px;
}

/* Form Inputs */
input[type="text"], 
input[type="number"], 
input[type="date"], 
input[type="file"], 
select.form-select {
    color: black !important;
    background-color: white;
    border: 1px solid #ccc;
    padding: 8px;
    width: 100%;
}

/* Button Group */
.button-group {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modal-content {
        width: 95%; /* Makes modal almost full width on small screens */
    }
}
</style>
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                   
                    <div class="ms-auto">
                        <div class="d-flex justify-content-end mt-4">
                            <h2 class="fw-bold">Short  Courses</h2>
                        </div>
                        
                        
                    </div>
                </div>
        <div class="table-responsive">
            <table id="example1" class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
        <th>Institution</th>
        <th>Course</th>
        <th>Level</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Grade</th>
        <th>Certificate</th>
        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trainning as $index => $academic)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $academic->institution }}</td>
                        <td>{{ $academic->course }}</td>
                        <td>{{ $academic->level }}</td>
                        <td>{{ date('d M Y', strtotime($academic->stdate)) }}</td>
                        <td>{{ date('d M Y', strtotime($academic->enddate)) }}</td>
                        <td>{{ $academic->grade }}</td>
                        <td>
                            @if($academic->document_name)
                            <a href="{{ asset('uploads/Academic/' . $academic->document_name) }}" 
                                target="_blank" 
                                class="btn btn-sm btn-success">
                                <i class="bi bi-book"></i> View
                             </a>
                            @else
                                <span class="text-danger">No Document</span>
                            @endif
                        </td>
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('academic.destroy', $academic->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">No academic records found.</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
        <th>Institution</th>
        <th>Course</th>
        <th>Level</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Grade</th>
        <th>Certificate</th>
        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div> 

   
    
    <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HR.Dashboard.footer')

