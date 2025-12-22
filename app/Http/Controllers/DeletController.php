<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeletController extends Controller
{
    //
    public function delete($id)
    {
        // Get the currently authenticated admin
        $admin = Auth::guard('admin')->user();
    
        // Define the roles that are allowed to delete
        $allowedRoles = ['Admin', 'dex'];
    
        // Check if the admin is authenticated and has the required role
        if (!$admin || !in_array($admin->role, $allowedRoles)) {
            // If not authorized, redirect to the dashboard with an error message
            return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to delete any user.');
        }
    
        // Find the admin record by its ID
        $adminToDelete = Admin::find($id);
    
        // Check if the admin record exists
        if (!$adminToDelete) {
            return back()->with('error', 'Admin data not found.');
        }
    
        // Attempt to delete the admin record
        try {
            $adminToDelete->delete();
            return back()->with('success', 'Admin data deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error in deleting admin data. Try again later.');
        }
    }
    
}
