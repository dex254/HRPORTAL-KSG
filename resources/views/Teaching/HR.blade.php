@include('HR.Dashboard.header')
@include('HR.Dashboard.Status')

<!--wrapper-->
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Teaching Experience</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        
                       
                    </nav>
                </div>
                <div class="alert alert-info mt-3" role="alert">
                    <i class="bx bx-info-circle"></i>
                    Please provide your teaching experience starting with the most recent.
                </div>
            </div> <!--end breadcrumb-->
            <div class="ms-auto">
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('Experience.Ext') }}" class="btn previous-button px-4 py-2 me-3">Previous</a>

                    <button onclick="location.href='{{ route('Experience.Other') }}'" class="btn next-button px-4 py-2">
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
                               
                                <button class="custom-btn" onclick="openModal()">
                                    Add a Teaching Experience
                                </button>
                                
                                <style>
                                    .custom-btn {
                                        background-color: rgb(203, 211, 0); /* Default background */
                                        color: black; /* Default text color */
                                        padding: 10px 20px;
                                        font-size: 16px;
                                        border: none;
                                        border-radius: 5px;
                                        cursor: pointer;
                                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                                        transition: background-color 0.3s, color 0.3s;
                                    }
                                
                                    .custom-btn:hover {
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

                    <div class="table-responsive">
                        <table id="example" class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Teaching </th>
                                    <th>Employer</th>
                                    <th>Designation</th>
                                    <th>Country</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Location</th>
                                    <th>Job Description</th>
                                    <th>Duties  and  Responsibilities</th>
                                   <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachings as $experience)
                    <tr>
                        <td>{{ $experience->teaching_areas }}</td>
                        <td>{{ $experience->employer }}</td>
                        <td>{{ $experience->job_title }}</td>
                        <td>{{ $experience->country }}</td>
                        <td>{{ $experience->stdate }}</td>
                        <td>{{ $experience->enddate }}</td>
                        <td>{{ $experience->location }}</td>
                        <td>{{ $experience->duties}}</td>
                        
                        <td>{{ $experience->achievements }}</td>
                        
                       <td>
    @if($experience->teaching_path)
        <a href="{{ asset('/' . $experience->teaching_path) }}" 
           class="btn btn-outline-primary btn-sm animate-download" 
           download>
            <i class="fas fa-download"></i> 
        </a>
    @else
        <span class="text-muted">No file</span>
    @endif
</td>

<style>
    .animate-download {
        position: relative;
        transition: all 0.3s ease;
    }

    .animate-download:hover {
        background-color: #007bff;
        color: white;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
        transform: scale(1.05);
    }

    .animate-download i {
        margin-right: 5px;
    }
</style>

                        
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('teaching.destroy', $experience->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>

                        </td>
                        
                    </tr>
                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                   <th>Teaching </th>
                                    <th>Employer</th>
                                    <th>Designation</th>
                                    <th>Country</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Location</th>
                                    <th>Job Description</th>
                                    <th>Duties  and  Responsibilities</th>
                                   <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                   

                <!-- Popup Modal -->
                <div id="academicModal" class="modal">
                    <div class="modal-content">
                        <h3 class="modal-title">Add Experience</h3>
                       
                
                        <form action="{{ route('Experience.Teaching.HR') }}"   method="POST" enctype="multipart/form-data" >
                            @csrf
                            
                            
                
                            <!-- Hidden Fields -->
                            <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                            <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                            <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->upn_no }}">
                            <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                            <!-- Input Fields -->
                            <!-- Include Bootstrap (for modal) -->


