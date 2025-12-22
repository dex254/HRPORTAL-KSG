@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')
<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Special  info  Page</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                        <ol class="breadcrumb mb-0 p-0">
                            
                            <li class="breadcrumb-item active" aria-current="page">Special</li>
                        </ol>
                    </nav>
                </div>
                
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Experince.data') }}" class="btn btn-danger px-4 py-2 me-3">Previous</a>
                    
                    <button onclick="location.href='{{ route('Special.Coremandate') }}'" class="btn btn-success px-4 py-2">
                        Next
                    </button>
                </div>
            </div>
            <br>
            <br>
            
           
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
<div class="container mt-5">
    <!-- Core Mandate Section -->
    <div class="mb-4">
        <h5>Core Mandate</h5>
        <p class="text-muted">Manage and view core mandate information.</p>
        <div class="d-flex gap-2 align-items-center">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#coreMandateModal">Add Core Mandate</button>
            <button id="toggleTableBtn" class="btn btn-outline-primary">
                <i class="fas fa-eye me-2"></i> <span class="btn-text">View</span> Core Mandates
            </button>
        </div>
        <div id="message" class="alert alert-info" style="display: none;">
            This is your core mandates achieved.
        </div>
    
        <!-- Table (hidden by default) -->
        <table id="coreMandateTable" class="table mb-0" style="display: none;">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>UPN No</th>
                    <th>Email</th>
                    
                    <th>Job Group</th>
                    <th>Core Mandate</th>
                    <th>Selected Count</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Delet</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($coremandate as $item) <!-- Changed variable name to avoid conflict -->
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->upn_no }}</td>
                        <td>{{ $item->email }}</td>
                        
                        <td>{{ $item->job_group ?? 'N/A' }}</td>
                        <td>{{ $item->comandate ?? 'N/A' }}</td>
                        <td>{{ $item->selected_count ?? 'N/A' }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                        <form action="{{ route('coremandate.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    </div>

    <!-- Licenses Section -->
    <div class="mb-4">
        <h5>Licenses</h5>
        <p class="text-muted">Manage and view licenses information.</p>
        <div class="d-flex gap-2 align-items-center">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#licensesModal">Add a License</button>
            <button id="toggleLicensesBtn" class="btn btn-outline-danger">
                <i class="fas fa-eye me-2"></i> <span class="btn-text">View</span> Licenses
            </button>
        </div>
        
<div id="licensesMessage" class="alert alert-info mt-3" style="display: none;">
    This is your licenses data.
</div>
<table id="licensesTable" class="table mb-0 mt-3" style="display: none;">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>UPN No</th>
            <th>Name</th>
            <th>I  have  a  licence</th>
            <th>License Name</th>
            <th>License Date</th>
            <th>Document</th>
            <th>Delet</th>
        </tr>
    </thead>
    <tbody>
        @foreach($licence as $licence)
            <tr>
                <td>{{ $licence->id }}</td>
                <td>{{ $licence->upn_no }}</td>
                <td>{{ $licence->name }}</td>
                <td>{{ $licence->has_license ?? 'N/A' }}</td>
                <td>{{ $licence->license_name ?? 'N/A' }}</td>
                <td>{{ $licence->license_date ?? 'N/A' }}</td>
                <td>
                    @if($licence->document_name)
                    <a href="{{ asset('uploads/Licence/' . $licence->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                        View Document
                    </a>
                @else
                    No Document
                @endif
            
                </td>
                <td>
                <form action="{{ route('licence.destroy', $licence->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>

    <!-- Professional Body Section -->
    <div class="mb-4">
        <h5>Professional Body</h5>
        <p class="text-muted">Manage and view professional body information.</p>
        <div class="d-flex gap-2 align-items-center">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#professionalBodyModal">Add a Professional Body</button>
            <button id="toggleProfessionalBodyBtn" class="btn btn-outline-warning">
                <i class="fas fa-eye me-2"></i> <span class="btn-text">View</span> Professional Body
            </button>
        </div>
        
<!-- Professional Body Table -->
<div id="professionalBodyMessage" class="alert alert-info mt-3" style="display: none;">
    This is your professional body data.
</div>
<table id="professionalBodyTable" class="table mb-0 mt-3" style="display: none;">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>I  am a member</th>
            <th>Profecional body Name</th>
            <th>REGULATING LAW/ STATUTE  </th>
            <th>Status</th>
            <th>Catificate</th>
            <th>Delet</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($profecionalbodies as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->is_member }}</td>
            <td>{{ $data->professional_body}}</td>
            <td>{{ $data->law }}</td>
            <td>{{ $data->status }}</td>
            
            <td>
                @if($data->document_name)
                <a href="{{ asset('uploads/Profecionalbody/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                    View Document
                </a>
            @else
                No Document
            @endif
        
            </td>
            <td>
            <form action="{{ route('Profecionalbody.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    </div>

    <!-- Medical Section -->
    <div class="mb-4">
        <h5>Medical</h5>
        <p class="text-muted">Manage and view medical examination information.</p>
        <div class="d-flex gap-2 align-items-center">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#medicalModal">Add a Medical Examination</button>
            <button id="toggleMedicalBtn" class="btn btn-outline-success">
                <i class="fas fa-eye me-2"></i> <span class="btn-text">View</span> Medical
            </button>
        </div>
        

