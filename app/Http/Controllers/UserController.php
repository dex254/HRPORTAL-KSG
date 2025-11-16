<?php

namespace App\Http\Controllers;

use App\Models\Invent;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //

  public function updateEmail(Request $request, $id)
{
    $admin = Auth::guard('admin')->user();

    if (!$admin) {
        return redirect()->route('admin')->with('error', 'Please log in first.');
    }

    if (!in_array($admin->role, ['dex', 'admin', 'sadmin'])) {
        return redirect()->back()->with('error', 'You are not authorized to perform this action.');
    }

    $request->validate([
        'email' => 'required|email|unique:invents,email,' . $id,
    ]);

    $invent = Invent::findOrFail($id);

    // New email
    $newEmail = $request->email;

    // Update email
    $invent->email = $newEmail;
    $invent->save();

    // Send WelcomeMail to new email
    Mail::to($newEmail)->send(new WelcomeMail($invent));

    return redirect()->back()->with('success', 'Email updated successfully and notification sent.');
}




   public function updateStatus(Request $request, $id)
{
    $admin = Auth::guard('admin')->user();

    if (!$admin) {
        return redirect()->route('admin')->with('error', 'Please log in first.');
    }

    if (!in_array($admin->role, ['dex', 'admin', 'sadmin'])) {
        return redirect()->back()->with('error', 'You are not authorized to change status.');
    }

    $request->validate([
        'status' => 'required|in:Active,Inactive',
    ]);

    $invent = Invent::findOrFail($id);

    // Update status
    $invent->status = $request->status;
    $invent->save();

    // Send email using existing email
    Mail::to($invent->email)->send(new WelcomeMail($invent));

    return redirect()->back()->with('success', 'Status updated successfully and the user was notified.');
}

}
