<!-- Professional Qualification Modal -->
<div id="professionalModal" class="modal">
    <div class="modal-content">
        <h3 class="modal-title">Add Professional Qualification</h3>
        <form action="{{ route('EXT.Academic.Professional') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hidden Fields -->
            <input type="hidden" name="upn_no" value="{{ Auth::guard('EXT')->user()->upn_no }}">
            <input type="hidden" name="email" value="{{ Auth::guard('EXT')->user()->email }}">
            <input type="hidden" name="phone" value="{{ Auth::guard('EXT')->user()->upn_no }}">
            <input type="hidden" name="name" value="{{ Auth::guard('EXT')->user()->name }}">
            <input type="hidden" name="Education_type" value="Professional">
            <input type="hidden" name="level" value="Professional Qualification">

            <!-- Form Inputs -->
            <div class="form-group">
                <label>Institution / Professional Body</label>
                <input type="text" name="institution" class="form-control" placeholder="e.g., CPA Kenya, ACCA" required>
            </div>

            <div class="form-group">
                <label>Professional Course Name</label>
                <input type="text" name="course" class="form-control" placeholder="e.g., Part III CPA, Part III ACCA" required>
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
                <label>Result / Status (if applicable)</label>
                <input type="text" name="grade" class="form-control" placeholder="Pass / Distinction / Pending">
            </div>

            <div class="form-group">
                <label>Certificate (PDF, max 2MB)</label>
                <input type="file" name="document" class="form-control" accept="application/pdf" required>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" onclick="closeModal('professionalModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>
<style>
    /* Modal Styling */
#professionalModal .modal-content {
    width: 80%;
    max-width: 700px;
    padding: 30px;
    border-radius: 10px;
    text-align: left;
    max-height: 90vh;
    overflow-y: auto;
}

/* Button Group */
#professionalModal .button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

#professionalModal .btn-success {
    background-color: rgb(127,98,44);
    border: none;
    color: #fff;
}
#professionalModal .btn-success:hover {
    background-color: #fff;
    color: rgb(127,98,44);
    border: 1px solid rgb(127,98,44);
}

/* Table Styling */
#professionalTable th, #professionalTable td {
    vertical-align: middle;
}

    </style>