<div class="form-group">
    <label><strong>Area of Specialization</strong></label>
    <select id="areaDropdown" class="form-select">
    <option value="">-- Select Area --</option>
    <option value="Public Sector Management">Public Sector Management</option>
    <option value="Public Health Management">Public Health Management</option>
    <option value="Ethics, Values and Integrity">Ethics, Values and Integrity</option>
    <option value="Procurement Management">Procurement Management</option>
    <option value="Human Resource Management">Human Resource Management</option>
    <option value="Security">Security</option>
    <option value="Information Technology">Information Technology</option>
    <option value="Data Management">Data Management</option>
    <option value="Law">Law</option>
    <option value="Life Skills">Life Skills</option>
    <option value="Environment">Environment</option>
    <option value="Corporate Governance">Corporate Governance</option>
    <option value="Project Management">Project Management</option>
    <option value="Education">Education</option>
    <option value="Communication Management">Communication Management</option>
    <option value="International Relations">International Relations</option>
    <option value="Hospitality Management">Hospitality Management</option>
    <option value="Research">Research</option>
    <option value="Records Management">Records Management</option>
    <option value="Consultancy Management">Consultancy Management</option>
    <option value="Innovation and Creativity">Innovation and Creativity</option>
  </select>
</div>

<div class="form-group mt-3" id="topicsWrapper" style="display:none;">
    <label><strong>Select Relevant Topics</strong></label>
    <div id="topicsContainer"></div>
</div>

<div class="form-group">
    <label for="topicsTextarea">Teaching Areas</label>
    <textarea id="topicsTextarea" name="Teachingareas" class="form-control" rows="6" readonly></textarea>
