<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;


class ProfilesController extends Controller
{
    public function saveProfile(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email', // Exclude current profile's email from uniqueness check
            'image' => 'nullable', // Optional image validation
        ]);

        // Check if a profile ID is provided to determine if we're updating or saving a new profile
        $profile = $request->has('profile_id') ? Profile::find($request->profile_id) : Profile::where('email', $request->email)->first();

        // If no profile is found by email and no ID is provided, create a new profile
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('profile'), $image);
        }
        // Update or save the profile data, including the image path
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->image = $image; // Store the image path in the database
        $profile->save(); // Save to the database

        // Return a success response with redirect to previous page or a new page
        return redirect()->back()->with('success', 'Profile ' . ($request->has('profile_id') ? 'updated' : 'saved') . ' successfully!');
    }
}
