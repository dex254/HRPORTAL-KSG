<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Other;
use App\Models\JOBExt;
use App\Models\Academic;
use App\Models\Teaching;
use App\Models\Experience;
use App\Models\Application;
use Illuminate\Support\Str;
use App\Models\Proffecional;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Profecionalbody;
use App\Mail\JobApplicationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobsextController extends Controller
{
    //

    public function createjobext()
    {
        
        $admin = Auth::guard('admin')->user(); // Use guard for admin
        $allowedRoles = ['Admin', 'AdminAssistant','dex'];

       
        if ($admin && (in_array($admin->role, $allowedRoles) || $admin->role === 'dex')){
            return view('JOB.Extcreate', ['admin' => $admin]); // Pass the admin to the view
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.'); 
    }  
    public function createjobdataext(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant', 'dex'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $validatedData = $request->validate([
                'area' => 'required|string|max:255',
               
                'Specialization' => 'required|string',
                'level' => 'required|string',
                'Proposed_No_of_Positions'=> 'required|string',
                'AE' => 'required|string|max:255',
                'IP' => 'required|string|max:255',
                'Var' => 'required|string|max:255',
                 'Ref_NO' => 'required|string|max:255',
                 'datefrom' => 'required|date',
                'deadline' => 'required|date',
            ]); 
            $deadline = Carbon::parse($validatedData['deadline']);
        $currentDate = Carbon::now();
        
        // Set status based on deadline
        $validatedData['status'] = $deadline->lt($currentDate) ? 'Closed' : 'Open';

        JOBExt::create($validatedData);

            return redirect()->route('JOB.Extlisted')->with('status', 'Job created successfully!');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // List all advertised jobs
    public function listedjobext()
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant', 'dex'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $jobexts = JOBExt::orderBy('datefrom', 'desc')->get();
            return view('JOB.Extlisted', compact('jobexts', 'admin'));
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // Show job details
    public function detailsjobext($id)
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant', 'dex'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $jobexts = JOBExt::where('id', $id)->firstOrFail();
            return view('JOB.Ext.Detail', compact('jobexts', 'admin'));
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }


    // Show the form to update a job
   

    // Process job update
   public function updatejobdataext(Request $request, $id)
{
    $admin = Auth::guard('admin')->user();
    $allowedRoles = ['Admin', 'AdminAssistant', 'dex'];

    if ($admin && in_array($admin->role, $allowedRoles)) {
        // Find the record by ID or fail
        $jobext = JOBExt::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validate([
            'area' => 'required|string|max:255',
            'Specialization' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'Proposed_No_of_Positions' => 'nullable|integer|min:0',
            'AE' => 'required|string|max:255',
            'IP' => 'required|string|max:255',
            'Var' => 'required|string|max:255',
            'Ref_NO' => 'required|string|max:255',
            'datefrom' => 'required|date',
            'deadline' => 'required|date',
            'status' => 'required|in:Open,Closed',
        ]);

        // Update the job record
        $jobext->update($validatedData);

        return redirect()->route('JOB.Extlisted')->with('status', 'Job updated successfully!');
    }

    // Unauthorized access fallback
    return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
}


