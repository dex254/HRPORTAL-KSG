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

            <!-- Level Select -->
            <div class="form-group">
                <label>Level of Education</label>
                <select name="level" class="custom-select" required>
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

            <!-- Other Inputs -->
            <div class="form-group">
                <label>Institution</label>
                <input type="text" name="institution" class="form-control" placeholder="Enter institution name" required>
            </div>

            <div class="form-group">
                <label>Course Name</label>
                <input type="text" name="course" class="form-control" placeholder="Bachelor in Supply Chain Management" required>
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
                <label>Grade/Score</label>
                <input type="text" name="grade" class="form-control" placeholder="B+">
            </div>

            <div class="form-group">
                <label>Certificate (PDF, max 2MB)</label>
                <input type="file" name="document" class="form-control" accept="application/pdf" required>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" onclick="closeModal('academicModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Styling -->
<style>
/* Modal Background */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1050;
    padding: 20px;
    overflow-y: auto;
}

/* Modal Content */
.modal-content {
    width: 80%;
    max-width: 700px;
    min-width: 300px;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    text-align: left;
    max-height: 90vh;
    overflow-y: auto;
}

/* Title */
.modal-title {
    font-size: 24px;
    font-weight: bold;
    color: rgb(127,98,44);
    text-align: center;
    margin-bottom: 25px;
}

/* Labels */
label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
    color: #333;
}

/* Inputs */
input[type="text"], input[type="date"], input[type="file"], select.custom-select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 15px;
    color: #333;
    transition: all 0.3s ease;
}

input:focus, select:focus {
    border-color: rgb(127,98,44);
    box-shadow: 0 0 5px rgba(127,98,44,0.4);
    outline: none;
}

/* Custom Select Dropdown Arrow */
.custom-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: white url("data:image/svg+xml;charset=US-ASCII,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><polygon points='0,0 10,0 5,5' style='fill:%23333;'/></svg>") no-repeat right 10px center;
    background-size: 10px;
    cursor: pointer;
}

/* Buttons */
.button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.button-group .btn-success {
    background-color: rgb(127,98,44);
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.button-group .btn-success:hover {
    background-color: #fff;
    color: rgb(127,98,44);
    border: 1px solid rgb(127,98,44);
}

.button-group .btn-danger {
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

/* Responsive */
@media(max-width:768px) {
    .modal-content {
        width: 95%;
    }
}
</style>

<!-- Modal Script -->
<script>
function openModal(modalId){
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId){
    document.getElementById(modalId).style.display = 'none';
}
</script>
