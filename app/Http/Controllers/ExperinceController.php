<?php

namespace App\Http\Controllers;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\YearsOfExperence;
use Illuminate\Support\Facades\Auth;

class ExperinceController extends Controller
{
    //
    public function Experince()
    {
        $upn_no = Auth::guard('HR')->user()->upn_no;

        // Fetch experience records where `upn_no` matches the logged-in user
        $experiences = Experience::where('upn_no', $upn_no)->get();

        return view('Experience.data', compact('experiences'));
    }

    // Store experience data
    public function Experincepost(Request $request)
    {
        // Validate input
         $validated = $request->validate([
        'upn_no'     => 'required|string',
        'email'      => 'required|email',
        'phone'      => 'required|string',
        'name'       => 'required|string',
        'employer'   => 'required|string',
        'job_title'  => 'required|string',
        'country'    => 'required|string',
        'stdate'     => 'required|date',
        'enddate'    => 'required|date|after_or_equal:stdate',
        'location'   => 'required|string',
        'expartise'  => 'nullable|string',
        'duties'     => 'nullable|string',
    ]);

    // ✅ Save individual experience record
    Experience::create($validated);

    // ✅ Calculate years of experience
    $start = Carbon::parse($validated['stdate']);
    $end   = Carbon::parse($validated['enddate']);

    // Calculate difference in months
    $months = $start->diffInMonths($end);

    // Convert months to years (2 decimal places)
    $years = round($months / 12, 2);

    // ✅ Update or create total experience per UPN
    $totalExperience = YearsOfExperence::where('upn_no', $validated['upn_no'])->first();

    if ($totalExperience) {
        // Add to existing total
        $totalExperience->years += $years;
        $totalExperience->save();
    } else {
        // Create new total record
        YearsOfExperence::create([
            'upn_no' => $validated['upn_no'],
            'email'  => $validated['email'],
            'years'  => $years,
        ]);
    }

    return redirect()->back()->with('success', 'Experience added successfully!');
    }
    public function epdestroy($id)
    {
        $experiences = Experience::findOrFail($id);

        // Delete the certificate file if it exists
      
        // Delete record
        $experiences->delete();

        return redirect()->back()->with('success', 'Experince record deleted successfully.');
    }

    //

    public function Experinceext()
    {
        $upn_no = Auth::guard('HRPU')->user()->upn_no;

        // Fetch experience records where `upn_no` matches the logged-in user
       $experiences = Experience::where('upn_no', $upn_no)
    ->orderBy('enddate', 'desc')
    ->get();

        return view('Experience.Ext', compact('experiences'));
    }

    // Store experience data
    public function Experincepostext(Request $request)
    {
        // Validate input
        // Validate input
         $validated = $request->validate([
        'upn_no'     => 'required|string',
        'email'      => 'required|email',
        'phone'      => 'required|string',
        'name'       => 'required|string',
        'employer'   => 'required|string',
        'job_title'  => 'required|string',
        'country'    => 'required|string',
        'stdate'     => 'required|date',
        'enddate'    => 'required|date|after_or_equal:stdate',
        'location'   => 'required|string',
        'expartise'  => 'nullable|string',
        'duties'     => 'nullable|string',
    ]);

    // ✅ Save individual experience record
    Experience::create($validated);

    // ✅ Calculate years of experience
    $start = Carbon::parse($validated['stdate']);
    $end   = Carbon::parse($validated['enddate']);

    // Calculate difference in months
    $months = $start->diffInMonths($end);

    // Convert months to years (2 decimal places)
    $years = round($months / 12, 2);

    // ✅ Update or create total experience per UPN
    $totalExperience = YearsOfExperence::where('upn_no', $validated['upn_no'])->first();

    if ($totalExperience) {
        // Add to existing total
        $totalExperience->years += $years;
        $totalExperience->save();
    } else {
        // Create new total record
        YearsOfExperence::create([
            'upn_no' => $validated['upn_no'],
            'email'  => $validated['email'],
            'years'  => $years,
        ]);
    }

    return redirect()->back()->with('success', 'Experience added successfully!');
    }
    public function epdestroyext($id)
    {
        $experiences = Experience::findOrFail($id);

        // Delete the certificate file if it exists
      
        // Delete record
        $experiences->delete();

        return redirect()->back()->with('success', 'Experince record deleted successfully.');
    }
}