public function applicationtsext()
 {
     // Get the authenticated HR user
     $hrpu = Auth::guard('HRPU')->user();
 
     // Ensure HR user exists
     if (!$hrpu) {
         abort(403, 'Unauthorized Access');
     }
 
     
    $now = Carbon::now(); // Current time now

    $jobexts = JOBExt::where('status', 'Open')
        ->where('deadline', '>=', $now->startOfDay()) // deadline must be today or future
        ->get(); 
     // Pass the HR user's job group and job group hierarchy to the view
     return view('JOB.applicantsext', compact('hrpu', 'jobexts'));
 }

  public function externalapply($id)
    {
       $jobexts = JOBExt::findOrFail($id);
    
        return view('JOB.Applyext', compact('jobexts'));
    }
    
   public function jobApplyext(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'Ref_No' => 'required|string',
            'upn_no' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'idnumber' => 'required|string',
            'Expected' => 'nullable|string',
            'job_group' => 'required|string',
            'designation' => 'required|string',
            'name' => 'required|string',
            'cv' => 'required|file|mimes:pdf|max:2048', // CV must be PDF and max 2MB
            'cover_letter' => 'nullable', // Cover letter must be PDF and max 2MB
        ]);

        // Check if the user has already applied for this position
        $existingApplication = Application::where('Ref_No', $validated['Ref_No'])
            ->where('upn_no', $validated['upn_no'])
            ->where('status', 'Applied')
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this position.');
        }

        // Fetch job details
        $jobext = JOBExt::findOrFail($id);

        // Define the upload path
         $uploadPath = public_path('uploads/Application');
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    // Upload CV
    $cvName = time() . '_cv.pdf';
    $cvFullPath = $request->file('cv')->move($uploadPath, $cvName);

    // Use same file as cover letter if not uploaded separately
    if ($request->hasFile('cover_letter')) {
        $coverLetterName = time() . '_cover_letter.pdf';
        $coverLetterFullPath = $request->file('cover_letter')->move($uploadPath, $coverLetterName);
    } else {
        $coverLetterName = time() . '_cover_letter.pdf';
        $coverLetterFullPath = $uploadPath . '/' . $coverLetterName;
        copy($uploadPath . '/' . $cvName, $coverLetterFullPath); // Copy CV as cover letter
    }

    chmod($coverLetterFullPath, 0644);

    // Generate the Bio PDF
    $bioPdfPath = $this->generateAndSaveBioReport($validated['upn_no'], $uploadPath);

        // Save the application to the database
        Application::create([
            'cv' => 'uploads/Application/' . $cvName,
            'cover_letter' => 'uploads/Application/' . $coverLetterName,
            'my_bio' => 'uploads/Application/' . basename($bioPdfPath),
            'Ref_No' => $validated['Ref_No'],
            'upn_no' => $validated['upn_no'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'idnumber' => $validated['idnumber'],
            'designation' => $validated['designation'],
            'name' => $validated['name'],
            'Expected' => $validated['Expected'],
            'job_group' => $validated['job_group'],
              'job_s_no' => $jobext->id,
            'status' => 'Applied',
            'datetime' => now(),
        ]);
        

        // Send email to the user
        Mail::to($validated['email'])
        ->cc('internalrecruitment2025@ksg.ac.ke')
        ->send(new JobApplicationMail($validated, $cvFullPath, $coverLetterFullPath, $bioPdfPath));

        return redirect()->route('HRPU.Myapplicants')->with('success', 'You have successfully applied for this job as ' . $validated['designation'] . '!');
    }

    private function generateAndSaveBioReport($upn_no, $uploadPath)
    {
        // Fetch data for the bio report
        $academics = Academic::where('upn_no', $upn_no)->get();

        // Fetch work experience records related to the user
        $experiences = Experience::where('upn_no', $upn_no)->get();
        
        
        $proffecional = Proffecional::all();
       $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
      $other= Other::where('upn_no', $upn_no)->get();
   $applications= Application::where('upn_no', $upn_no)->get();
    $teachings= Teaching::where('upn_no', $upn_no)->get();
        // Load the Blade template and render as HTML
        $html = view('pdf.user_apply_ext', compact('academics', 'experiences', 'proffecional','profecionalbodies','other','applications','teachings'))->render();

        // Generate PDF using mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Define file name and path
        $fileName = time() . '_my_bio.pdf';
        $filePath = $uploadPath . '/' . $fileName;

        // Save the PDF
        $mpdf->Output($filePath, 'F');

        return $filePath;
    }
    public function EXTMY()
    {
        // Get the logged-in HR user's UPN number
        $upn_no = Auth::guard('HRPU')->user()->upn_no;

        // Fetch all job applications for this user
        $applications = Application::where('upn_no', $upn_no)->get();

        return view('HRPU.Myapplications', compact('applications'));
    }
    public function Applicationdetailsext($id)
    {
        // Fetch application details
        $application = Application::where('id', $id)->firstOrFail();

        // Fetch job details associated with this application
        $jobext = JOBExt::where('id', $application->job_s_no)->firstOrFail();

        return view('HRPU.Applicationdetails', compact('application', 'jobext'));
    }
      public function abortApplicationext($id)
{
    // Find the application by Ref_No
    $application = Application::where('id', $id)->first();

    if (!$application) {
        return redirect()->route('HRPU.Myapplicants')->with('error', 'Application not found.');
    }

    // Delete CV file if it exists
    if ($application->cv && file_exists(public_path($application->cv))) {
        unlink(public_path($application->cv));
    }

    // Delete Cover Letter file if it exists
    if ($application->cover_letter && file_exists(public_path($application->cover_letter))) {
        unlink(public_path($application->cover_letter));
    }
    if ($application->my_bio && file_exists(public_path($application->my_bio))) {
        unlink(public_path($application->my_bio));
    }

    // Delete the application record
    $application->delete();

    // Redirect back with success message
    return redirect()->route('HRPU.Myapplicants')->with('success', 'Application deleted successfully. You can apply again.');
}

}
