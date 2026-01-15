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
    // Find the experience record
    $experience = Experience::findOrFail($id);

    // Calculate the years of this experience
    $start = Carbon::parse($experience->stdate);
    $end   = Carbon::parse($experience->enddate);

    $months = $start->diffInMonths($end);
    $years = round($months / 12, 2);

    // Subtract years from total in years_of_experence table
    $totalExperience = YearsOfExperence::where('upn_no', $experience->upn_no)->first();

    if ($totalExperience) {
        $totalExperience->years -= $years;

        // Ensure it doesn't go below 0
        if ($totalExperience->years < 0) {
            $totalExperience->years = 0;
        }

        $totalExperience->save();
    }

    // Delete the experience record
    $experience->delete();

    return redirect()->back()->with('success', 'Experience record deleted successfully and total years updated.');
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
    // 1️⃣ Fetch the experience record to delete
    $experience = Experience::findOrFail($id);

    // 2️⃣ Calculate the duration of this experience in years
    $start = Carbon::parse($experience->stdate);
    $end   = Carbon::parse($experience->enddate);

    $months = $start->diffInMonths($end);
    $years = round($months / 12, 2);

    // 3️⃣ Update the user's total experience in years_of_experence table
    $totalExperience = YearsOfExperence::where('upn_no', $experience->upn_no)->first();

    if ($totalExperience) {
        // Subtract the years of the deleted experience
        $totalExperience->years -= $years;

        // Make sure total years don't go below 0
        $totalExperience->years = max(0, $totalExperience->years);

        $totalExperience->save();
    }

    // 4️⃣ Delete the experience record
    $experience->delete();

    // 5️⃣ Redirect back with success message
    return redirect()->back()->with('success', 'Experience record deleted and total years updated successfully.');
}

}
