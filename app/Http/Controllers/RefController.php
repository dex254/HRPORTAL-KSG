<?php

namespace App\Http\Controllers;

use App\Models\Referees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefController extends Controller
{
    //
     public function referees()
    {
        $upn_no = Auth::guard('EXT')->user()->upn_no;

        // Fetch experience records where `upn_no` matches the logged-in user
       $referees = Referees::where('upn_no', $upn_no)
    ->orderBy('created_at', 'desc')
    ->get();

        return view('EXT.Ref.User', compact('referees'));
    }

    // Store experience data
    public function saveref(Request $request)
    {
        // Validate input
        $request->validate([
            'upn_no' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'name' => 'required|string',
            'employer' => 'required|string',
            'job_title' => 'required|string',
            'refname' => 'required|string',
            'refphone' => 'required|string',
            
            'refemail' => 'required|string',
            'Position' => 'nullable|string',
            
            
        ]);

        Referees::create($request->all());

        return redirect()->back()->with('success', 'Referee added successfully!');
    }
    public function refdestroy($id)
    {
        $referees = Referees::findOrFail($id);

        // Delete the certificate file if it exists
      
        // Delete record
        $referees->delete();

        return redirect()->back()->with('success', 'record deleted successfully.');
    }
}
