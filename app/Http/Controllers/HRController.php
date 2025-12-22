<?php

namespace App\Http\Controllers;

use App\Models\HR;
use App\Imports\HRImport;
use App\Mail\HRUpdateMail;
use App\Mail\HRWelcomeMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\PasswordRecoveryMail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class HRController extends Controller
{
    //
    public function HRlogin()
    {
        return view('HR.Login'); // Assuming 'Staff.login' is the name of your login page view
    }
    
    public function showOTPForm()
    {
        return view('HR.OTP'); // Assuming 'Staff.login' is the name of your login page view
    }
public function login(Request $request)
{
    $request->validate([
        'upn_no' => 'required|string',
    ]);

    // Find HR record by UPN
    $hr = HR::where('upn_no', $request->upn_no)->first();
    
    if (!$hr) {
        return redirect()->route('HR')
            ->with('status', 'No account found with this UPN number')
            ->with('alert-type', 'danger');
    }

    // Generate temporary password (OTP)
    $otp = Str::random(8);

    // Store in session for verification
    session([
        'upn_no' => $hr->upn_no,
        'temp_password' => $otp
    ]);

    // Save hashed OTP in DB
    $hr->update([
        'password' => Hash::make($otp),
        'password_change_allowed' => false,
        'password_changed_at' => now()
    ]);

    // Send email with OTP + verification link
    Mail::to($hr->email)->send(new PasswordRecoveryMail($hr, $otp));

    return redirect()->route('HR.OTP')
        ->with('status', 'A temporary password has been sent to your email. Enter it to proceed.')
        ->with('alert-type', 'success');
}

    public function verifyOtp(Request $request)
{
    $request->validate([
        'password' => 'required|string'
    ]);

    // Retrieve UPN and temporary password from session
    $upn_no = session('upn_no');
    $storedPassword = session('temp_password');

    if (!$upn_no || !$storedPassword) {
        return redirect()->route('HR')
            ->with('status', 'Session expired. Please try logging in again.')
            ->with('alert-type', 'danger');
    }

    // Find HR user by UPN number
    $hr = HR::where('upn_no', $upn_no)->first();

    if (!$hr) {
        return redirect()->route('HR')
            ->with('status', 'No account found. Please try again.')
            ->with('alert-type', 'danger');
    }

    // Verify the entered password with the session OTP (not hashed)
    if ($request->password !== $storedPassword) {
        return redirect()->route('HR')
            ->with('status', 'Invalid password. Please try again.')
            ->with('alert-type', 'danger');
    }

    // Clear temporary password from session after successful verification
    session()->forget('temp_password');

    // Log in user
    Auth::guard('HR')->login($hr);

    // Update login timestamp
    $hr->updated_at = Carbon::now('Africa/Nairobi');
    $hr->save();

    // Redirect to dashboard
    return redirect()->route('HR.Dashboard')
        ->with('success', 'Kindly update your data before applying for any job.');
}
public function resendOtp(Request $request)
{
    $upn_no = session('upn_no');

    if (!$upn_no) {
        return redirect()->route('HR')
            ->with('status', 'Session expired. Please try logging in again.')
            ->with('alert-type', 'danger');
    }

    $hr = HR::where('upn_no', $upn_no)->first();
    if (!$hr) {
        return redirect()->route('HR')
            ->with('status', 'No account found.')
            ->with('alert-type', 'danger');
    }

    // Generate new OTP
    $otp = Str::random(8);

    session(['temp_password' => $otp]);

    $hr->update([
        'password' => Hash::make($otp),
        'password_change_allowed' => false,
        'password_changed_at' => now()
    ]);

    Mail::to($hr->email)->send(new PasswordRecoveryMail($hr, $otp));

    return redirect()->route('HR.OTP')
        ->with('status', 'A new temporary password has been sent to your email.')
        ->with('alert-type', 'success');
}
public function autoVerify(Request $request)
{
    $request->validate([
        'upn_no' => 'required|string',
        'otp' => 'required|string'
    ]);

    // Find HR user
    $hr = HR::where('upn_no', $request->upn_no)->first();

    if (!$hr) {
        return redirect()->route('HR')
            ->with('status', 'Account not found.')
            ->with('alert-type', 'danger');
    }

    // Check if OTP matches the session password
    $storedPassword = session('temp_password');

    if (!$storedPassword || $storedPassword !== $request->otp) {
        return redirect()->route('HR')
            ->with('status', 'Invalid or expired verification link.')
            ->with('alert-type', 'danger');
    }

    // Clear OTP from session
    session()->forget('temp_password');

    // Login HR
    Auth::guard('HR')->login($hr);

    // Update login timestamp
    $hr->updated_at = Carbon::now('Africa/Nairobi');
    $hr->save();

    return redirect()->route('HR.Dashboard')
        ->with('success', 'You have been successfully verified and logged in.');
}



public function r(Request $request)
{
    $request->validate([
        
        'password' => 'required|string'
    ]);
    $upn_no = session('upn_no');
    $storedPassword = session('password');
    if (!$upn_no || !$storedPassword) {
        return redirect()->route('HR')
            ->with('status', 'Session expired. Please try logging in again.')
            ->with('alert-type', 'danger');
    }

    // Find HR user by UPN number
    $hr = HR::where('upn_no', $request->upn_no)->first();

    if (!$hr || !Hash::check($request->password, $hr->password)) {
        return redirect()->route('HR.OTP')
            ->with('status', 'Invalid OTP. Please try again.')
            ->with('alert-type', 'danger');
    }
    session()->forget('password');
    // Log in user
    Auth::guard('HR')->login($hr);

    // Update login timestamp
    $hr->updated_at = Carbon::now('Africa/Nairobi');
    $hr->save();

    // Redirect to dashboard
    return redirect()->route('HR.Dashboard')
    ->with('success', 'Kindly update your data before applying for any job.');
        
}
    public function HRDashboard(Request $request)
    {
        // Get the currently authenticated staff member
        $hr = Auth::guard('HR')->user();
        $upn_no = Auth::guard('HR')->user()->upn_no;
       

        return view('HR.Dashboard', compact('hr','upn_no'));// Example: Load Staff dashboard view
    }
   
    public function exellupload()
{
    $admin = Auth::guard('admin')->user();
   
    if (in_array($admin->role, ['Admin', 'dex', 'Admissions','AdminAssistant'])) {
        // Fetch all programs for these roles
        return view('HR.exellupload');

   
    }

    return redirect()->route('Admin.Dashboard')->with('error', 'You are not authorized to access this page.');
}
public function logout(Request $request)
    {

        $hr = Auth::guard('HR')->user();
        $hr = new HR();
        if ($hr) {
        // Set status to offline
       
        $hr->updated_at = Carbon::now('Africa/Nairobi'); 
        $hr->save();
    }
        Auth::guard('HR')->logout();
        // Logout the Staff user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('HR'); // Redirect to Staff login page
    }
    public function destroy(Request $request)
    {
        $hr = Auth::guard('HR')->user();
        
        if ($hr) {
        // Set status to offline
        
        
        $hr->updated_at =Carbon::now('Africa/Nairobi'); 
        $hr->save();
    }
        Auth::guard('HR')->logout(); // Logout the Staff user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('HR'); // Redirect to Staff login page
    }
public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new HRImport, $request->file('file'));

        return back()->with('success', 'Excel file imported successfully!');
    }
  public function staffall(Request $request)
{
    $admin = Auth::guard('admin')->user();

    // Define the allowed roles
    $allowedRolesForAllCampuses = ['Admin', 'dex'];
    $allowedRolesForSameCampus = ['AdminAssistant'];

    // Base query
    $query = HR::query();

    // Role-based filtering
    if ($admin && in_array($admin->role, $allowedRolesForAllCampuses)) {
        // Admins and developers see all records
    } elseif ($admin && in_array($admin->role, $allowedRolesForSameCampus)) {
        // AdminAssistants see only records from their campus
        $query->where('campus', $admin->campus);
    } else {
        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // Select only necessary fields for the table
    $hr = $query->select(
        'id', 'payroll_num', 'upn_no', 'name', 'designation', 'job_group', 
        'campus', 'job_designation', 'job_code', 'idnumber', 'ethnicity', 
        'dob', 'disability', 'gender', 'first_date_of_appointment', 
        'current_date_of_appointment', 'home_county', 'email', 'phone'
    )
    ->orderBy('name', 'asc') // optional: order by name
    ->get();

    // Return the view
    return view('HR.staffdata', compact('hr'));
}

    public function updatemy(Request $request)
{
    // Get the authenticated HR user
    $hr = Auth::guard('HR')->user();

    if (!$hr) {
        return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
    }

    // Validate form inputs
    $validatedData = $request->validate([
        'name' => 'nullable|string',
        'campus' => 'nullable|string',
        'disability' => 'nullable|string',
        'email' => 'nullable|string|email',
        'phone' => 'nullable|string',
        'disability_description' => 'nullable|string',
        'ethnicity' => 'nullable|string',
        'home_county' => 'nullable|string',
    ]);

    // Restrict email and phone updates if already taken by another user
    if (
        ($request->filled('email') && $request->email !== $hr->email && HR::where('email', $request->email)->exists()) ||
        ($request->filled('phone') && $request->phone !== $hr->phone && HR::where('phone', $request->phone)->exists())
    ) {
        return redirect()->back()->withErrors(['error' => 'The Email or Phone number has already been taken.']);
    }

    // Ensure "disability_description" is null if "disability" is "No"
    if ($request->disability === 'No') {
        $validatedData['disability_description'] = null;
    }

    // Set application_status to 80%
    $validatedData['application_status'] = 80;

    // Update HR user data
    $hr->update($validatedData);

    return redirect()->back()->with('status', 'Profile updated successfully! Application status is now 80%.');
}
 public function hrnowstore(Request $request)
    {
        // Validate only the required fields
        $validator = Validator::make($request->all(), [
            's_no' => 'required|string|max:255',
            'payroll_num' => 'required|string|max:255',
            'upn_no' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'idnumber' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Create new HR record
        $hr = new HR();
        $hr->s_no = $request->s_no;
        $hr->payroll_num = $request->payroll_num;
        $hr->upn_no = $request->upn_no;
        $hr->name = $request->name;
        $hr->email = $request->email;
        $hr->phone = $request->phone;
        $hr->idnumber = $request->idnumber;

        // Optional fields
        $hr->gender = $request->gender;
        $hr->dob = $request->dob;
        $hr->ethnicity = $request->ethnicity;
        $hr->disability = $request->disability;
        $hr->disability_description = $request->disability_description;
        $hr->designation = $request->designation;
        $hr->job_group = $request->job_group;
        $hr->campus = $request->campus;
        $hr->job_designation = $request->job_designation;
        $hr->job_code = $request->job_code;
        $hr->home_county = $request->home_county;
        $hr->first_date_of_appointment = $request->first_date_of_appointment;
        $hr->current_date_of_appointment = $request->current_date_of_appointment;
        $hr->academic_qualifications = $request->academic_qualifications;
        $hr->ongoing_long_courses = $request->ongoing_long_courses;
        $hr->career_guideline_requirements = $request->career_guideline_requirements;
        $hr->identified_gaps = $request->identified_gaps;
        $hr->status = $request->status;
        $hr->application_status = $request->application_status;

        $hr->save();
         Mail::to($hr->email)->send(new HRWelcomeMail($hr));

        return redirect()->back()->with('success', 'HR record has been saved successfully!');
    }
    public function hrnowupdate(Request $request, $id)
{
    $hr = HR::findOrFail($id);

    $hr->name = $request->name;
    $hr->email = $request->email;
    $hr->phone = $request->phone;
    $hr->job_group = $request->job_group;
    $hr->campus = $request->campus;
    $hr->home_county = $request->home_county;

    $hr->save();
    Mail::to($hr->email)->send(new HRUpdateMail($hr));

    return redirect()->back()->with('success', 'HR record updated successfully!');
}


    
    
}
