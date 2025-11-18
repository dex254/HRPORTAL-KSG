<?php

namespace App\Http\Controllers;

use App\Models\Invent;
use App\Mail\WelcomeMail;
use App\Models\Innovation;
use App\Mail\InventOtpMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class InventController extends Controller
{
    //
     public function Inventlogin()
    {
        return view('Invent.Login'); // Assuming 'Admin.login' is the name of your login page view
    }
      public function Inventsignup()
    {
        return view('Invent.Register'); // Assuming 'Admin.login' is the name of your login page view
    }
     public function password()
    {
        return view('Invent.Password'); // Assuming 'Admin.login' is the name of your login page view
    }
 public function Inventregister(Request $request)
    {
        // 1️⃣ Validate request
        $request->validate([
            'email' => 'required|email|unique:invent,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min' => 'Password must be at least 8 characters.',
        ]);

        // 2️⃣ Prevent duplicate emails (optional but safer)
        $existingInvent = Invent::where('email', $request->email)->lockForUpdate()->first();
        if ($existingInvent) {
            return back()->withErrors(['email' => 'This email is already registered.'])->withInput();
        }

        // 3️⃣ Create the user
        $securityKey = strtoupper(Str::random(16));

        $invent = Invent::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'securitykey' => $securityKey,
            'status' => 'Active',
        ]);

        // 4️⃣ Send email (if it fails, it will throw a normal exception)
        Mail::to($invent->email)->send(new WelcomeMail($invent));

        // 5️⃣ Redirect with success message
        return redirect()->route('invent')->with('success', 'Registration successful! A confirmation email has been sent to your inbox.');
    }
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email|exists:invent,email',
            'password' => 'required',
        ]);

        $invent = Invent::where('email', $request->email)->first();

        // Check password
        if (!$invent || !Hash::check($request->password, $invent->password)) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
        }

        //Generate unique 6-digit OTP
        $otp = random_int(100000, 999999);

        //  Save OTP and expiry (valid for 10 minutes)
        $invent->otp = $otp;
        $invent->otp_expires_at = now()->addMinutes(10);
        $invent->save();

        // Send OTP email
        Mail::to($invent->email)->send(new InventOtpMail($invent, $otp));

        // ✅ Redirect to OTP verification page
        return redirect()->route('Invent.otp', ['email' => $invent->email])
            ->with('success', 'An OTP has been sent to your email. Please verify.');
    }
    public function verifyOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:invent,email',
        'otp' => 'required|digits:6',
    ], [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.exists' => 'The selected email is invalid.',
        'otp.required' => 'OTP code is required.',
        'otp.digits' => 'The OTP field must be exactly 6 digits.',
    ]);

    $invent = Invent::where('email', $request->email)->first();

    if (!$invent || $invent->otp !== $request->otp) {
        return back()->withErrors(['otp' => 'Invalid OTP.'])->withInput();
    }

    if (now()->greaterThan($invent->otp_expires_at)) {
        return back()->withErrors(['otp' => 'OTP expired. Please login again.'])->withInput();
    }

    // Clear OTP after successful verification
    $invent->update([
        'otp' => null,
        'otp_expires_at' => null,
        'login_time' => now(), // Set current login time
        'last_login_ip' => $request->ip(), // Capture IP address
        'is_online' => true, // Set user online
    ]);

    // Log the user in
    Auth::guard('invent')->login($invent);

    return redirect()->route('Invent.Dashboard')->with('success', 'Welcome back!');
}

public function quickVerifyOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:invent,email',
        'otp' => 'required|digits:6',
    ], [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.exists' => 'The selected email is invalid.',
        'otp.required' => 'OTP code is required.',
        'otp.digits' => 'The OTP field must be exactly 6 digits.',
    ]);

    $invent = Invent::where('email', $request->email)->first();

    if (!$invent || $invent->otp !== $request->otp) {
        return redirect()->route('invent')
            ->with('error', 'Invalid verification link.');
    }

    if (now()->greaterThan($invent->otp_expires_at)) {
        return redirect()->route('invent')
            ->with('error', 'Verification link expired. Please login again.');
    }

    // ✅ Clear OTP
    $invent->update([
        'otp' => null,
        'otp_expires_at' => null,
        'login_time' => now(), // Set current login time
        'last_login_ip' => $request->ip(), // Capture IP address
        'is_online' => true, // Set user online
    ]);

    // ✅ Log the user in
    Auth::guard('invent')->login($invent);

    // ✅ Redirect to dashboard
    return redirect()->route('Invent.Dashboard')->with('success', 'Welcome back!');
}

public function Dashboard(Request $request)
    {
        // ✅ Ensure the agent is authenticated
        $invent = Auth::guard('invent')->user();

        if (!$invent) {
            return redirect()->route('invent')->with('error', 'Please log in first.');
        }
          $invents = Invent::orderBy('created_at', 'desc')->get();
            $innovationCount = Innovation::where('securitykey', $invent->securitykey)->count();

        // ✅ Pass authenticated agent to the dashboard view
        return view('Invent.Dashboard', compact('invent','invents','innovationCount'));
    }
    public function showOtp(Request $request)
{
    $email = $request->query('email'); // get email from query string
    return view('Invent.otp', compact('email'));
}

public function resendOtp(Request $request)
{
    $email = $request->query('email');

    // ✅ Find the user
    $invent = Invent::where('email', $email)->first();
    if (!$invent) {
        return redirect()->route('invent')->with('error', 'Email not found.');
    }

    // ✅ Generate new OTP
    $otp = random_int(100000, 999999);

    // ✅ Save OTP & expiry (10 minutes)
    $invent->update([
        'otp' => $otp,
        'otp_expires_at' => now()->addMinutes(10),
    ]);

    // ✅ Send OTP email
    Mail::to($invent->email)->send(new InventOtpMail($invent, $otp));

    return redirect()->route('Invent.otp', ['email' => $email])
        ->with('success', 'A new OTP has been sent to your email.');
}

public function verifyLink(Request $request)
    {
        // Get the email from query string
        $email = $request->query('email');

        // Return the 'invent.verify' view with the email
        return view('Invent.verify', compact('email'));
    }
    

}
