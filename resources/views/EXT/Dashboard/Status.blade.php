<style>
    /* Styling for the progress tracker */
    .progress-tracker {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 100%;
        margin: 20px auto;
        position: relative;
        padding: 0 10px;
    }

    .step {
        position: relative;
        text-align: center;
        flex-grow: 1;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    /* Hexagon shape */
    .hexagon {
        width: 30px;
        height: 17px;
        background-color: rgb(127, 98, 44);
        position: relative;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 12px;
    }

    .hexagon::before,
    .hexagon::after {
        content: "";
        position: absolute;
        width: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
    }

    .hexagon::before {
        top: -8px;
        border-bottom: 8px solid rgb(127, 98, 44);
    }

    .hexagon::after {
        bottom: -8px;
        border-top: 8px solid rgb(127, 98, 44);
    }

    .step-label {
        display: block;
        margin-top: 5px;
        font-size: 13px;
        font-weight: bold;
        line-height: 1.2;
    }

    .progress-tracker::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: gray;
        z-index: -1;
        transform: translateY(-50%);
    }

    .step.active .hexagon {
        background-color: rgb(203, 211, 0);
    }

    .step.active .hexagon::before {
        border-bottom-color: rgb(203, 211, 0);
    }

    .step.active .hexagon::after {
        border-top-color: rgb(203, 211, 0);
    }

    .step:hover .hexagon {
        transform: scale(1.2);
        transition: transform 0.2s ease;
    }

    @media (max-width: 768px) {
        .step-label { font-size: 10px; }
        .hexagon {
            width: 22px;
            height: 12px;
            font-size: 10px;
        }
        .hexagon::before,
        .hexagon::after {
            border-left: 11px solid transparent;
            border-right: 11px solid transparent;
        }
        .hexagon::before { border-bottom: 6px solid rgb(127, 98, 44); }
        .hexagon::after { border-top: 6px solid rgb(127, 98, 44); }
    }
</style>

<div class="progress-tracker">

    <div class="step" data-step="1" onclick="navigateToRoute('{{ route('EXT.Dashboard') }}')">
        <div class="hexagon">1</div>
        <span class="step-label">Bio Data</span>
    </div>

    <div class="step" data-step="2" onclick="navigateToRoute('{{ route('EXT.Academic.Home') }}')">
        <div class="hexagon">2</div>
        <span class="step-label">Academic</span>
    </div>

    <div class="step" data-step="3" onclick="navigateToRoute('{{ route('EXT.Proffecional.Body') }}')">
        <div class="hexagon">3</div>
        <span class="step-label">Professional Body</span>
    </div>

    <div class="step" data-step="4" onclick="navigateToRoute('{{ route('EXT.Experince.New') }}')">
        <div class="hexagon">4</div>
        <span class="step-label">Experience</span>
    </div>

    <div class="step" data-step="5" onclick="navigateToRoute('{{ route('EXT.Special.Licence') }}')">
        <div class="hexagon">5</div>
        <span class="step-label">Professional Experience</span>
    </div>

    <!-- NEW STEP 6 -->
    <div class="step" data-step="6" onclick="navigateToRoute('{{ route('Experience.Teaching.Ext') }}')">
        <div class="hexagon">6</div>
        <span class="step-label">Teaching<br>Experience</span>
    </div>

    <div class="step" data-step="7" onclick="navigateToRoute('{{ route('Research.EXT.Home') }}')">
        <div class="hexagon">7</div>
        <span class="step-label">Research & Publications<br>& Consultancy</span>
    </div>

    <div class="step" data-step="8" onclick="navigateToRoute('{{ route('EXT.Ref.User') }}')">
        <div class="hexagon">8</div>
        <span class="step-label">Referees</span>
    </div>

    <div class="step" data-step="9" onclick="navigateToRoute('{{ route('EXT.Report.User') }}')">
        <div class="hexagon">9</div>
        <span class="step-label">Report</span>
    </div>

    <div class="step" data-step="10" onclick="navigateToRoute('{{ route('EXT.Application.Jobs') }}')">
        <div class="hexagon">10</div>
        <span class="step-label">Jobs</span>
    </div>

    <div class="step" data-step="11" onclick="navigateToRoute('{{ route('EXT.Application.MY') }}')">
        <div class="hexagon">11</div>
        <span class="step-label">Complete</span>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const stageMapping = {
        "EXT.Dashboard": 1,
        "EXT.Academic.Home": 2,
        "EXT.Proffecional.Body": 3,
        "EXT.Experince.New": 4,
        "EXT.Special.Licence": 5,

        "Experience.Teaching.Ext": 6,

        "Research.EXT.Home": 7,
        "EXT.Ref.User": 8,
        "EXT.Report.User": 9,
        "EXT.Application.Jobs": 10,
        "EXT.Application.MY": 11,

        "JOB.Applyext": 11
    };

    const currentRoute = "{{ Route::currentRouteName() }}";
    const activeStep = stageMapping[currentRoute] || 1;

    document.querySelectorAll(".step").forEach(step => {
        const stepNumber = Number(step.dataset.step);
        if (stepNumber <= activeStep) {
            step.classList.add("active");
        }
    });

    if (["EXT.Myapplicants", "JOB.Applyext", "JOB.Applicationdetailsext"].includes(currentRoute)) {
        document.querySelectorAll(".step").forEach(step => step.classList.add("active"));
    }
});

function navigateToRoute(url) {
    window.location.href = url;
}
</script>
