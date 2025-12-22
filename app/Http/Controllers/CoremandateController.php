<?php

namespace App\Http\Controllers;

use App\Models\Coremandate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CoremandateController extends Controller
{
    //
    public function specialpost(Request $request)
    {
        // Validate the request data
        $request->validate([
            'upn_no' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'name' => 'required|string',
            'job_group' => 'nullable|string',
            'comandate' => 'nullable|string',
            'selected_count' => 'nullable|string',
        ]);

        // Get the authenticated user
        $user = Auth::guard('HR')->user();

        // Save the data to the database
        $data = Coremandate::create([
            'upn_no' => $request->upn_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'job_group' => $request->job_group,
            'comandate' => $request->comandate,
            'selected_count' => $request->selected_count,
            'date' => Carbon::now(), // Current date and time
            'status' => 'Active', // Set status as Active
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Your  core mandate  has  been uploaded successfully!');
    }
    public function coredestroy($id)
{
    // Find the coremandate entry by ID
    $coremandate = Coremandate::find($id);

    if ($coremandate) {
        // Delete the coremandate entry from the database
        $coremandate->delete();

        // Redirect with a success message
        return redirect()->back()->with('success', 'The core mandate entry has been deleted successfully!');
    }

    // If the coremandate entry is not found, redirect with an error message
    return redirect()->back()->with('error', 'Core mandate entry not found.');
}
}
