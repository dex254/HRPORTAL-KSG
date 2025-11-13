<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateProfile(Request $request)
{
    // Get the logged-in user
    $user = Auth::guard('invent')->user();

    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Check securitykey for extra verification (optional)
    $securityKey = $request->input('securitykey');
    if ($securityKey !== $user->securitykey) {
        return redirect()->back()->with('error', 'Security verification failed.');
    }

    // Handle profile image upload
    if ($request->hasFile('profile')) {
        $profileImage = $request->file('profile');
        $filename = time().'_'.$profileImage->getClientOriginalName();
        $profileImage->move(public_path('Profile'), $filename);
        $user->profile = 'Profile/'.$filename;
    }

    // Update user info (name, phone) while keeping securitykey
    $user->update([
        'name' => $request->name,
        'phone' => $request->phone,
        // securitykey stays the same
        'updated_at' => Carbon::now(),
    ]);

    return redirect()->back()->with('success', 'Profile updated successfully.');
}
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => [
            'required',
            'confirmed',
            'min:8',
            'regex:/[A-Z]/',
            'regex:/[a-z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&#]/',
        ],
        'securitykey' => 'required|string',
    ], [
        'new_password.regex' => 'Password must include uppercase, lowercase, number, and special character.',
    ]);

    // ✅ Get logged-in user
    $user = Auth::guard('invent')->user();

    // ✅ Check security key
    if ($request->securitykey !== $user->securitykey) {
        return redirect()->back()->with('error', 'Security verification failed. Invalid security key.');
    }

    // ✅ Check current password
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error', 'Current password is incorrect.');
    }

    // ✅ Update password, mark offline, log time
    $user->update([
        'password' => Hash::make($request->new_password),
        'is_online' => false,
        'logout_time' => now(),
    ]);

    // ✅ Logout user
    Auth::guard('invent')->logout();

    return redirect()->route('invent')
        ->with('success', 'Password updated successfully. Please log in again.');
}
}
