<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('') }}assets/images/KSG Logo (1).png" type="image/png" />
    <!--plugins-->
    <link href="{{asset('') }}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{asset('') }}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{asset('') }}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('') }}assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{asset('') }}assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('') }}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('') }}assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{asset('') }}assets/css/app.css" rel="stylesheet">
    <link href="{{asset('') }}assets/css/icons.css" rel="stylesheet">
    <title>KSG Career Portal</title>
    <style>
        /* Custom styles */
        body {
            background-color: #ffffff; /* White background */
            color: #000000; /* Black text for the entire page */
        }

        .login-container {
            background-color: #ffffff; /* White background for login container */
            border-radius: 15px; /* Soft edges */
            box-shadow: 0 8px 16px rgba(0, 100, 0, 0.3); /* Dark green shadow */
            padding: 30px;
            max-width: 500px; /* Wider container */
            margin: 0 auto;
            border: 1px solid #e0e0e0; /* Light border for subtle definition */
        }

        .login-container .btn {
            background-color: #8B4513; /* Brown color for button */
            color: #ffffff; /* White text */
            border: none;
            transition: background-color 0.3s ease;
        }

        .login-container .btn:hover {
            background-color: #ffffff; /* White background on hover */
            color: #8B4513; /* Brown text on hover */
            border: 1px solid #8B4513; /* Brown border on hover */
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: block;
        }

        .alert-success {
            background-color: yellow; /* Yellow background for success */
            color: #000000; /* Black text color */
            border: 1px solid #ccc; /* Border for the alert */
        }

        .alert-danger {
            background-color: #f8d7da; /* Light red background for errors */
            color: #000000; /* Black text color */
            border: 1px solid #f5c6cb; /* Border for the alert */
        }

        /* Ensure all text is black */
        h4, h5, label, a, .form-control, .text-danger {
            color: #000000 !important; /* Black text */
        }

        /* Wider input fields */
        .form-control {
            width: 100%; /* Full width */
            padding: 10px; /* Larger padding for better usability */
            font-size: 1rem; /* Larger font size */
        }

        /* Larger button */
        .btn {
            padding: 10px 20px; /* Larger padding */
            font-size: 1.1rem; /* Larger font size */
        }

        /* Assistant Button at Top-Right Corner */
        #assistant-button {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #39FF14; /* Neon green */
            color: #000000; /* Black text */
            font-size: 1.1rem;
            border-radius: 5px; /* Soft edges */
            box-shadow: 0 4px 8px rgba(0, 100, 0, 0.2); /* Dark green shadow */
        }

        #assistant-button:hover {
            background-color: #2ecc71; /* Slightly darker green on hover */
        }
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <!-- Assistant Button at Top-Right Corner -->
			<div style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
                <!-- PDF Viewer Button -->
                <button id="assistant-button" class="btn">
                    <i class="bx bx-file"></i>
                </button>
                   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success') || session('status'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '{{ session('success') ?? session('status') }}',
    confirmButtonColor: '#3085d6',
});
</script>
@endif

<!-- Error Message -->
@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{ session('error') }}',
    confirmButtonColor: '#d33',
});
</script>
@endif

