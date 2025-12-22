<?php

namespace App\Http\Controllers;

use App\Models\HR;
use App\Models\HRPU;
use App\Models\Staff;
use App\Models\Password;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\PasswordRecoveryMail;
use Illuminate\Support\Facades\DB;
use App\Mail\TemporaryPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class passwordController extends Controller
{
    //public function password()
    public function recover()
    {

        return view('HR.password');
    }
    public function recoverPassword(Request $request)
    {
        $request->validate([
            'upn_no' => 'required|string'
        ]);
    
        $hr = HR::where('upn_no', $request->upn_no)->first();
    
        if (!$hr) {
            return redirect()->route('HR')
            ->with('status', 'No account found with this UPN number') // Changed to 'status'
            ->with('alert-type', 'danger');
        }
    
        // Generate random password
        $randomPassword = Str::random(8);
        
        // Update password and set flag to prevent user changes
        $hr->update([
            'password' => Hash::make($randomPassword),
            'password_change_allowed' => false,
            'password_changed_at' => now()
        ]);
    
        // Send email
        Mail::to($hr->email)->send(new PasswordRecoveryMail($randomPassword));
    
        return redirect()->route('HR')
        ->with('status', 'An email has been sent to you with your password') // Changed to 'status'
        ->with('alert-type', 'success'); 
    }
    public function passwordmail(Request $request)
    {
        // Validate the email input
        $validatedData = $request->validate([
            'email' => 'required|email', 
            'status' => 'required',
            'created_at'=>'required',// Basic email validation (we'll manually check if it exists)
        ]);
    
        $email = $request->email;
        
    
        // Check if the email exists in the 'staff' table
        $staff = DB::table('staff')->where('email', $email)->first();
    
        // If the email exists, proceed with password reset
        if ($staff) {
            $password = new Password();
            $password->fill($validatedData);
            $password->save();
            
    
            // Redirect back with a success message
            return redirect()->route('staff')->with('status', 'You will receive an email for the password reset.');
        } else {
            // If email does not exist, redirect back with an error message
            return back()->withErrors(['email' => 'This account does not exist.']);
        }
        
    }
     public function hrpupassword()
    {

        return view('HRPU.Password');
    }
    public function hrpuTempPassword(Request $request)
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
