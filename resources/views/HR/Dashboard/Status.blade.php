<style>
    /* Styling for the progress tracker */
    .progress-tracker {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 100%;
        margin: 10px auto;
        position: relative;
        padding: 0 10px;
    }

    .step {
        position: relative;
        text-align: center;
        flex-grow: 1;
        cursor: pointer; /* Add pointer cursor to indicate clickable steps */
    }

    /* Hexagon shape */
    .hexagon {
        width: 20px;
        height: 12px;
        background-color: rgb(127, 98, 44);
        position: relative;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 10px;
    }

    .hexagon::before,
    .hexagon::after {
        content: "";
        position: absolute;
        width: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
    }

    .hexagon::before {
        top: -6px;
        border-bottom: 6px solid rgb(127, 98, 44);
    }

    .hexagon::after {
        bottom: -6px;
        border-top: 6px solid rgb(127, 98, 44);
    }

    /* Step label */
    .step-label {
        display: block;
        margin-top: 5px;
        font-size: 15px;
        font-weight: bold;
    }

    /* Full-width connecting line */
    .progress-tracker::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: gray;
        z-index: -1;
    }

    /* Change colors for active steps */
    .active .hexagon {
        background-color:rgb(203, 211, 0); !important;
    }

    .active .hexagon::before {
        border-bottom-color:rgb(203, 211, 0); !important;
    }

    .active .hexagon::after {
        border-top-color:rgb(203, 211, 0); !important;
    }

    /* Ensure all previous steps turn green */
    .step.active ~ .step::before {
        background-color: rgb(203, 211, 0);
    }

    .step:first-child::before {
        display: none;
    }

    /* Button styles */
    .dashboard-button {
        padding: 8px 15px;
        background-color: rgb(203, 211, 0);;
        color: white;
        border: none;
        cursor: pointer;
        margin: 10px 5px;
        font-size: 14px;
        border-radius: 5px;
    }

    .dashboard-button:hover {
        background-color: rgb(203, 211, 0);;
    }
</style>

<!-- Full-Width Responsive Progress Tracker (Up to Step 6) -->
<div class="progress-tracker">
    <div class="step" data-step="1" onclick="navigateToRoute('{{ route('HR.Dashboard') }}')">
        <div class="hexagon">1</div>
        <span class="step-label">Bio data</span>
    </div>
    <div class="step" data-step="2" onclick="navigateToRoute('{{ route('Academic.data') }}')">
        <div class="hexagon">2</div>
        <span class="step-label">Academic</span>
    </div>
    <div class="step" data-step="3" onclick="navigateToRoute('{{ route('Special.ProfessionalBody') }}')">
        <div class="hexagon">3</div>
        <span class="step-label">Professional Body</span>
    </div>
    <div class="step" data-step="4" onclick="navigateToRoute('{{ route('Special.Association') }}')">
        <div class="hexagon">4</div>
        <span class="step-label">Association</span>
    </div>
    
    <div class="step" data-step="5" onclick="navigateToRoute('{{ route('Special.Licence') }}')">
        <div class="hexagon">5</div>
        <span class="step-label">Practising License</span>
    </div>
    <div class="step" data-step="6" onclick="navigateToRoute('{{ route('Special.Medical') }}')">
        <div class="hexagon">6</div>
        <span class="step-label">Food handlers Certificate</span>
    </div>
    <div class="step" data-step="7" onclick="navigateToRoute('{{ route('Experience.data') }}')">
        <div class="hexagon">7</div>
        <span class="step-label">Experience</span>
    </div>
    <div class="step" data-step="8" onclick="navigateToRoute('{{ route('Research.Home') }}')">
        <div class="hexagon">8</div>
        <span class="step-label">Consultancy and Research</span>
    </div>
   
    <div class="step" data-step="9" onclick="navigateToRoute('{{ route('Report.Complete') }}')">
        <div class="hexagon">9</div>
        <span class="step-label">Overview & Release</span>
    </div>
    
    <div class="step" data-step="10" onclick="navigateToRoute('{{ route('JOB.applicants') }}')">
        <div class="hexagon">10</div>
        <span class="step-label">Jobs</span>
    </div>
    <div class="step" data-step="11" onclick="navigateToRoute('{{ route('JOB.Myapplicants') }}')">
        <div class="hexagon">11</div>
        <span class="step-label">Complete</span>
    </div>
</div>

<!-- Separate Buttons (To Be Placed on Dashboard) -->


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Define the mapping of routes to steps
        const stageMapping = {
            "HR.Dashboard": 1,
            "Academic.data": 2,
            "Special.ProfessionalBody": 3,
            "Special.Association": 4,
            "Special.Licence": 5,
            "Special.Medical": 6,
            "Experience.data": 7,
            "Research.Home": 8,
           
            "Report.Complete": 9,
            "JOB.applicants": 10,
            "JOB.Myapplicants": 11, // Mark all steps as complete for this route
            "JOB.Apply": 12 // Mark all steps as complete for this route as well
        };

        // Get the current route name from Laravel
        const currentRoute = "{{ Route::currentRouteName() }}";

        // Determine the active step based on the current route
        const activeStep = stageMapping[currentRoute] || 1;

        // Activate all steps up to the active step
        document.querySelectorAll(".step").forEach(step => {
            const stepNumber = parseFloat(step.getAttribute("data-step"));

            if (stepNumber <= activeStep) {
                step.classList.add("active");
            }
        });

        // If the route is "JOB.Myapplicants" or "JOB.Apply", mark all steps as complete
        if (currentRoute === "JOB.Myapplicants" || currentRoute === "JOB.Apply"|| currentRoute ==="JOB.Applicationdetails") {
            document.querySelectorAll(".step").forEach(step => {
                step.classList.add("active");
            });
            localStorage.setItem("progressComplete", "true");
        }
    });

    function navigateToRoute(url) {
        // Navigate to the selected route
        window.location.href = url;
    }

    function markCompleteAndNavigate(url) {
        // Mark all progress steps as complete (green)
        document.querySelectorAll(".step").forEach(step => {
            step.classList.add("active");
        });

        // Save progress state to localStorage
        localStorage.setItem("progressComplete", "true");

        // Navigate to the selected route
        window.location.href = url;
    }
</script>