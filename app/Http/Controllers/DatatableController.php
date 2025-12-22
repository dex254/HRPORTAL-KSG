<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Staff;
use App\Models\Participants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatatableController extends Controller
{
    //staff record
    public function staffall(Request $request)

    {
        $staff = $request->staff;
        $admin = Auth::guard('admin')->user();
        
         // Use guard for admin
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin'];
        
        $staff = Staff::all();

        // Example of getting a specific staff's password or other data
        
        // Check if the user has one of the allowed roles
        if ($admin && in_array($admin->role, $allowedRoles)) {
            return view('Datatable.staff', compact('staff','admin'));
        }
        
        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.'); // Redirect with error message
       
   

    }
   
    public function adminall(Request $request)

    {
        $admin = Auth::guard('admin')->user();
    
        // Define the allowed roles for users who can view all campuses
        $allowedRolesForAllCampuses = ['Admin', 'Dex','Super Admin'];
        $allowedRolesForSameCampus = ['AdminAssistant']; // Admin Assistants will only see admins from the same campus
    
        // Check if the user has one of the allowed roles
        if ($admin && in_array($admin->role, $allowedRolesForAllCampuses)) {
            // If the logged-in user is Admin or Developer, show all admins
            $admin = Admin::all();  
        } elseif ($admin && in_array($admin->role, $allowedRolesForSameCampus)) {
            // If the logged-in user is an Admin Assistant, filter admins by campus
            $admin = Admin::where('campus', $admin->campus)->get();  
        } else {
            // Redirect if the user is not authorized
            return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
        }
    
        // Return the view with the list of admins
        return view('Datatable.admin', compact('admin'));  
    }
    public function Participants(Request $request)
{
    $admin = Auth::guard('admin')->user();
    
    // Define allowed roles
    $allowedRoles = ['Admin', 'AdminAssistant', 'dex', 'Admissions'];
    
    // Fetch all participants from the participants table
    $participants = Participants::all();

    // Check if the user has one of the allowed roles
    if ($admin && in_array($admin->role, $allowedRoles)) {
        return view('Participant.onprograms', compact('participants', 'admin'));
    }
    
    return redirect()->route('Admissions.dashboard')->with('error', 'You are not authorized to access this page.');
}

}
