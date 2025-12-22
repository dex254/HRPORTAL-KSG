<?php

namespace App\Http\Controllers;

use App\Models\EXT;
use App\Models\Nationality;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EXTWelcomeMail;
use Illuminate\Support\Carbon;
use App\Mail\TemporaryPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemporaryEXTPasswordMail;

class EXTController extends Controller
{
    //
     
     public function EXTsingnup()
    {
        return view('EXT.Register'); // Assuming 'Staff.login' is the name of your login page view
    }
    public function EXTlogin()
    {
        return view('EXT.Login'); // Assuming 'Staff.login' is the name of your login page view
    }

    public function registerEXT(Request $request)
{
    // Validate form inputs
    $request->validate([
        'email' => 'required|email|unique:ext,email',
        'password' => 'required|min:6|confirmed', // handles confirmation via password_confirmation
    ]);

    // Generate unique 6-digit upn_no
    do {
         $randomNumber = random_int(100000, 999999);
        $upn_no = 'EXT-' . $randomNumber; // generates 6-digit number
    } while (EXT::where('upn_no', $upn_no)->exists());

   $ext = EXT::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'upn_no' => $upn_no,
    ]);
    Mail::to($ext->email)->send(new EXTWelcomeMail($ext));

    return redirect()->back()->with('success', 'Your account has been successfully created. Check your email to know your security key.');

}

 public function Loginext(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find Admin by email
        $ext = EXT::where('email', $credentials['email'])->first();

        // Check if Admin exists and password matches
        if  ($ext && Hash::check($credentials['password'], $ext->password)) {
            Auth::guard('EXT')->login($ext);
            $ext->online_status = true;
            $ext->login_time =Carbon::now('Africa/Nairobi');
            $ext->save();
           

            // For any other roles, redirect to Admin dashboard
            return redirect()->route('EXT.Dashboard')->with([
    'success' => 'Welcome back!  Please update your personal information before proceeding with your application.',
    'status' => 'This  is  the KSG   portal Welcome',
]);        } else {
            return redirect()->route('EXT')->withErrors([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }
    }

    public function EXTdashboard(Request $request)
    {
        // Get the currently authenticated staff member
        $ext = Auth::guard('EXT')->user();
         $nationalities = Nationality::orderBy('name')->get();
        // Fetch all applications grouped by designation and Ref_No
          
        return view('EXT.Dashboard', compact('ext','nationalities')); // Example: Load Admin dashboard view

    }
    
    

    public function logout(Request $request)
    {
        Auth::guard('EXT')->logout(); // Logout the Admin user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('EXT'); // Redirect to Admin login page
    }

    public function EXTdestroy(Request $request)
    {
        $ext = Auth::guard('EXT')->user();

        if ($ext) {
        // Set status to offline

        $ext->online_status = false;
        $ext->logout_time =Carbon::now('Africa/Nairobi');
        $ext->save();
    }
        Auth::guard('EXT')->logout(); // Logout the Admin user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('EXT'); // Redirect to Admin login page
    }
public function extupdatemyEXT(Request $request)
{
    $ext = Auth::guard('EXT')->user();

    if (!$ext) {
        return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
    }

    // Validate inputs
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:ext,email,' . $ext->id,
        'mobile_no' => 'required|string|max:20|unique:ext,mobile_no,' . $ext->id,
        'dob' => 'required|date',
        'postal_address' => 'required|string|max:255',
        'nationality' => 'required|string|max:100',
        'document' => 'nullable|file',
        'disability' => 'required|in:Yes,No',
        'disability_description' => 'nullable|string|max:255',
        'idnumber' => 'nullable|string|max:100',
        'home_county' => 'nullable|string|max:100',
        'gender' => 'nullable|string|max:10',
        'ethnicity' => 'nullable|string|max:10',
    ]);

    // Prepare update data
    $updateData = [
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'mobile_no' => $validatedData['mobile_no'],
        'dob' => $validatedData['dob'],
        'postal_address' => $validatedData['postal_address'],
        'nationality' => $validatedData['nationality'],
        'disability' => $validatedData['disability'],
        'disability_description' => $validatedData['disability_description'],
        'idnumber' => $validatedData['idnumber'],
        'home_county' => $validatedData['home_county'],
        'gender' => $validatedData['gender'],
        'ethnicity' => $validatedData['ethnicity'],
    ];

    // Handle document upload if present
   if ($request->hasFile('document')) {
        $file = $request->file('document');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/PWD'), $filename);
        $updateData['documentName'] = $filename;
    }

    // 🔥 Force fill and save
    $ext->forceFill($updateData)->save();

    return redirect()->back()->with('status', 'Profile updated successfully! Application status is now 80%.');
}


// Show the form with the temp password readonly


// Handle password update


 public function extpassword()
    {

        return view('EXT.Password');
    }
    public function extTempPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $ext = EXT::where('email', $request->email)->first();

    if (!$ext) {
        return redirect()->back()->withErrors(['email' => 'The email address is invalid. Kindly contact support for assistance.']);
    }

    $tempPassword = Str::random(8);
    $expiryTime = Carbon::now()->addMinutes(30);

    // Create a unique token for the reset link
    $resetToken = Str::random(60);

    $ext->temp_password = Hash::make($tempPassword);
    $ext->temp_password_expiry = $expiryTime;
    $ext->password = Hash::make($tempPassword);
    $ext->password_status = 'Temporary';
    $ext->reset_token = $resetToken;  // new DB field for token
    $ext->save();

    // Send email with reset link containing the token
    Mail::to($ext->email)->send(new TemporaryEXTPasswordMail($ext, $tempPassword, $resetToken));

    return redirect()->back()->with('success', 'A temporary password has been sent to your email.');
}
// Show the form with the temp password readonly
public function EXTshowSetPasswordForm($token)
{
    $ext = EXT::where('reset_token', $token)
              ->where('temp_password_expiry', '>', Carbon::now())
              ->first();

    if (!$ext) {
        return redirect()->route('EXT')->withErrors(['token' => 'This password reset link is invalid or expired.']);
    }

    // We will pass the hashed temp_password, but ideally you want to store/display the plain temp password in session/email only.
    // Since it's hashed, we can't show it here, so better to ask the user to check email for the temp password.

    return view('EXT.Set', compact('ext'));
}

// Handle password update
public function extsetNewPassword(Request $request)
{
    $request->validate([
        'reset_token' => 'required',
        'new_password' => 'required|string|min:8|confirmed',  // confirmed expects 'new_password_confirmation'
    ]);

    $ext = EXT::where('reset_token', $request->reset_token)
              ->where('temp_password_expiry', '>', Carbon::now())
              ->first();

    if (!$ext) {
        return redirect()->route('EXT')->withErrors(['token' => 'This password reset token is invalid or expired.']);
    }

    // Update the password
    $ext->password = Hash::make($request->new_password);
    $ext->password_status = 'Active';

    // Clear temporary password and token
    $ext->temp_password = null;
    $ext->temp_password_expiry = null;
    $ext->reset_token = null;

    $ext->save();

    return redirect()->route('EXT')->with('success', 'Your password has been updated successfully. Please login.');
}

}