</div>
<script>
    const areaTopics = {
  "Public Sector Management": [
    "Public Sector Leadership",
    "Public Human Resource Information Systems",
    "Management of Public Enterprises",
    "Public Sector Performance Management & Productivity",
    "Public Policy Formulation, Implementation & Analysis",
    "Public Finance Management",
    "Devolution Affairs",
    "Public Administration",
    "Public Sector Reform",
    "Parliamentary/County Assembly Standing orders and committee engagement",
    "Government Protocol & Etiquette"
  ],
  "Public Health Management": [
    "Public Health Systems",
    "Global Health Management",
    "Health Economics and Financing",
    "Community Health Management and Education",
    "Electronic Health Records Management",
    "Emergency Preparedness and Disaster Management"
  ],
  "Ethics, Values and Integrity": [
    "Professional Ethics, Values and Integrity",
    "Human Rights and Justice"
  ],
  "Procurement Management": [
    "Public Procurement and Asset Disposal"
  ],
  "Human Resource Management": [
    "Strategic Planning & Balanced Score Card",
    "Counselling and Staff Wellness",
    "Psychometrics Assessment Tools",
    "Organization Change and Development",
    "Talent Management",
    "Workload Analysis",
    "Competency development",
    "Job Evaluation",
    "Occupational Health and Safety"
  ],
  "Security": [
    "Conflict management and Peace Building",
    "Fraud Management",
    "Emergency preparedness and Disaster Management",
    "Global and regional Security Studies",
    "Human Security",
    "Criminology",
    "Security risk assessments"
  ],
  "Information Technology": [
    "Information Communication & Technology",
    "Cyber Security and Computer Forensics",
    "IFMIS",
    "Management Information Systems",
    "Artificial Intelligence",
    "Digital Transformation",
    "Information Science"
  ],
  "Data Management": [
    "Data Management and Governance",
    "Data Science",
    "Data Security",
    "Big Data Analytics"
  ],
  "Law": [
    "Public Law",
    "Negotiation, Mediation and Arbitration Skills",
    "Public Prosecution",
    "Social Work Social Science Research"
  ],
  "Life Skills": [
    "Executive Coaching & Mentoring",
    "Civic Education and Public Participation",
    "Social Accountability",
    "Gender and Development",
    "Development Studies",
    "Youth Empowerment",
    "Community Health and Safety Management",
    "SDGs and Regional Integration"
  ],
  "Environment": [
    "Environmental Governance and Management",
    "Climate Change",
    "Climate Finance",
    "Green Growth & Circular Economy",
    "Waste Management",
    "Environmental and Social Impact Assessments",
    "Disaster Management"
  ],
  "Corporate Governance": [
    "Ethics and Integrity Management",
    "Corporate Strategy and Governance",
    "Corporate Communication",
    "Compliance and Risk Management",
    "Financial Reporting and Analysis"
  ],
  "Project Management": [
    "Project Management",
    "Project Monitoring, Evaluation and Reporting",
    "Risk and Quality Management",
    "Strategic Management"
  ],
  "Education": [
    "Knowledge Management",
    "Educational Technology/eLearning",
    "Curriculum Development",
    "Educational Leadership and Administration",
    "Special Education",
    "Advanced Facilitation Skills"
  ],
  "Communication Management": [
    "Speech Writing",
    "Development of Cabinet Memoranda",
    "Report Writing",
    "Conduct of meetings and minute writing",
    "Internal & external communication",
    "Government Communication",
    "Public Speaking & Presentation",
    "Corporate Branding",
    "Public Relations",
    "Marketing",
    "Graphics & Multi-Media Design"
  ],
  "International Relations": [
    "Diplomacy and International Relations",
    "International Law and Human Rights",
    "Foreign Policy Analysis",
    "International Peace and Conflict studies",
    "National Interest & Statecraft"
  ],
  "Hospitality Management": [
    "Food and Beverage operations",
    "Housekeeping and Laundry techniques",
    "Front Office and Customer care operations",
    "Event, Conferencing and banqueting",
    "Cost Management for Hospitality Managers",
    "Efficient Strategies for managing hospitality operations",
    "Efficient management for hospitality teams",
    "Dining etiquette",
    "Basic interior design for hospitality facilities",
    "Events Managements"
  ],
  "Research": [
    "Data Collection",
    "Quantitative and Qualitative Research",
    "Data Analytics",
    "Grant Proposal Writing",
    "Academic writing in economics: Policy briefs, research papers and reports"
  ],
  "Records Management": [
    "Physical Records Management",
    "Electronic Document Management Systems (EDMS)",
    "Archiving and disposal of records"
  ],
  "Consultancy Management": [
    "Planning, Executing and Reporting on Consultancy",
    "Editing, Proof reading & Documentation",
    "Global & Regional Consultancy Bidding",
    "Advisory, outreach & community service"
  ],
  "Innovation and Creativity": [
    "Innovation and Creativity",
    "Creative and Lateral Thinking",
    "Organizational Growth and Excellence"
  ]
};


    const selectedTopicsByArea = {};

    const areaDropdown = document.getElementById("areaDropdown");
    const topicsWrapper = document.getElementById("topicsWrapper");
    const topicsContainer = document.getElementById("topicsContainer");
    const topicsTextarea = document.getElementById("topicsTextarea");

    areaDropdown.addEventListener("change", function () {
        const selectedArea = this.value;
        topicsContainer.innerHTML = "";
        if (!selectedArea || !areaTopics[selectedArea]) {
            topicsWrapper.style.display = "none";
            return;
        }

        areaTopics[selectedArea].forEach(topic => {
            const topicId = `${selectedArea}-${topic}`.replace(/\s+/g, "_");
            const radioDiv = document.createElement("div");
            radioDiv.innerHTML = `
                <input type="checkbox" id="${topicId}" name="topics" value="${topic}">
                <label for="${topicId}">${topic}</label>
            `;
            topicsContainer.appendChild(radioDiv);
        });

        topicsWrapper.style.display = "block";
    });

    topicsContainer.addEventListener("change", function () {
        const selectedArea = areaDropdown.value;
        if (!selectedArea) return;

        const selectedTopics = Array.from(
            topicsContainer.querySelectorAll("input[name='topics']:checked")
        ).map(el => el.value);

        if (selectedTopics.length > 0) {
            selectedTopicsByArea[selectedArea] = selectedTopics;
        } else {
            delete selectedTopicsByArea[selectedArea];
        }

        updateTextarea();
    });

    function updateTextarea() {
        let result = "";
        for (const area in selectedTopicsByArea) {
            const topics = selectedTopicsByArea[area];
            if (topics.length) {
                result += `${area} - [${topics.join(", ")}]\n`;
            }
        }
        topicsTextarea.value = result.trim();
    }
</script>



  <div class="form-group mb-3">
    <label for="employer">Employer</label>
    <input type="text"  name="employer" class="form-control"  required>
