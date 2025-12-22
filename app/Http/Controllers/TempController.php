<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminTemporaryPasswordMail;
use Illuminate\Support\Facades\Validator;

class TempController extends Controller
{
    //
    public function adminpassword()
    {
        return view('Admin.Password'); // Assuming 'Admin.login' is the name of your login page view
    }
    public function sendTemporaryPasswordadmin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $admin = Admin::where('email', $request->email)->first();

    if (!$admin) {
        return redirect()->back()->withErrors([
            'email' => 'The email address is invalid. Kindly contact support.'
        ]);
    }

    $tempPassword = Str::random(8);
    $expiryTime = Carbon::now()->addMinutes(30);
    $resetToken = Str::random(60);

    // Update admin record
    $admin->update([
        'temp_password' => Hash::make($tempPassword),
        'temp_password_expiry' => $expiryTime,
        'password' => Hash::make($tempPassword),
        'reset_token' => $resetToken,
    ]);

    // Email admin
    Mail::to($admin->email)->send(new AdminTemporaryPasswordMail($admin, $tempPassword, $resetToken));

    return redirect()->back()
        ->with('success', 'A temporary password has been sent to your admin email.');
}
public function showSetPasswordFormadmin($token)
{
    $admin = Admin::where('reset_token', $token)
                ->where('temp_password_expiry', '>', Carbon::now())
                ->first();

    if (!$admin) {
        return redirect()->route('admin')
            ->withErrors(['token' => 'This password reset link is invalid or expired.']);
    }

    return view('Admin.Auth.set-password', compact('admin', 'token'));
}
public function setNewPasswordadmin(Request $request)
{
    $validator = Validator::make($request->all(), [
        'reset_token' => 'required',
        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/[A-Z]/',
            'regex:/[a-z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&#]/',
        ],
    ]);

    if ($validator->fails()) {
        return back()->withErrors([
            'password' => 'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.'
        ])->withInput();
    }

    $admin = Admin::where('reset_token', $request->reset_token)
        ->where('temp_password_expiry', '>', now())
        ->first();

    if (!$admin) {
        return redirect()->route('admin')
            ->withErrors(['token' => 'This password reset link is invalid or expired.']);
    }

    $admin->password = Hash::make($request->password);
    $admin->temp_password = null;
    $admin->temp_password_expiry = null;
    $admin->reset_token = null;
    $admin->save();

    return redirect()->route('admin')
        ->with('success', 'Your admin password has been updated successfully. Please log in.');
}
}
