<!-- Training Modal -->
<div id="trainingModal" class="modal">
    <div class="modal-content">
        <h3 class="modal-title">Add Short Course</h3>
        <form action="{{ route('Academic.Training') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Fields -->
                        <input type="hidden" name="upn_no" value="{{ Auth::guard('HR')->user()->upn_no }}">
                        <input type="hidden" name="email" value="{{ Auth::guard('HR')->user()->email }}">
                        <input type="hidden" name="phone" value="{{ Auth::guard('HR')->user()->phone }}">
                        <input type="hidden" name="name" value="{{ Auth::guard('HR')->user()->name }}">
                        <input type="hidden" name="Education_type" value="Training">
            
            <!-- Form Inputs -->
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
                <label>Score/Result (if applicable)</label>
                <input type="text" name="grade" class="form-control" placeholder="Pass/Distinction" required>
            </div>

            <div class="form-group">
                <label>Certificate (PDF, max 2MB)</label>
                <input type="file" name="document" class="form-control" accept="application/pdf" required>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" onclick="closeModal('trainingModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>
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