<!-- Medical Table -->
<div id="medicalMessage" class="alert alert-info mt-3" style="display: none;">
    This is your medical data.
</div>
<table id="medicalTable" class="table mb-0 mt-3" style="display: none;">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Examination  Name</th>
            <th>I have</th>
            <th>Expiry Date</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($medical as $data)
            <tr>
                <td>{{ $data->id }}</td>
                
                <td>{{ $data->name }}</td>
                <td>{{ $data->name_exam }}</td>
                <td>{{ $data->condition ?? 'N/A' }}</td>
                <td>{{ $data->date ?? 'N/A' }}</td>
                <td>
                    @if($data->document_name)
                    <a href="{{ asset('uploads/Medical/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                        View Document
                    </a>
                @else
                    No Document
                @endif
            
                </td>
                <td>
                <form action="{{ route('Medical.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>

    <!-- Association Section -->
    <div class="mb-4">
        <h5>Association</h5>
        <p class="text-muted">Manage and view association information.</p>
        <div class="d-flex gap-2 align-items-center">
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#associationModal">Add an Association</button>
            <button id="toggleAssociationBtn" class="btn btn-outline-info">
                <i class="fas fa-eye me-2"></i> <span class="btn-text">View</span> Association
            </button>
        </div>
        
<!-- Association Table -->
<div id="associationMessage" class="alert alert-info mt-3" style="display: none;">
    This is your association data.
</div>
<table id="associationTable" class="table mb-0 mt-3" style="display: none;">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>My name</th>
            <th>Am i  a member</th>
            <th>Association Name</th>
            <th>Membership  Status</th>
            <th>Document</th>
            <th>Delet</th>
        </tr>
    </thead>
    <tbody>
        @foreach($associations as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->condition}}</td>
            <td>{{ $data->association_name}}</td>
            <td>{{ $data->status }}</td>
            
            <td>
                @if($data->document_name)
                <a href="{{ asset('uploads/Association/' . $data->document_name) }}" target="_blank" class="btn btn-primary btn-sm">
                    View Document
                </a>
            @else
                No Document
            @endif
        
            </td>
            <td>
            <form action="{{ route('Association.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    </div>
    <script>
        // Function to toggle eye icon and button text
        function toggleButton(button) {
            const icon = button.querySelector('i');
            const text = button.querySelector('.btn-text');
    
            if (icon.classList.contains('fa-eye')) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                text.textContent = 'Hide';
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                text.textContent = 'View';
            }
        }
    
        // Add event listeners to all toggle buttons
        document.querySelectorAll('button[id^="toggle"]').forEach(button => {
            button.addEventListener('click', () => toggleButton(button));
        });
    </script>
