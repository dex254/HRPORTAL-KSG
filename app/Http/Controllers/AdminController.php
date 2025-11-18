<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Invent;
use App\Mail\AdminOtpMail;
use App\Models\Innovation;
use App\Models\Nomination;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\AdminWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //

      public function adminlogin()
    {
        return view('Admin.Login'); // Assuming 'Admin.login' is the name of your login page view
    }
      public function adminsignup()
    {
         $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin')->with('error', 'Please log in first.');
        }
        return view('Admin.Register', compact('admin')); // Assuming 'Admin.login' is the name of your login page view
    }
    public function admincreate(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admin,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'status'   => 'nullable',
            'role'     => 'required|string',
            'dash'     => 'required|string',
             'created_by'     => 'required|string'
        ]);

        // Generate unique digital signature
        $digitalSignature = strtoupper(Str::random(10));

        // Ensure uniqueness
        while (Admin::where('digitalsignature', $digitalSignature)->exists()) {
            $digitalSignature = strtoupper(Str::random(10));
        }

        // Create admin
        $admin = Admin::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'password'         => Hash::make($request->password),
            'status'           => $request->status ? 1 : 0,
            'role'             => $request->role,
            'dash'             => $request->dash,
            'created_by'             => $request->created_by,
            'digitalsignature' => $digitalSignature,
        ]);


        Mail::to($admin->email)->send(new AdminWelcomeMail($admin, $request->password));
        // Send email to user
        

        return redirect()->back()->with('success', 'Admin account created successfully and email sent.');
    }
     public function adminpassword()
    {
        return view('Admin.Password'); // Assuming 'Admin.login' is the name of your login page view
    }
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin,email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
        }

        // Generate 6-digit OTP
        $otp = random_int(100000, 999999);

        $admin->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP email
        Mail::to($admin->email)->send(new AdminOtpMail($admin, $otp));

        return redirect()->route('Admin.otp', ['email' => $admin->email])
            ->with('success', 'An OTP has been sent to your email. Please verify.');
    }

    // Show OTP form
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
            'login_time' => now(),
            'last_login_ip' => $request->ip(),
            'is_online' => true,
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('Admin.Dashboard')->with('success', 'Welcome back!');
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
            'login_time' => now(),
            'last_login_ip' => $request->ip(),
            'is_online' => true,
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('Admin.Dashboard')->with('success', 'Welcome back!');
    }

    // ============================
    // ADMIN DASHBOARD
    // ============================
    public function Dashboard()
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin')->with('error', 'Please log in first.');
        }
         $ctdrtCount = Nomination::count();       // Catch Them Doing the Right Thing
        $innovationCount = Innovation::count();  // Innovations
        $adminCount = Admin::count();
        $inventorCount = Invent::count();
        $admins = Admin::orderBy('created_at', 'desc')->get();

        return view('Admin.Dashboard', compact('admin','admins','ctdrtCount',
            'innovationCount',
            'adminCount',
            'inventorCount'));
    }
    public function update(Request $request)
{
    $admin = Admin::findOrFail($request->id);

    $admin->update([
        'email' => $request->email,
        'status' => $request->status,
        'role' => $request->role,
        'dash' => $request->dash,
    ]);

    // Optionally send email with new info
    Mail::to($admin->email)->send(new AdminWelcomeMail($admin, 'Your password remains unchanged'));

    return response()->json(['message' => 'Admin updated successfully']);
}

//profile update 

    
}
