<?php

namespace App\Http\Controllers;

use App\Models\Teaching;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeachingController extends Controller
{
    //
     public function teachingExperince()
    {
        $upn_no = Auth::guard('HRPU')->user()->upn_no;

        // Fetch experience records where `upn_no` matches the logged-in user
        $teachings = Teaching::where('upn_no', $upn_no)->get();

        return view('Experience.Teaching', compact('teachings'));
    }

    // Store experience data
    public function teachingExperincepost(Request $request)
    {
        // Validate input
        $request->validate([
             'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'upn_no' => 'required|string',
        'Teachingareas' => 'required|string',
        'employer' => 'required|string|max:255',
        'job_title' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'stdate' => 'required|date',
        'enddate' => 'required|date',
        'location' => 'required|string|max:255',
        'duties' => 'nullable|string',
        'expartise' => 'nullable|string',
        'recommendation_document' => 'required|file|mimes:jpg,jpeg,png,gif,zip,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,rtf|max:10240' // Max 20MB
    ]);

    // Handle file upload
   
    $teachingPath = null;

if ($request->hasFile('recommendation_document')) {
    $file = $request->file('recommendation_document');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads/Teaching'), $filename);

    // Save the relative file path
    $teachingPath = 'uploads/Teaching/' . $filename;
   

    // Save to database
    Teaching::create([
        'upn_no' =>$request->upn_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
        'teaching_areas' => $request->Teachingareas,
        'employer' => $request->employer,
        'job_title' => $request->job_title,
        'country' => $request->country,
        'stdate' => $request->stdate,
        'enddate' => $request->enddate,
        'location' => $request->location,
        'duties' => $request->duties,
        'achievements' => $request->expartise,
        'teaching_path' => $teachingPath,
    ]);

    return back()->with('success', 'Teaching experience saved successfully.');
}
  return redirect()->back()->with('error', 'Failed to upload document.');
    }
    
    public function teachingepdestroyext($id)
    {
        $teachings = Teaching::findOrFail($id);

        // Delete the certificate file if it exists
      
        // Delete record
        $teachings->delete();

        return redirect()->back()->with('success', 'Experince record deleted successfully.');
    }
}