</div>
                
                            <div class="form-group">
                                <label>Designations</label>
                                <input type="text" name="job_title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                
                                <label>Select Country</label>
    <select class="form-select" name="country" required style="background-color: white; color: black;">
        <option value="">Select Country</option>
        <option value="Afghanistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Brazil">Brazil</option>
        <option value="Brunei">Brunei</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>
        <option value="Cabo Verde">Cabo Verde</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
        <option value="Congo (Congo-Brazzaville)">Congo</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
        <option value="Estonia">Estonia</option>
        <option value="Eswatini">Eswatini</option>
        <option value="Ethiopia">Ethiopia</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>
        <option value="Gabon">Gabon</option>
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Greece">Greece</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Honduras">Honduras</option>
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="India">India</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Iran">Iran</option>
        <option value="Iraq">Iraq</option>
        <option value="Ireland">Ireland</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kuwait">Kuwait</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Libya">Libya</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Malta">Malta</option>
        <option value="Mexico">Mexico</option>
        <option value="Moldova">Moldova</option>
        <option value="Monaco">Monaco</option>
        <option value="Morocco">Morocco</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Namibia">Namibia</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherlands">Netherlands</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nigeria">Nigeria</option>
        <option value="North Korea">North Korea</option>
        <option value="Norway">Norway</option>
        <option value="Pakistan">Pakistan</option>
        <option value="Panama">Panama</option>
        <option value="Peru">Peru</option>
        <option value="Philippines">Philippines</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>
        <option value="Qatar">Qatar</option>
        <option value="Romania">Romania</option>
        <option value="Russia">Russia</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Serbia">Serbia</option>
        <option value="Singapore">Singapore</option>
        <option value="South Africa">South Africa</option>
        <option value="Spain">Spain</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Thailand">Thailand</option>
        <option value="Turkey">Turkey</option>
        <option value="Ukraine">Ukraine</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="United States">United States</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Zimbabwe">Zimbabwe</option>
    </select>
</div>
                
                            <div class="form-group">
                                <label>Start  Date</label>
                                <input type="date" name="stdate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>End  Date</label>
                                <input type="date" name="enddate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Location  </label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2" class="form-label">Duties  and Responsibilities</label>
                                <textarea class="form-control" id="inputAddress2" name="duties" placeholder="1................" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="achievements" class="form-label">Achievements in the Organization</label>
                                <textarea class="form-control" id="inputAddress2" name="expartise" placeholder="Describe your key achievements in the organization, starting with the most recent. For example:
- Successfully led a team of 10 to complete a project 2 weeks ahead of schedule.
- Increased sales by 20% through the implementation of a new marketing strategy.
- Streamlined internal processes, reducing operational costs by 15%." rows="5"></textarea>
                                    
                            </div>
                            <div class="form-group">
    <label>Provide a valid recommendation certificate or recommendation letter to justify your teaching in the organization</label>
    <input type="file" name="recommendation_document" class="form-control-file" 
           accept=".jpg,.jpeg,.png,.gif,.zip,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.rtf" required>
</div>

                            
                            
                            
                            <!-- Buttons -->
                            <div class="button-group">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-danger" onclick="closeModal()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Modal Script -->
                <script>
                    function openModal() {
                        document.getElementById('academicModal').style.display = 'flex';
                    }
                    
                    function closeModal() {
                        document.getElementById('academicModal').style.display = 'none';
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
                    select.form-select {
        color: black !important;  /* Ensures text inside dropdown is black */
        background-color: white !important;  /* Keeps background white */
        border: 1px solid #ccc; /* Subtle border */
        padding: 8px;
        width: 100%;
        appearance: none; /* Removes default OS styles */
        font-size: 16px;
    }
    
    /* Ensure dropdown options have the correct styling */
    select.form-select option {
        background: white !important;  /* Keep dropdown options white */
        color: black !important;  /* Text remains black */
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

                </div>
            </div>
        </div>
    </div> <!--end page wrapper -->
</div>
<!--end wrapper-->

@include('HR.Dashboard.footer')

