@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')
<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Delivery of  Core Mandate</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                       
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                   
                   
                    <ul>
                        <li><i class="bx bx-info-circle"></i><strong style="color: red;">Note:</strong> To be completed by faculty staff only.</li>

                       
                    </ul>
                </div>
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Experience.data') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>

                    <button onclick="location.href='{{ route('Report.Complete') }}'" class="btn next-button px-4 py-2">
                        Next
                    </button>
                    
                    <style>
                        /* Previous Button */
                        .previous-button {
                            background-color: rgb(127, 98, 44); /* Brown color */
                            color: white; /* White text */
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
                            background-color: rgb(203, 211, 0); /* Yellowish-green color */
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
            </div>
            <br>
            <br>
            
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="ms-auto">
                            <div class="d-flex justify-content-start mt-4">
                               
                                <button class="core-mandate-btn" data-bs-toggle="modal" data-bs-target="#coreMandateModal">
                                    Add Core Mandate
                                </button>
                                
                                <style>
                                    .core-mandate-btn {
                                        background-color: rgb(203, 211, 0); /* Default background */
                                        color: black; /* Default text color */
                                        padding: 10px 15px;
                                        font-size: 16px;
                                        border: none;
                                        border-radius: 5px;
                                        cursor: pointer;
                                        transition: background-color 0.3s, color 0.3s;
                                    }
                                
                                    .core-mandate-btn:hover {
                                        background-color: white; /* Turns white on hover */
                                        color: black; /* Keeps text black */
                                        border: 2px solid rgb(203, 211, 0); /* Optional: border for visibility */
                                    }
                                </style>
                                
                            
                                
                               
                        </div>
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

                    <div class="mb-4">
                        <h5>Delivery of Core Mandate</h5>
                        <p class="text-muted">Manage and view core mandate information.</p>
                      
                        <div id="message" class="alert alert-info" style="display: none;">
                            This is your core mandates achieved.
                        </div>
                    
                        <!-- Table (hidden by default) -->
                        <div class="table-responsive">
                        <table id="example" class="table mb-0" >
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                   
                                    
                                   
                                    <th>Core Mandate</th>
                                    <th>Selected Count</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Delete</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coremandate as $item) <!-- Changed variable name to avoid conflict -->
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        
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
                                        <li><strong style="color: red;">Note:</strong> Tick were  appropriate  and prepare to present evidence during the intervew.</li>

                                        <!-- Add your form or additional content here -->
                                    </div>
                                    <h3></h3>

                                    <fieldset>
                                        <legend>1. Conduct of Research and Publications</legend>
                                        <label><input type="radio" id="Publications1" onclick="addToTextarea(this, 'Publications', 1, 'One Postgraduate Level Book on a Public Service Theme')">  One Postgraduate Level Book on a Public Service Theme</label><br>
                                        <label><input type="radio" id="Publications2" onclick="addToTextarea(this, 'Publications', 2, 'One accredited curriculum developed / reviewed')">  One accredited curriculum developed / reviewed</label><br>
                                        <label><input type="radio" id="Publications3" onclick="addToTextarea(this, 'Publications', 3, 'One Peer-refereed Learning Module')">  One Peer-refereed Learning Module</label><br>
                                        <label><input type="radio" id="Publications4" onclick="addToTextarea(this, 'Publications', 4, 'Patented Invention or Innovation 6 Points')">  Patented Invention or Innovation </label><br>
                                        <label><input type="radio" id="Publications5" onclick="addToTextarea(this, 'Publications', 5, 'One Article in a Peer-reviewed Journal 8 Points')">  One Article in a Peer-reviewed Journal </label><br>
                                        <label><input type="radio" id="Publications6" onclick="addToTextarea(this, 'Publications', 6, 'One Tertiary Level Scholarly Book 8 Points')">  One Tertiary Level Scholarly Book </label><br>
                                        <label><input type="radio" id="Publications7" onclick="addToTextarea(this, 'Publications', 7, 'One chapter in Postgraduate Level Book on a Public Service Theme 6 Points')">  One chapter in Postgraduate Level Book on a Public Service Theme </label><br>
                                        <label><input type="radio" id="Publications8" onclick="addToTextarea(this, 'Publications', 8, 'One Reviewed Conference Paper 4 Points')">  One Reviewed Conference Paper </label><br>
                                        <label><input type="radio" id="Publications9" onclick="addToTextarea(this, 'Publications', 9, 'One Reviewed Policy Paper 4 Points')">  One Reviewed Policy Paper </label><br>
                                        <label><input type="radio" id="Publications10" onclick="addToTextarea(this, 'Publications', 10, 'One Secondary School Level Textbook 2 Points')">  One Secondary School Level Textbook </label><br>
                                        <label><input type="radio" id="Publications11" onclick="addToTextarea(this, 'Publications', 11, 'Short Communication in a Refereed/ Scholarly Journal 2 Points')">  Short Communication in a Refereed/ Scholarly Journal </label><br>
                                        <label><input type="radio" id="Publications12" onclick="addToTextarea(this, 'Publications', 12, 'Consultancy and Project Reports 8 Points')">  Consultancy and Project Reports </label><br>
                                        <label><input type="radio" id="Publications13" onclick="addToTextarea(this, 'Publications', 13, 'One public lecture paper successfully delivered 2 Points')">  One public lecture paper successfully delivered </label><br>
                                        <label><input type="radio" id="Publications14" onclick="addToTextarea(this, 'Publications', 14, 'Any other Book 2 Points')">  Any other Book</label><br>
                                        <label><input type="radio" id="Publications15" onclick="addToTextarea(this, 'Publications', 15, 'Editorship of a Book or a Journal or Conference Proceedings 10 Points')">  Editorship of a Book or a Journal or Conference Proceedings </label><br>
                                        <label><input type="radio" id="Publications16" onclick="addToTextarea(this, 'Publications', 16, 'Scholarly Presentations at Conferences/ Workshops/ Seminars')">  Scholarly Presentations at Conferences/ Workshops/ Seminars</label><br>
                                        <label><input type="radio" id="Publications17" onclick="addToTextarea(this, 'Publications', 17, 'Book Review Published in Refereed Journals 2 Points')">  Book Review Published in Refereed Journals </label><br>
                                        <label><input type="radio" id="Publications18" onclick="addToTextarea(this, 'Publications', 18, 'Peer-reviewed Case Study 4 Points')">  Peer-reviewed Case Study </label><br>
                                        <label><input type="radio" id="Publications19" onclick="addToTextarea(this, 'Publications', 19, 'Expert opinion/working papers/discussion papers')">  Expert opinion/working papers/discussion papers</label><br>
                                    </fieldset>
                                    
                                    <h3></h3>
                                    <fieldset>
                                        <legend>2. Quality Teaching and Instruction</legend>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'i', 'Student evaluation of instruction and course')">  Student evaluation of instruction and course</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'ii', 'Lecturer notes')">  Lecturer notes</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'iii', 'Student advising and mentoring')">  Student advising and mentoring</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'iv', 'Supervision of examinations')">  Supervision of examinations</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'v', 'Evaluation of research projects or academic papers')"> Evaluation of research projects or academic papers</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'vi', 'Coordination of programs')">  Coordination of programs</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'vii', 'Post-graduate supervision')">  Post-graduate supervision</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Teaching & Instruction', 'viii', 'Any other relevant evidence')">  Any other relevant evidence</label><br>
                                    </fieldset>
                                    
                                    <h3></h3>
                                    <fieldset>
                                        <legend>3. Conduct of Consultancy in the Public Service</legend>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'i', 'Experience in expert consultancy services in the public service')">  Experience in expert consultancy services in the public service</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'ii', 'Development of a successful consultancy proposal')">  Development of a successful consultancy proposal</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'iii', 'Development of a successful grant proposal')">  Development of a successful grant proposal</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'iv', 'Successful consultancy execution with an Exit Report')">  Successful consultancy execution with an Exit Report</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Consultancy in the Public Service', 'v', 'Any other relevant evidence')"> Any other relevant evidence</label><br>
                                    </fieldset>
                                    
                                    <h3></h3>
                                    <fieldset>
                                        <legend>4 Participation in  Public Outreach Programs</legend>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Public Outreach Programs', 'i', 'Promoting public understanding on Government policies, programs and projects')"> Promoting public understanding on Government policies, programs and projects</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Public Outreach Programs', 'ii', 'Uptake of Government legislation, policies and programs')"> Uptake of Government legislation, policies and programs</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Public Outreach Programs', 'iii', 'Impact assessment reports on uptake of government policies, programs and projects')">  Impact assessment reports on uptake of government policies, programs and projects</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Public Outreach Programs', 'iv', 'Any other relevant evidence')">  Any other relevant evidence</label><br>
                                    </fieldset>
                                    
                                    <h3></h3>
                                    <fieldset>
                                        <legend>5 Participation in Public Sector Administration and Responsibility</legend>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Public Sector Administration and Responsibility', 'i', 'Recognized school/public sector administrative positions')">  Recognized school/public sector administrative positions</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Public Sector Administration and Responsibility', 'ii', 'Other responsibilities')">  Other responsibilities</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Public Sector Administration and Responsibility', 'iii', 'Any other relevant evidence')">  Any other relevant evidence</label><br>
                                    </fieldset>
                                    
                                    <h3></h3>
                                    <fieldset>
                                        <legend>6 Distinguished Service Award</legend>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Distinguished Service Award', 'i', 'Awards and Honors')">  Awards and Honors</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Distinguished Service Award', 'ii', 'Recognition for innovation')">  Recognition for innovation</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Distinguished Service Award', 'iii', 'Excellence in service delivery')">  Excellence in service delivery</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Distinguished Service Award', 'iv', 'Any other relevant evidence')">  Any other relevant evidence</label><br>
                                    </fieldset>
                                    
                                    <h3></h3>
                                    <fieldset>
                                        <legend>7. Participated in Community Engagement and Other Contributions</legend>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Community Engagement and Other Contributions', 'i', 'Attracting research and development funding')"> Attracting research and development funding</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Community Engagement and Other Contributions', 'ii', 'Professional affiliations and portfolios')"> Professional affiliations and portfolios</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Community Engagement and Other Contributions', 'iii', 'Community service and any other contributions')"> Community service and any other contributions</label><br>
                                        <label><input type="radio" onclick="addToTextarea(this, 'Community Engagement and Other Contributions', 'iv', 'Any other relevant evidence')">  Any other relevant evidence</label><br>
                                    </fieldset>
                                    
                                    <form  action="{{ route('Special.Homepost') }}" method="POST">
                                        @csrf                    
                                        <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                                        <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                                        <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                                        <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                                        <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->designation }}">
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
                <!-- Popup Modal -->
               

                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HR.Dashboard.footer')