</div>


<!-- Core Mandate Modal -->
<div class="modal fade" id="coreMandateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title">Core Mandate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <style>
                    .container {
                        background-color: white;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        width: 50%;
                    }
                    h3 {
                        color: #333;
                    }
                    fieldset {
                        border: none;
                        padding: 10px;
                    }
                    legend {
                        font-weight: bold;
                    }
                    textarea {
                        width: 100%;
                        height: 150px;
                        margin-top: 10px;
                        padding: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        background-color: #f9f9f9;
                        resize: none;
                    }
                    button {
                        padding: 10px 15px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 16px;
                    }
                    .btn-secondary {
                        background-color: #ccc;
                        color: black;
                    }
                    .btn-primary {
                        background-color: #007bff;
                        color: white;
                    }
                </style>
                <script>
                    let selectedItems = new Set();
                
                    function addToTextarea(radio, category, number, text) {
                        let textarea = document.getElementById('summary_text');
                        let entry = `${category}:\n${number}. ${text}\n`;
                        let itemKey = `${category}-${number}`;
                
                        // Get current text
                        let currentText = textarea.value;
                
                        // Check if the entry already exists
                        if (!currentText.includes(entry)) {
                            textarea.value += entry;
                            selectedItems.add(itemKey);
                        } else {
                            textarea.value = currentText.replace(entry, '');
                            selectedItems.delete(itemKey);
                        }
                
                        // Update the count of selected items
                        document.getElementById('selected_count').value = selectedItems.size;
                
                        // Keep the selected radio button checked
                        radio.checked = true;
                    }
                </script>
                <div class="modal-body">
                    <p>This is for faculty members to state their core mandate to help the organization achieve its targets.</p>
                    <!-- Add your form or additional content here -->
                </div>
                <h3>1. Publications and Outputs</h3>
                <fieldset>
                    <legend>Publications</legend>
                    <label><input type="radio" id="Publications1" onclick="addToTextarea(this, 'Publications', 1, 'One Postgraduate Level Book on a Public Service Theme')"> 1. One Postgraduate Level Book on a Public Service Theme</label><br>
                    <label><input type="radio" id="Publications2" onclick="addToTextarea(this, 'Publications', 2, 'One accredited curriculum developed / reviewed')"> 2. One accredited curriculum developed / reviewed</label><br>
                    <label><input type="radio" id="Publications3" onclick="addToTextarea(this, 'Publications', 3, 'One Peer-refereed Learning Module')"> 3. One Peer-refereed Learning Module</label><br>
                    <label><input type="radio" id="Publications4" onclick="addToTextarea(this, 'Publications', 4, 'Patented Invention or Innovation 6 Points')"> 4. Patented Invention or Innovation 6 Points</label><br>
                    <label><input type="radio" id="Publications5" onclick="addToTextarea(this, 'Publications', 5, 'One Article in a Peer-reviewed Journal 8 Points')"> 5. One Article in a Peer-reviewed Journal 8 Points</label><br>
                    <label><input type="radio" id="Publications6" onclick="addToTextarea(this, 'Publications', 6, 'One Tertiary Level Scholarly Book 8 Points')"> 6. One Tertiary Level Scholarly Book 8 Points</label><br>
                    <label><input type="radio" id="Publications7" onclick="addToTextarea(this, 'Publications', 7, 'One chapter in Postgraduate Level Book on a Public Service Theme 6 Points')"> 7. One chapter in Postgraduate Level Book on a Public Service Theme 6 Points</label><br>
                    <label><input type="radio" id="Publications8" onclick="addToTextarea(this, 'Publications', 8, 'One Reviewed Conference Paper 4 Points')"> 8. One Reviewed Conference Paper 4 Points</label><br>
                    <label><input type="radio" id="Publications9" onclick="addToTextarea(this, 'Publications', 9, 'One Reviewed Policy Paper 4 Points')"> 9. One Reviewed Policy Paper 4 Points</label><br>
                    <label><input type="radio" id="Publications10" onclick="addToTextarea(this, 'Publications', 10, 'One Secondary School Level Textbook 2 Points')"> 10. One Secondary School Level Textbook 2 Points</label><br>
                    <label><input type="radio" id="Publications11" onclick="addToTextarea(this, 'Publications', 11, 'Short Communication in a Refereed/ Scholarly Journal 2 Points')"> 11. Short Communication in a Refereed/ Scholarly Journal 2 Points</label><br>
                    <label><input type="radio" id="Publications12" onclick="addToTextarea(this, 'Publications', 12, 'Consultancy and Project Reports 8 Points')"> 12. Consultancy and Project Reports 8 Points</label><br>
                    <label><input type="radio" id="Publications13" onclick="addToTextarea(this, 'Publications', 13, 'One public lecture paper successfully delivered 2 Points')"> 13. One public lecture paper successfully delivered 2 Points</label><br>
                    <label><input type="radio" id="Publications14" onclick="addToTextarea(this, 'Publications', 14, 'Any other Book 2 Points')"> 14. Any other Book 2 Points</label><br>
                    <label><input type="radio" id="Publications15" onclick="addToTextarea(this, 'Publications', 15, 'Editorship of a Book or a Journal or Conference Proceedings 10 Points')"> 15. Editorship of a Book or a Journal or Conference Proceedings 10 Points</label><br>
                    <label><input type="radio" id="Publications16" onclick="addToTextarea(this, 'Publications', 16, 'Scholarly Presentations at Conferences/ Workshops/ Seminars')"> 16. Scholarly Presentations at Conferences/ Workshops/ Seminars</label><br>
                    <label><input type="radio" id="Publications17" onclick="addToTextarea(this, 'Publications', 17, 'Book Review Published in Refereed Journals 2 Points')"> 17. Book Review Published in Refereed Journals 2 Points</label><br>
                    <label><input type="radio" id="Publications18" onclick="addToTextarea(this, 'Publications', 18, 'Peer-reviewed Case Study 4 Points')"> 18. Peer-reviewed Case Study 4 Points</label><br>
                    <label><input type="radio" id="Publications19" onclick="addToTextarea(this, 'Publications', 19, 'Expert opinion/working papers/discussion papers')"> 19. Expert opinion/working papers/discussion papers</label><br>
                </fieldset>
                
                <h3>2. Quality Teaching and Instruction</h3>
                <fieldset>
                    <legend>Teaching & Instruction</legend>
                    <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'i', 'Student evaluation of instruction and course')"> i. Student evaluation of instruction and course</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'ii', 'Lecturer notes')"> ii. Lecturer notes</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'iii', 'Student advising and mentoring')"> iii. Student advising and mentoring</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'iv', 'Supervision of examinations')"> iv. Supervision of examinations</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'v', 'Evaluation of research projects or academic papers')"> v. Evaluation of research projects or academic papers</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'vi', 'Coordination of programs')"> vi. Coordination of programs</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'vii', 'Post-graduate supervision')"> vii. Post-graduate supervision</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'viii', 'Any other relevant evidence')"> viii. Any other relevant evidence</label><br>
                </fieldset>
                
                <h3>1.3 Consultancy in the Public Service</h3>
                <fieldset>
                    <legend>Consultancy</legend>
                    <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'i', 'Experience in expert consultancy services in the public service')"> i. Experience in expert consultancy services in the public service</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'ii', 'Development of a successful consultancy proposal')"> ii. Development of a successful consultancy proposal</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'iii', 'Development of a successful grant proposal')"> iii. Development of a successful grant proposal</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'iv', 'Successful consultancy execution with an Exit Report')"> iv. Successful consultancy execution with an Exit Report</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'v', 'Any other relevant evidence')"> v. Any other relevant evidence</label><br>
                </fieldset>
                
                <h3>1.4 Public Outreach Programs</h3>
                <fieldset>
                    <legend>Public Outreach Programs</legend>
                    <label><input type="radio" onclick="addToTextarea(this, 'Public Outreach Programs', 'i', 'Promoting public understanding on Government policies, programs and projects')"> i. Promoting public understanding on Government policies, programs and projects</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Public Outreach Programs', 'ii', 'Uptake of Government legislation, policies and programs')"> ii. Uptake of Government legislation, policies and programs</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Public Outreach Programs', 'iii', 'Impact assessment reports on uptake of government policies, programs and projects')"> iii. Impact assessment reports on uptake of government policies, programs and projects</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Public Outreach Programs', 'iv', 'Any other relevant evidence')"> iv. Any other relevant evidence</label><br>
                </fieldset>
                
                <h3>1.5 Public Sector Administration and Responsibility</h3>
                <fieldset>
                    <legend>Public Sector Administration</legend>
                    <label><input type="radio" onclick="addToTextarea(this, 'Public Sector Administration and Responsibility', 'i', 'Recognized school/public sector administrative positions')"> i. Recognized school/public sector administrative positions</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Public Sector Administration and Responsibility', 'ii', 'Other responsibilities')"> ii. Other responsibilities</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Public Sector Administration and Responsibility', 'iii', 'Any other relevant evidence')"> iii. Any other relevant evidence</label><br>
                </fieldset>
                
                <h3>1.6 Distinguished Service Award</h3>
                <fieldset>
                    <legend>Distinguished Service Award</legend>
                    <label><input type="radio" onclick="addToTextarea(this, 'Distinguished Service Award', 'i', 'Awards and Honors')"> i. Awards and Honors</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Distinguished Service Award', 'ii', 'Recognition for innovation')"> ii. Recognition for innovation</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Distinguished Service Award', 'iii', 'Excellence in service delivery')"> iii. Excellence in service delivery</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Distinguished Service Award', 'iv', 'Any other relevant evidence')"> iv. Any other relevant evidence</label><br>
                </fieldset>
                
                <h3>1.7 Community Engagement and Other Contributions</h3>
                <fieldset>
                    <legend>Community Engagement</legend>
                    <label><input type="radio" onclick="addToTextarea(this, 'Community Engagement and Other Contributions', 'i', 'Attracting research and development funding')"> i. Attracting research and development funding</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Community Engagement and Other Contributions', 'ii', 'Professional affiliations and portfolios')"> ii. Professional affiliations and portfolios</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Community Engagement and Other Contributions', 'iii', 'Community service and any other contributions')"> iii. Community service and any other contributions</label><br>
                    <label><input type="radio" onclick="addToTextarea(this, 'Community Engagement and Other Contributions', 'iv', 'Any other relevant evidence')"> iv. Any other relevant evidence</label><br>
                </fieldset>
                
                <form  action="{{ route('Special.Homepost') }}" method="POST">
                    @csrf                    
                    <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                    <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                    <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->job_group }}">
                    <textarea id="summary_text" name="comandate" readonly></textarea>
                    <label for="selected_count">Number of Selected Items:</label>
                    <input type="text" id="selected_count" name="selected_count" readonly>
                    <div class="mt-3 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary"   data-bs-dismiss="modal">Cancel</button>
                       
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- Licenses Modal -->
<div class="modal fade" id="licensesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title">Licenses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="licenseForm" action="{{ route('Licence.licencepost') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- CSRF token for security -->
                    <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                    <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                    <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->job_group }}">
                    <!-- Do you have a professional license? -->
                    <div class="mb-3">
                        <label class="form-label">Do you have any professional license?</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="has_license" id="hasLicenseYes" value="yes">
                                <label class="form-check-label" for="hasLicenseYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="has_license" id="hasLicenseNo" value="no" checked>
                                <label class="form-check-label" for="hasLicenseNo">No</label>
                            </div>
                        </div>
                    </div>
        
                    <!-- License Details (hidden by default) -->
                    <div id="licenseDetails" style="display: none;">
                        <div class="mb-3">
                            <label for="licenseName" class="form-label">License Name</label>
                            <input type="text" class="form-control" id="licenseName" name="license_name">
                        </div>
                        <div class="mb-3">
                            <label for="licenseDate" class="form-label">License Date</label>
                            <input type="date" class="form-control" id="licenseDate" name="license_date">
                        </div>
                        <div class="mb-3">
                            <label for="licenseDocument" class="form-label">Upload License Document</label>
                            <input type="file" class="form-control" id="licenseDocument" name="document">
                        </div>
                    </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const licenseYes = document.getElementById('hasLicenseYes');
                        const licenseNo = document.getElementById('hasLicenseNo');
                        const licenseDetails = document.getElementById('licenseDetails');
            
                        // Toggle license details based on radio button selection
                        licenseYes.addEventListener('change', function () {
                            if (this.checked) {
                                licenseDetails.style.display = 'block';
                            }
                        });
            
                        licenseNo.addEventListener('change', function () {
                            if (this.checked) {
                                licenseDetails.style.display = 'none';
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Professional Body Modal -->
<div class="modal fade" id="professionalBodyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title">Professional Body</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form  action="{{ route('Profecionalbody.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- CSRF token for security -->
                    <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                    <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                    <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->job_group }}">
                    <div class="form-group">
                        <label>Are you a member of any professional body?</label>
                        <div>
                            <input type="radio" name="is_member" id="is_member_yes" value="yes"> Yes
                            <input type="radio" name="is_member" id="is_member_no" value="no"> No
                        </div>
                    </div>
                
                    <!-- Fields to display if the user selects "Yes" -->
                    <div id="member_fields" style="display: none;">
                        <div class="form-group">
                            <label for="professional_body">Select Professional Body:</label>
                            <select class="form-control" id="professional_body" name="professional_body">
                                <option value="">-- Select Professional Body --</option>
                                @foreach($proffecional as $body)
                                    <option value="{{ $body->name }}" data-law="{{ $body->law }}">{{ $body->name }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="form-group">
                            
                            <input type="hidden" class="form-control" id="law" name="law" readonly>
                        </div>
                
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label for="document">Upload Membership Document:</label>
                            <input type="file" class="form-control" id="document" name="document">
                        </div>
                    </div>
                
                    <!-- Submit and Cancel Buttons -->
                    <div class="mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Save</button>
                    </div>
                </form>
                
                <!-- JavaScript to handle dynamic fields -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const isMemberYes = document.getElementById('is_member_yes');
                        const isMemberNo = document.getElementById('is_member_no');
                        const memberFields = document.getElementById('member_fields');
                        const professionalBodySelect = document.getElementById('professional_body');
                        const lawInput = document.getElementById('law');
                
                        // Show/hide fields based on radio button selection
                        isMemberYes.addEventListener('change', function () {
                            if (this.checked) {
                                memberFields.style.display = 'block';
                            }
                        });
                
                        isMemberNo.addEventListener('change', function () {
                            if (this.checked) {
                                memberFields.style.display = 'none';
                            }
                        });
                
                        // Autofill the law field when a professional body is selected
                        professionalBodySelect.addEventListener('change', function () {
                            const selectedOption = this.options[this.selectedIndex];
                            lawInput.value = selectedOption.getAttribute('data-law');
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Medical Modal -->
<div class="modal fade" id="medicalModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title">Medical Examination catificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label for="medicalCondition">Medical Condition:</label>
                <form  action="{{ route('Medical.Create') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- CSRF token for security -->
                    <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                    <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                    <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->job_group }}">
                    <label>Do  you  have eny medical  examination catificate?</label>
                    <br>
                    <div class="radio-container">
                        <label class="radio-label">
                            <input type="radio" name="condition" id="medical_yes" value="yes" onchange="toggleMedicalFields()">
                            <span class="radio-custom"></span>
                            Yes
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="condition" id="medical_no" value="no" onchange="toggleMedicalFields()">
                            <span class="radio-custom"></span>
                            No
                        </label>
                    </div>
                    
                    <style>
                        /* Hide the default radio button */
                        .radio-label input[type="radio"] {
                            display: none;
                        }
                    
                        /* Custom radio button */
                        .radio-custom {
                            display: inline-block;
                            width: 20px;
                            height: 20px;
                            background-color: #fff;
                            border: 2px solid #ccc;
                            border-radius: 4px; /* Smooth edges */
                            margin-right: 8px;
                            position: relative;
                            vertical-align: middle;
                            cursor: pointer;
                            transition: background-color 0.3s, border-color 0.3s;
                        }
                    
                        /* Hover effect */
                        .radio-label:hover .radio-custom {
                            border-color: #007bff;
                        }
                    
                        /* Checked state */
                        .radio-label input[type="radio"]:checked + .radio-custom {
                            background-color: #007bff;
                            border-color: #007bff;
                        }
                    
                        /* Inner dot for checked state */
                        .radio-label input[type="radio"]:checked + .radio-custom::after {
                            content: '';
                            display: block;
                            width: 12px;
                            height: 12px;
                            background-color: white;
                            border-radius: 2px; /* Smooth edges for inner dot */
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                        }
                    
                        /* Container for alignment */
                        .radio-container {
                            display: flex;
                            gap: 16px; /* Space between radio buttons */
                        }
                    
                        /* Label styling */
                        .radio-label {
                            display: flex;
                            align-items: center;
                            font-size: 16px;
                            color: #333;
                            cursor: pointer;
                        }
                    </style>
                    <br>
                
                        <!-- Fields to be shown only if "Yes" is selected -->
                        <div id="medicalFields" style="display: none;">
                            <div  class="form-group">
                                <label for="date">Name  of Medical Examination:</label>
                                <input type="text"  class="form-control" name="name_exam" id="name_exam">
                            </div>
                            <br>
                            <div  class="form-group">
                                <label for="date">Pick a  Date on the  Catificate:</label>
                                <input type="date"  class="form-control" name="date" id="date">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="document">Upload Medical Examination Document:</label>
                                <input type="file" class="form-control" id="document_name" name="document">
                            </div>
                           
                        </div>
                    <div class="mt-3 d-flex justify-content-between">
                        
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
                <script>
                    function toggleMedicalFields() {
                        const medicalFields = document.getElementById('medicalFields');
                        const medicalYes = document.getElementById('medical_yes');
                        const medicalNo = document.getElementById('medical_no');
                
                        if (medicalYes.checked) {
                            medicalFields.style.display = 'block'; // Show fields
                        } else if (medicalNo.checked) {
                            medicalFields.style.display = 'none'; // Hide fields
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Association Modal -->
<div class="modal fade" id="associationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white text-dark">
            <div class="modal-header">
                <h5 class="modal-title">Association</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form  action="{{ route('Association.Create') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- CSRF token for security -->
                    <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                    <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                    <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->job_group }}">
                    <label>Are you a  member  of eny association?</label>
                    <br>
                    <div class="radio-container">
                        <label class="radio-label">
                            <input type="radio" name="condition" id="association_yes" value="yes" onchange="toggleAssociationFields()">
                            <span class="radio-custom"></span>
                            Yes
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="condition" id="association_no" value="no" onchange="toggleAssociationFields()">
                            <span class="radio-custom"></span>
                            No
                        </label>
                    </div>
                    
                    <style>
                        /* Hide the default radio button */
                        .radio-label input[type="radio"] {
                            display: none;
                        }
                    
                        /* Custom radio button */
                        .radio-custom {
                            display: inline-block;
                            width: 20px;
                            height: 20px;
                            background-color: #fff;
                            border: 2px solid #ccc;
                            border-radius: 4px; /* Smooth edges */
                            margin-right: 8px;
                            position: relative;
                            vertical-align: middle;
                            cursor: pointer;
                            transition: background-color 0.3s, border-color 0.3s;
                        }
                    
                        /* Hover effect */
                        .radio-label:hover .radio-custom {
                            border-color: #007bff;
                        }
                    
                        /* Checked state */
                        .radio-label input[type="radio"]:checked + .radio-custom {
                            background-color: #007bff;
                            border-color: #007bff;
                        }
                    
                        /* Inner dot for checked state */
                        .radio-label input[type="radio"]:checked + .radio-custom::after {
                            content: '';
                            display: block;
                            width: 12px;
                            height: 12px;
                            background-color: white;
                            border-radius: 2px; /* Smooth edges for inner dot */
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                        }
                    
                        /* Container for alignment */
                        .radio-container {
                            display: flex;
                            gap: 16px; /* Space between radio buttons */
                        }
                    
                        /* Label styling */
                        .radio-label {
                            display: flex;
                            align-items: center;
                            font-size: 16px;
                            color: #333;
                            cursor: pointer;
                        }
                    </style>
                    <br>
                
                        <!-- Fields to be shown only if "Yes" is selected -->
                        <div id="associationFields" style="display: none;">
                            <div  class="form-group">
                                <label for="date">Name  of  the association:</label>
                                <input type="text"  class="form-control" name="association_name" id="association_name">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="status">State  your  membership  status:</label>
                                <select class="form-control"  name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="document">Upload  Evidence:</label>
                                <input type="file" class="form-control" id="document_name" name="document">
                            </div>
                           
                        </div>
                    <div class="mt-3 d-flex justify-content-between">
                        
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
                <script>
                    function toggleAssociationFields() {
                        const associationFields = document.getElementById('associationFields');
                        const associationYes = document.getElementById('association_yes');
                        const associationNo = document.getElementById('association_no');
                
                        if (associationYes.checked) {
                            associationFields.style.display = 'block'; // Show fields
                        } else if (medicalNo.checked) {
                            associationFields.style.display = 'none'; // Hide fields
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>


<!-- Hidden User Details -->




    <!-- Button to toggle table visibility -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (required for toggle functionality) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    <!-- Message displayed when the table is visible -->
    



</div>

<!-- JavaScript to toggle table visibility -->
<script>
$(document).ready(function () {
    // Core Mandate
    $('#toggleTableBtn').click(function () {
        $('#coreMandateTable').toggle();
        $('#coreMandateMessage').toggle();
        $(this).text($('#coreMandateTable').is(':visible') ? 'Hide Core Mandates' : 'View Core Mandates');
    });

    // Licenses
    $('#toggleLicensesBtn').click(function () {
        $('#licensesTable').toggle();
        $('#licensesMessage').toggle();
        $(this).text($('#licensesTable').is(':visible') ? 'Hide Licenses' : 'View Licenses');
    });

    // Professional Body
    $('#toggleProfessionalBodyBtn').click(function () {
        $('#professionalBodyTable').toggle();
        $('#professionalBodyMessage').toggle();
        $(this).text($('#professionalBodyTable').is(':visible') ? 'Hide Professional Body' : 'View Professional Body');
    });

    // Medical
    $('#toggleMedicalBtn').click(function () {
        $('#medicalTable').toggle();
        $('#medicalMessage').toggle();
        $(this).text($('#medicalTable').is(':visible') ? 'Hide Medical' : 'View Medical');
    });

    // Association
    $('#toggleAssociationBtn').click(function () {
        $('#associationTable').toggle();
        $('#associationMessage').toggle();
        $(this).text($('#associationTable').is(':visible') ? 'Hide Association' : 'View Association');
    });
});
</script>

                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HR.Dashboard.footer')

