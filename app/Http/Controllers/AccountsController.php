<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    //
    public function adminuser($id)
{
    $loggedInAdmin = Auth::guard('admin')->user();

    // Define the allowed roles for users who can view all campuses
    $allowedRolesForAllCampuses = ['Admin', 'Dex','Super Admin'];
    $allowedRolesForSameCampus = ['AdminAssistant']; // Admin Assistants will only see admins from the same campus

    // Check if the user has one of the allowed roles
    if ($loggedInAdmin && in_array($loggedInAdmin->role, $allowedRolesForAllCampuses)) {
        // If the logged-in user is Admin or dex, show the admin by ID
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->route('admin.accounts')->with('error', 'Admin user not found.');
        }
    } elseif ($loggedInAdmin && in_array($loggedInAdmin->role, $allowedRolesForSameCampus)) {
        // If the logged-in user is an Admin Assistant, filter admins by campus
        $admin = Admin::where('id', $id)
                      ->where('campus', $loggedInAdmin->campus)
                      ->first();
        if (!$admin) {
            return redirect()->route('admin.accounts')->with('error', 'You are not authorized to access this admin user or the user does not exist.');
        }
    } else {
        // Redirect if the user is not authorized
        return redirect()->back()->with('error', 'You are not authorized to access this page.');
    }

    // Return the view with the admin user
    return view('admin.accounts', compact('admin'));
}
    

public function updateadmin(Request $request, $id)
{
    // Fetch the admin record by ID
    $admin = Admin::findOrFail($id);

    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|unique:admin,name,' . $admin->id, // Ensure name is unique except for the current admin
        'idnumber' => 'required|string|unique:admin,idnumber,' . $admin->id, // Ensure idnumber is unique except for the current admin
        'phone' => 'required|string|unique:admin,phone,' . $admin->id, // Ensure phone is unique except for the current admin
        'email' => 'required|email|unique:admin,email,' . $admin->id, // Ensure email is unique except for the current admin
        'role' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        'campus' => 'nullable|string',
        'password' => 'nullable|string|min:8', // Make password optional
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($admin->image && file_exists(public_path('images/admins/' . $admin->image))) {
            unlink(public_path('images/admins/' . $admin->image));
        }

        // Upload the new image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/admins'), $imageName);
        $validatedData['image'] = $imageName;
    }

    // Update the admin record
    foreach ($validatedData as $key => $value) {
        if ($key === 'password' && !empty($value)) {
            // Hash the password if it's provided
            $admin->password = Hash::make($value);
        } elseif ($key !== 'password') {
            // Update other fields
            $admin->$key = $value;
        }
    }

    // Save the updated admin record
    $admin->save();

    // Redirect back with a success message
    return redirect()->back()
        ->with('success', 'You have successfully updated the admin details.');
}
}
