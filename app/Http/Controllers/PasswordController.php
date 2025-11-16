<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Invent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\TemporaryPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminTemporaryPasswordMail;

class PasswordController extends Controller
{
    //
    public function sendTemporaryPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $invent = Invent::where('email', $request->email)->first();

        if (!$invent) {
            return redirect()->back()->withErrors([
                'email' => 'The email address is invalid. Kindly contact support.'
            ]);
        }

        $tempPassword = Str::random(8);
        $expiryTime = Carbon::now()->addMinutes(30);
        $resetToken = Str::random(60);

        // Update invent record
        $invent->update([
            'temp_password' => Hash::make($tempPassword),
            'temp_password_expiry' => $expiryTime,
            'password' => Hash::make($tempPassword),
            'reset_token' => $resetToken,
        ]);

        // Send email
        Mail::to($invent->email)->send(new TemporaryPasswordMail($invent, $tempPassword, $resetToken));

        return redirect()->back()->with('success', 'A temporary password has been sent to your email.');
    }

    // Show set new password form
    public function showSetPasswordForm($token)
    {
        $invent = Invent::where('reset_token', $token)
                    ->where('temp_password_expiry', '>', Carbon::now())
                    ->first();

        if (!$invent) {
            return redirect()->route('invent')
                ->withErrors(['token' => 'This password reset link is invalid or expired.']);
        }

        return view('Invent.Auth.set-password', compact('invent', 'token'));
    }

    // Update new password
    public function setNewPassword(Request $request)
    {
        $request->validate([
            'reset_token' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',      // Uppercase
                'regex:/[a-z]/',      // Lowercase
                'regex:/[0-9]/',      // Number
                'regex:/[@$!%*?&#]/', // Symbol
            ],
        ]);

        $invent = Invent::where('reset_token', $request->reset_token)
                    ->where('temp_password_expiry', '>', Carbon::now())
                    ->first();

        if (!$invent) {
            return redirect()->route('invent')
                ->withErrors(['token' => 'This password reset link is invalid or expired.']);
        }

        $invent->password = Hash::make($request->password);
        $invent->temp_password = null;
        $invent->temp_password_expiry = null;
        $invent->reset_token = null;
        $invent->save();

        return redirect()->route('invent')
            ->with('success', 'Your password has been updated successfully. You can now log in.');
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
    $request->validate([
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

    $admin = Admin::where('reset_token', $request->reset_token)
                ->where('temp_password_expiry', '>', Carbon::now())
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
