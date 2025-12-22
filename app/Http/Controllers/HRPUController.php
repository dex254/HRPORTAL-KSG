<?php

namespace App\Http\Controllers;

use App\Models\HRPU;
use App\Models\Nationality;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\HrpuWelcomeMail;
use Illuminate\Support\Carbon;
use App\Mail\TemporaryPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HRPUController extends Controller
{
    //
     public function info()
    {
        return view('HRPU.web'); // Assuming 'Staff.login' is the name of your login page view
    }
     public function singnup()
    {
        return view('HRPU.Register'); // Assuming 'Staff.login' is the name of your login page view
    }
    public function HRPUlogin()
    {
        return view('HRPU.Login'); // Assuming 'Staff.login' is the name of your login page view
    }

    public function registerHrpu(Request $request)
{
    // Validate form inputs
    $request->validate([
        'email' => 'required|email|unique:hrpu,email',
        'password' => 'required|min:6|confirmed', // handles confirmation via password_confirmation
    ]);

    // Generate unique 6-digit upn_no
    do {
         $randomNumber = random_int(100000, 999999);
        $upn_no = 'ADJ-' . $randomNumber; // generates 6-digit number
    } while (HRPU::where('upn_no', $upn_no)->exists());

   $hrpu = HRPU::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'upn_no' => $upn_no,
    ]);
    Mail::to($hrpu->email)->send(new HrpuWelcomeMail($hrpu));

    return redirect()->back()->with('success', 'Your account has been successfully created. Check your email to know your security key.');

}

 public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find Admin by email
        $hrpu = HRPU::where('email', $credentials['email'])->first();

        // Check if Admin exists and password matches
        if  ($hrpu && Hash::check($credentials['password'], $hrpu->password)) {
            Auth::guard('HRPU')->login($hrpu);
            $hrpu->online_status = true;
            $hrpu->login_time =Carbon::now('Africa/Nairobi');
            $hrpu->save();
           

            // For any other roles, redirect to Admin dashboard
            return redirect()->route('HRPU.Dashboard')->with([
    'success' => 'Welcome back!  Please update your personal information before proceeding with your application.',
    'status' => 'Join Our Adjunct Faculty
Contribute to shaping the future of public service in Kenya through training, research, and consultancy',
]);        } else {
            return redirect()->route('HRPU')->withErrors([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }
    }

    public function hrpudashboard(Request $request)
    {
        // Get the currently authenticated staff member
        $hrpu = Auth::guard('HRPU')->user();
         $nationalities = Nationality::orderBy('name')->get();
        // Fetch all applications grouped by designation and Ref_No
          
        return view('HRPU.Dashboard', compact('hrpu','nationalities')); // Example: Load Admin dashboard view

    }
    
    

    public function logout(Request $request)
    {
        Auth::guard('HRPU')->logout(); // Logout the Admin user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('HRPU'); // Redirect to Admin login page
    }

    public function hrpudestroy(Request $request)
    {
        $hrpu = Auth::guard('HRPU')->user();

        if ($hrpu) {
        // Set status to offline

        $hrpu->online_status = false;
        $hrpu->logout_time =Carbon::now('Africa/Nairobi');
        $hrpu->save();
    }
        Auth::guard('HRPU')->logout(); // Logout the Admin user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('HRPU'); // Redirect to Admin login page
    }
    public function extupdatemy(Request $request)
{
    $hrpu = Auth::guard('HRPU')->user();

    if (!$hrpu) {
        return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
    }

    // Validate inputs
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:hrpu,email,' . $hrpu->id,
        'mobile_no' => 'required|string|max:20|unique:hrpu,mobile_no,' . $hrpu->id,
        'dob' => 'required|date',
        'postal_address' => 'required|string|max:255',
        'nationality' => 'required|string|max:100',
    ]);

    // Update fields
    $hrpu->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'mobile_no' => $validatedData['mobile_no'],
        'dob' => $validatedData['dob'],
        'postal_address' => $validatedData['postal_address'],
        'nationality' => $validatedData['nationality'],
    ]);

    return redirect()->back()->with('status', 'Profile updated successfully! Application status is now 80%.');
}
 public function apsTempPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $hrpu = HRPU::where('email', $request->email)->first();

    if (!$hrpu) {
        return redirect()->back()->withErrors(['email' => 'The email address is invalid. Kindly contact support for assistance.']);
    }

    $tempPassword = Str::random(8);
    $expiryTime = Carbon::now()->addMinutes(30);

    // Create a unique token for the reset link
    $resetToken = Str::random(60);

    $hrpu->temp_password = Hash::make($tempPassword);
    $hrpu->temp_password_expiry = $expiryTime;
    $hrpu->password = Hash::make($tempPassword);
    $hrpu->password_status = 'Temporary';
    $hrpu->reset_token = $resetToken;  // new DB field for token
    $hrpu->save();

    // Send email with reset link containing the token
    Mail::to($hrpu->email)->send(new TemporaryPasswordMail($hrpu, $tempPassword, $resetToken));

    return redirect()->back()->with('success', 'A temporary password has been sent to your email.');
}
// Show the form with the temp password readonly
public function showSetPasswordForm($token)
{
    $hrpu = HRPU::where('reset_token', $token)
              ->where('temp_password_expiry', '>', Carbon::now())
              ->first();

    if (!$hrpu) {
        return redirect()->route('aps')->withErrors(['token' => 'This password reset link is invalid or expired.']);
    }

    // We will pass the hashed temp_password, but ideally you want to store/display the plain temp password in session/email only.
    // Since it's hashed, we can't show it here, so better to ask the user to check email for the temp password.

    return view('HRPU.Set', compact('hrpu'));
}

// Handle password update
public function setNewPassword(Request $request)
{
    $request->validate([
        'reset_token' => 'required',
        'new_password' => 'required|string|min:8|confirmed',  // confirmed expects 'new_password_confirmation'
    ]);

    $hrpu = HRPU::where('reset_token', $request->reset_token)
              ->where('temp_password_expiry', '>', Carbon::now())
              ->first();

    if (!$hrpu) {
        return redirect()->route('HRPU')->withErrors(['token' => 'This password reset token is invalid or expired.']);
    }

    // Update the password
    $hrpu->password = Hash::make($request->new_password);
    $hrpu->password_status = 'Active';

    // Clear temporary password and token
    $hrpu->temp_password = null;
    $hrpu->temp_password_expiry = null;
    $hrpu->reset_token = null;

    $hrpu->save();

    return redirect()->route('HRPU')->with('success', 'Your password has been updated successfully. Please login.');
}

}
