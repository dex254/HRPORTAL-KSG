<?php

namespace App\Http\Controllers;

use Image;

use Carbon\Carbon;
use App\Models\JOB;
use App\Models\Admin;
use App\Models\EXTJOB;
use App\Models\JOBExt;
use App\Models\Assesment;

use App\Models\Timetable;
use App\Mail\AdminOtpMail;
use App\Models\Curriculum;
use App\Models\Application;
use App\Models\Coordinator;
use App\Models\Facilitator;
use App\Models\Participants;
use Illuminate\Http\Request;
use App\Models\Newcurriculum;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;





class AdminController extends Controller
{
    //
    public function adminlogin()
    {
        return view('admin.login'); // Assuming 'Admin.login' is the name of your login page view
    }
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Find Admin by email
    $admin = Admin::where('email', $credentials['email'])->first();

    // Check if Admin exists and password matches
    if ($admin && Hash::check($credentials['password'], $admin->password)) {

        // Generate OTP
        $otp = random_int(100000, 999999);

        // Save OTP and expiration time
        $admin->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP Email
        Mail::to($admin->email)->send(new AdminOtpMail($admin, $otp));

        // Redirect to OTP Verification Page
        return redirect()
            ->route('Admin.otp', ['email' => $admin->email])
            ->with('success', 'An OTP has been sent to your email. Please verify.');
    } 
    else {
        return redirect()->route('admin')->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }
}
  public function showOtpadmin(Request $request)
    {
        $email = $request->query('email');
        return view('Admin.otp', compact('email'));
    }

    // Resend OTP
    public function resendOtpadmin(Request $request)
    {
        $email = $request->query('email');

        $admin = Admin::where('email', $email)->first();
        if (!$admin) {
            return redirect()->route('Admin.otp', ['email' => $email])->with('error', 'Email not found.');
        }

        $otp = random_int(100000, 999999);
        $admin->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($admin->email)->send(new AdminOtpMail($admin, $otp));

        return redirect()->route('Admin.otp', ['email' => $email])
            ->with('success', 'A new OTP has been sent to your email.');
    }

    // Verify OTP POST
    public function verifyOtpadmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin,email',
            'otp' => 'required|digits:6',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || $admin->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP.'])->withInput();
        }

        if (now()->greaterThan($admin->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired. Please login again.'])->withInput();
        }

        $admin->update([
            'otp' => null,
            'otp_expires_at' => null,
            'login_time' => Carbon::now('Africa/Nairobi'),
    
            'is_online' => true,
           
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
    }

    // Quick verify via email button
    public function quickVerifyOtpadmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin,email',
            'otp' => 'required|digits:6',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || $admin->otp != $request->otp) {
            return redirect()->route('Admin.otp', ['email' => $request->email])
                ->with('error', 'Invalid verification link.');
        }

        if (now()->greaterThan($admin->otp_expires_at)) {
            return redirect()->route('Admin.otp', ['email' => $request->email])
                ->with('error', 'Verification link expired. Please login again.');
        }

        $admin->update([
            'otp' => null,
            'otp_expires_at' => null,
            'login_time' => Carbon::now('Africa/Nairobi'),
           
            'is_online' => true,
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
    }


    // public function adminDashboard(Request $request)
    // {
    //     // Get the currently authenticated staff member
    //     $admin = Auth::guard('admin')->user();
    //     // Fetch all applications grouped by designation and Ref_No
    //         $groupedApplicants = Application::select('upn_no', 'name')
    //        //->whereDate('created_at', '>=', '2025-06-30')
    //        ->whereRaw('upn_no REGEXP "^[0-9]+$"')
    //         ->groupBy('upn_no', 'name')
    //         ->selectRaw('COUNT(*) as total_applications')
    //         ->selectRaw('SUM(CASE WHEN status = "Applied" THEN 1 ELSE 0 END) as applied_count')
    //         ->selectRaw('SUM(CASE WHEN status = "Qualified" THEN 1 ELSE 0 END) as qualified_count')
    //         ->selectRaw('SUM(CASE WHEN status = "Not Qualified" THEN 1 ELSE 0 END) as not_qualified_count')
    //         ->get();
    //     return view('admin.Dashboard', compact('admin','groupedApplicants')); // Example: Load Admin dashboard view

    // }
    public function adminDashboard()
{
    // Logged-in Admin
    $admin = Auth::guard('admin')->user();

    // =======================
    // JOB ADVERT COUNTS
    // =======================
    $totalInternalJobs = JOB::count();        // Internal jobs
    $totalExternalJobs = EXTJOB::count();     // External jobs
    $totalAdjunctJobs  = JOBExt::count();     // Adjunct jobs

    // =======================
    // APPLICATION COUNTS
    // =======================

    // Internal: numeric UPNs OR starting with NB-
    $totalInternalApplications = Application::where(function($query){
        $query->whereRaw("upn_no REGEXP '^[0-9]+$'")
              ->orWhere('upn_no', 'LIKE', 'NB-%');
    })->count();

    // External: starting with EXT-
    $totalExternalApplications = Application::where('upn_no', 'LIKE', 'EXT-%')->count();

    // Adjunct: starting with ADJ-
    $totalAdjunctApplications  = Application::where('upn_no', 'LIKE', 'ADJ-%')->count();

    // =======================
    // RETURN DASHBOARD VIEW
    // =======================
    return view('admin.Dashboard', [
        'admin' => $admin,

        // Job adverts
        'internalJobs' => $totalInternalJobs,
        'externalJobs' => $totalExternalJobs,
        'adjunctJobs'  => $totalAdjunctJobs,

        // Applications
        'internalApps' => $totalInternalApplications,
        'externalApps' => $totalExternalApplications,
        'adjunctApps'  => $totalAdjunctApplications,
    ]);
}

    

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Logout the Admin user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('admin'); // Redirect to Admin login page
    }

    public function destroy(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin) {
        // Set status to offline

        $admin->is_online = false;
        $admin->logout_time =Carbon::now('Africa/Nairobi');
        $admin->save();
    }
        Auth::guard('admin')->logout(); // Logout the Admin user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('admin'); // Redirect to Admin login page
    }
    public function index2()
    {
        $admin = Auth::guard('admin')->user(); // Use guard for admin
        $allowedRoles = ['Admin', 'AdminAssistant','Dex'];

        // Check if the user has one of the allowed roles
        if ($admin && (in_array($admin->role, $allowedRoles) || $admin->role === 'dex')){
            return view('admin.add_admin', ['admin' => $admin]); // Pass the admin to the view
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.'); // Redirect with error message


    }
    public function store(Request $request)
    {
        // Validate form inputs
        $admin = Auth::guard('admin')->user();
        $validatedData = $request->validate([
            'name' => 'required|string',

            'idnumber' => 'required|string|unique:admin',
            'phone' => 'required|string|unique:admin',
            'email' => 'required|string|unique:admin',
            'role' => 'required|string',
            'image' => 'nullable',
            'campus' => 'nullable',
            'password' => 'required|string',


                ]);
                $existingadmin = Admin::where('email', $validatedData['email'])
                ->orWhere('phone', $validatedData['phone'])
                ->orWhere('idnumber', $validatedData['idnumber'])
                ->first();

            if ($existingadmin) {
                // admin already exists, show error message
                return redirect()->back()->withErrors([
                    'email' => 'Do you already have an account?',
                    'idnumber' => 'Do you already have an account?',
                    'phone' => 'Do you already have an account?',
                ]);
            }
            $imagePath = null;  // Initialize image path variable
            if ($request->hasFile('image')) {
                // Generate a unique name for the image (e.g., time-based)
                $image = time() . '.' . $request->image->getClientOriginalExtension();

                // Move the uploaded image to the 'public/profile' directory
                $request->image->move(public_path('profile'), $image);

                // Store the image file path in the $imagePath variable
                $imagePath = '' . $image;  // Save the relative path in the database
            }

            if ($admin->role == 'AdminAssistant') {
                // Only allow creating 'AdminAssistant', 'Manager', 'Support' roles
                if (!in_array($validatedData['role'], ['AdminAssistant', 'Manager', 'Support'])) {
                    return redirect()->back()->withErrors([
                        'role' => 'You can only assign roles of Admin Assistant, Manager, or Support.',
                    ]);
                }

                // Admin Assistant can only add for their own campus
                if ($validatedData['campus'] !== $admin->campus) {
                    return redirect()->back()->withErrors([
                        'campus' => 'You can only assign admins to your own campus.',
                    ]);
                }
            }


        $admin = new Admin();

        $admin->name = $validatedData['name'];
        $admin->idnumber = $validatedData['idnumber'];
        $admin->phone = $validatedData['phone'];
        $admin->email = $validatedData['email'];
        $admin->role = $validatedData['role'];
        $admin->campus = $validatedData['campus'];
        $admin->image =  $imagePath;
        $admin->password =  Hash::make($validatedData['password']);

        $admin->save();

        // Redirect back with a success message
        if ($admin->save()) {
            // Redirect back with a success message
            return redirect()->back()->with('success', 'You have regisatred to the KSG device request system. Welcome!');
        } else {
            // Redirect back with an error message in case of failure
            return redirect()->back()->withErrors([
                'general' => 'An error occurred while storing data. Please try again later.',
            ]);
        }
    }
    public function profile(Request $request)

    {


    $admin = $request->admin;
    $admin = Auth::guard('admin')->user();


    // Return a response or pass the data to the view
    return view('admin.profile', compact('admin'));

    }
    public function profilead(Request $request)

    {


    $admin = $request->admin;
    $admin = Auth::guard('admin')->user();


    // Return a response or pass the data to the view
    return view('Admissions.profile', compact('admin'));

    }
    public function profiledaa(Request $request)

    {


    $admin = $request->admin;
    $admin = Auth::guard('admin')->user();


    // Return a response or pass the data to the view
    return view('DAA.profile', compact('admin'));

    }
    public function uadminupdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);


        $admin = Auth::guard('admin')->user();

        // Check if the provided current password matches the authenticated participant's password
        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided current password is incorrect.']);
        }

        // Update the participant's password
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin')->with('success', 'Password updated successfully.');

    }
    public function selfedit()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.edit', compact('admin'));
    }
    public function selfeditdaa()
    {
        $admin = Auth::guard('admin')->user();

        return view('DAA.edit', compact('admin'));
    }
    public function selfeditad()
    {
        $admin = Auth::guard('admin')->user();

        return view('Admissions.edit', compact('admin'));
    }
    public function selfupdate(Request $request)
    {
        // Handle GET request to fetch the check-in record
        $admin = Auth::guard('admin')->user();

        // Handle PUT request to update the check-in record
        $validatedData = $request->validate([

            'name' => 'nullable|string',

            'phone' => 'nullable|string|unique:admin,phone,'. $admin->id,
            'email' => 'nullable|string|unique:admin,email,'. $admin->id,
            'campus' => 'nullable|string',
            'image' => 'nullable|image',


            // Add other validation rules as needed
        ]);
      if ($request->hasFile('image')) {

    $imageFile = $request->file('image');
    $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
    $destinationPath = public_path('profile');

    // Read the image
    $image = Image::read($imageFile->getRealPath());

    // Resize (scale) using positional params
    // (width, height, keep_aspect_ratio)
    $image->scale(1920, 1080, true);

    // Save (path, quality)
    $image->save($destinationPath . '/' . $imageName, 100);
}

        // Update the admin record with validated data and the new image path
        $admin->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'campus' => $request->campus,
            'image' => isset($imageName) ? $imageName : $admin->image, // Only update image if it was uploaded
        ]);

        // Redirect with a success message
        return redirect()->route('admin')->with('success', 'You have successfully updated your profile details.');
    }
    //staff  records
    public function delete($id)
    {

        // Find the admin record by its ID
        $admin = Admin::find($id);

        // Check if the admin record exists
        if (!$admin) {
            return back()->with('error', 'Admin data not found.');

        }

        // Attempt to delete the admin record
        try {
            $admin->delete();
            return back()->with('success', 'Admin data deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error in deleting admin data. Try again later.');
        }
    }


}