<!-- Validation Errors -->
@if ($errors->any())
<script>
Swal.fire({
    icon: 'warning',
    title: 'Validation Error',
    html: `{!! implode('<br>', $errors->all()) !!}`,
    confirmButtonColor: '#f39c12',
});
</script>
@endif
                
                <style>
                    /* Button style */
                    #assistant-button {
                        background-color: #39FF14;
                        color: #000000;
                        font-size: 1.1rem;
                        border: none;
                        border-radius: 50%;
                        width: 50px;
                        height: 50px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                        position: fixed;
                        bottom: 20px;
                        right: 20px;
                        z-index: 999;
                        transition: transform 0.3s ease;
                    }
            
                    #assistant-button:hover {
                        transform: scale(1.1);
                    }
            
                    /* Popup overlay */
                    .popup-overlay {
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-color: rgba(0,0,0,0.8);
                        display: none;
                        justify-content: center;
                        align-items: center;
                        z-index: 1000;
                        opacity: 0;
                        transition: opacity 0.3s ease;
                    }
            
                    .popup-overlay.active {
                        opacity: 1;
                    }
            
                    /* Popup content */
                    .popup-content {
                        background-color: white;
                        border-radius: 10px;
                        width: 90%;
                        max-width: 800px;
                        height: 90vh;
                        position: relative;
                        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                        transform: scale(0.9);
                        transition: transform 0.3s ease;
                    }
            
                    .popup-overlay.active .popup-content {
                        transform: scale(1);
                    }
            
                    /* Close button */
                    .close-btn {
                        position: absolute;
                        top: -15px;
                        right: -15px;
                        width: 40px;
                        height: 40px;
                        background-color: #ff4757;
                        color: white;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 20px;
                        cursor: pointer;
                        z-index: 1001;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                        border: none;
                    }
            
                    /* PDF viewer */
                    .pdf-viewer {
                        width: 100%;
                        height: 100%;
                        border: none;
                        border-radius: 10px;
                    }
            
                    /* Loading indicator */
                    .loading {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        color: #333;
                        font-size: 18px;
                    }
            
                    /* Responsive adjustments */
                    @media (max-width: 768px) {
                        .popup-content {
                            width: 95%;
                            height: 80vh;
                        }
                    }
                </style>
                
                
                <!-- PDF Popup -->
                <div class="popup-overlay" id="pdfPopup">
                    <div class="popup-content">
                        <button class="close-btn" id="closePdfBtn">&times;</button>
                        <div class="loading" id="loadingIndicator">Loading PDF...</div>
                        <iframe class="pdf-viewer" id="pdfViewer" style="display: none;"></iframe>
                    </div>
                </div>
            
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const assistantBtn = document.getElementById('assistant-button');
                        const pdfPopup = document.getElementById('pdfPopup');
                        const closeBtn = document.getElementById('closePdfBtn');
                        const pdfViewer = document.getElementById('pdfViewer');
                        const loadingIndicator = document.getElementById('loadingIndicator');
            
                        // Open popup when button is clicked
                        assistantBtn.addEventListener('click', function() {
                            // Show loading indicator
                            loadingIndicator.style.display = 'block';
                            pdfViewer.style.display = 'none';
                            
                            // Set PDF source to your Laravel route
                            pdfViewer.src = "{{ route('view.pdf') }}";
                            
                            // Show popup
                            pdfPopup.style.display = 'flex';
                            setTimeout(() => {
                                pdfPopup.classList.add('active');
                            }, 10);
                        });
            
                        // When PDF is loaded
                        pdfViewer.addEventListener('load', function() {
                            loadingIndicator.style.display = 'none';
                            pdfViewer.style.display = 'block';
                            
                            // Handle case where PDF fails to load
                            try {
                                if (this.contentDocument.body.innerHTML.includes('404') || 
                                    this.contentDocument.body.innerHTML.includes('Not Found')) {
                                    throw new Error('PDF not found');
                                }
                            } catch (e) {
                                loadingIndicator.textContent = 'Error loading PDF';
                                loadingIndicator.style.display = 'block';
                                pdfViewer.style.display = 'none';
                            }
                        });
            
                        // Close popup when close button is clicked
                        closeBtn.addEventListener('click', closePopup);
            
                        // Close popup when clicking outside
                        pdfPopup.addEventListener('click', function(e) {
                            if (e.target === pdfPopup) {
                                closePopup();
                            }
                        });
            
                        // Close popup with Escape key
                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape' && pdfPopup.style.display === 'flex') {
                                closePopup();
                            }
                        });
            
                        function closePopup() {
                            pdfPopup.classList.remove('active');
                            setTimeout(() => {
                                pdfPopup.style.display = 'none';
                                pdfViewer.src = '';
                                loadingIndicator.style.display = 'none';
                            }, 300);
                        }
                        
                        // Check if PDF exists when page loads
                        fetch("{{ route('view.pdf') }}")
                            .then(response => {
                                if (!response.ok) {
                                    assistantBtn.style.display = 'none';
                                }
                            })
                            .catch(() => {
                                assistantBtn.style.display = 'none';
                            });
                    });
                </script>
            </div>
			
			<!-- Text-to-Speech Script -->
			

            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="login-container">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <img src="{{asset('') }}assets/images/KSG Logo (1).png" width="80" alt="KSG Logo" />
                                        <h4 class="mt-2">KSG Career Portal</h4>
                                    </div>
                                    <!-- Success Message -->
                                    @if (session('status'))
                                        <div class="alert alert-success" id="success-message">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <!-- General Error Message -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger" id="error-message">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="text-center mb-4">
                                        <h4>Login with your Unified Payroll Number</h4>
                                       
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ route('HR') }}" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">UPN No:</label>
                                                <input type="text" class="form-control" name="upn_no" placeholder="123456789">
                                            </div>
                                         
                                    
                                          
                                               <!-- Forgot Password Link -->

  
  <!-- UPN Modal -->
 
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                   
                                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{asset('') }}assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{asset('') }}assets/js/jquery.min.js"></script>
</body>

</html>