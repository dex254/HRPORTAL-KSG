<!-- CONSULTANCY MODAL -->
<div id="academicModal" class="modal">
    <div class="modal-content">
        <h3 class="modal-title">Add Consultancy Assignments</h3>
        <form action="{{ route('Other.post.Researchsaveext') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hidden Fields -->
            <input type="hidden" name="upn_no" value="{{ Auth::guard('EXT')->user()->upn_no }}">
            <input type="hidden" name="email" value="{{ Auth::guard('EXT')->user()->email }}">
            <input type="hidden" name="phone" value="{{ Auth::guard('EXT')->user()->upn_no }}">
            <input type="hidden" name="name" value="{{ Auth::guard('EXT')->user()->name }}">
            <input type="hidden" name="type" value="Consultancy">

            <!-- Client -->
            <div class="form-group">
                <label>Client / Organization</label>
                <input type="text" name="Client" class="form-control" required>
            </div>

            <!-- Sector Dropdown -->
            <div class="form-group">
                <label>Sector (Private/Public)</label>
                <select name="Sector" class="form-control" required>
                    <option value="">Select Sector</option>
                    <option value="Public">Public</option>
                    <option value="Private">Private</option>
                    <option value="Non-Governmental Organisation">Non-Governmental Organisation</option>
                </select>
            </div>

            <!-- Completed -->
            <div class="form-group">
                <label>Indicate area of research successfully completed</label>
                <input type="text" name="completed" class="form-control" placeholder="e.g. Completed / Ongoing" required>
            </div>

            <!-- Completion Date -->
            <div class="form-group">
                <label>Date of Completion</label>
                <input type="date" name="compedate" class="form-control" required>
            </div>

            <!-- Amount -->
            <input type="hidden" value="N/A" name="Amount">

            <!-- Document Upload -->
            <div class="form-group">
                <label>Upload Supporting Document</label>
                <input type="file" name="document" class="form-control-file" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>

            <!-- Buttons -->
            <div class="button-group mt-3">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" onclick="closeModal('academicModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- RESEARCH ASSIGNMENT MODAL -->
<div id="trainingModal" class="modal">
    <div class="modal-content">
        <h3 class="modal-title">Add Research Assignment</h3>
        <form action="{{ route('Other.Researchext') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hidden Fields -->
            <input type="hidden" name="upn_no" value="{{ Auth::guard('EXT')->user()->upn_no }}">
            <input type="hidden" name="email" value="{{ Auth::guard('EXT')->user()->email }}">
            <input type="hidden" name="phone" value="{{ Auth::guard('EXT')->user()->upn_no }}">
            <input type="hidden" name="name" value="{{ Auth::guard('EXT')->user()->name }}">
            <input type="hidden" name="type" value="Research">

            <!-- Client -->
            <div class="form-group">
                <label>Client / Organization</label>
                <input type="text" name="Client" class="form-control" required>
            </div>

            <!-- Sector Dropdown -->
            <div class="form-group">
                <label>Sector (Private/Public)</label>
                <select name="Sector" class="form-control" required>
                    <option value="">Select Sector</option>
                    <option value="Public">Public</option>
                    <option value="Private">Private</option>
                    <option value="Non-Governmental Organisation">Non-Governmental Organisation</option>
                </select>
            </div>

            <!-- Completed -->
            <div class="form-group">
                <label>Indicate area of research successfully completed</label>
                <input type="text" name="completed" class="form-control" placeholder="e.g. Completed / Ongoing" required>
            </div>

            <!-- Completion Date -->
            <div class="form-group">
                <label>Date of Completion</label>
                <input type="date" name="compedate" class="form-control" required>
            </div>

            <!-- Amount -->
            <div class="form-group">
                <label>Amount of funds the research attracted in Kshs.</label>
                <input type="text" name="Amount" class="form-control" placeholder="Enter Amount or leave blank">
            </div>

            <!-- Document Upload -->
            <div class="form-group">
                <label>Upload Supporting Document</label>
                <input type="file" name="document" class="form-control-file" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" onclick="closeModal('trainingModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- PUBLICATION MODAL -->
<div id="publicationModal" class="modal">
    <div class="modal-content">
        <h3 class="modal-title">Add Publication</h3>
        <form action="{{ route('Other.Researchext.Publication') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hidden Fields -->
            <input type="hidden" name="upn_no" value="{{ Auth::guard('EXT')->user()->upn_no }}">
            <input type="hidden" name="email" value="{{ Auth::guard('EXT')->user()->email }}">
            <input type="hidden" name="phone" value="{{ Auth::guard('EXT')->user()->upn_no }}">
            <input type="hidden" name="name" value="{{ Auth::guard('EXT')->user()->name }}">
            <input type="hidden" name="type" value="Publication">

            <!-- Publication Type Dropdown -->
            <div class="form-group">
                <label>Publication Type</label>
                <select name="Client" id="publicationType" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="Journal">Journal</option>
                    <option value="Book">Book</option>
                    <option value="Book Chapter">Book Chapter</option>
                    <option value="Conference Paper">Conference Paper</option>
                    <option value="Policy Paper">Policy Paper</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Custom Client Input -->
            <div class="form-group" id="customClientDiv" style="display: none;">
                <label>Specify Publication Type</label>
                <input type="text" name="customClient" class="form-control" placeholder="Enter custom type">
            </div>

            <!-- Title / Description -->
            <div class="form-group">
                <label>Title / Description</label>
                <input type="text" name="completed" class="form-control" placeholder="e.g. Peer-reviewed Journal Article" required>
            </div>

            <!-- Publication Date -->
            <div class="form-group">
                <label>Date of Publication</label>
                <input type="date" name="compedate" class="form-control" required>
            </div>

            <!-- Upload -->
            <div class="form-group">
                <label>Upload Publication Evidence</label>
                <input type="file" name="document" class="form-control-file" accept=".pdf,.doc,.docx" required>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" onclick="closeModal('publicationModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL JS -->
<script>
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Show/hide custom client input for Publications
document.getElementById('publicationType').addEventListener('change', function() {
    const customDiv = document.getElementById('customClientDiv');
    if(this.value === 'Other') {
        customDiv.style.display = 'block';
        customDiv.querySelector('input').required = true;
    } else {
        customDiv.style.display = 'none';
        customDiv.querySelector('input').required = false;
    }
});
</script>

<!-- MODAL STYLES -->
<style>
.modal {
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.6);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:1050;
    padding:20px;
    overflow-y:auto;
}
.modal-content {
    width:80%;
    max-width:900px;
    min-width:300px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.3);
    text-align:center;
    max-height:90vh;
    overflow-y:auto;
}
.modal-title { font-size:22px; font-weight:bold; margin-bottom:20px; color:black; }
label { font-weight:bold; display:block; margin-top:10px; color:black; text-align:left; }
input, select { width:100%; padding:8px; border:1px solid #ccc; background:white; color:black; }
.button-group { display:flex; justify-content:space-between; margin-top:20px; }
</style>
