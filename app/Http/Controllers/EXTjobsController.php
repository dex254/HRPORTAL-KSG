<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\EXT;
use App\Models\EXTJOB;
use App\Models\Licence;
use App\Models\Academic;
use App\Models\Referees;
use App\Models\Experience;
use Carbon\CarbonInterval;
use App\Models\Application;
use App\Models\Proffecional;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Profecionalbody;
use App\Mail\EXTJobApplicationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EXTjobsController extends Controller
{
    //
    public function extcreatejobext()
    {
        
        $admin = Auth::guard('admin')->user(); // Use guard for admin
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

       
        if ($admin && (in_array($admin->role, $allowedRoles) || $admin->role === 'Dex')){
            return view('EXT.Application.Admin', ['admin' => $admin]); // Pass the admin to the view
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.'); 
    }  
    public function extcreatejobdataext(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $validatedData = $request->validate([
                'Designation' => 'required|string|max:255',
                'Job_Group' => 'required|string',
                'level' => 'required|string',
                'Proposed_No_of_Positions' => 'required|string',
                'AE' => 'required|string|max:255',
                'IP' => 'required|string|max:255',
                'Var' => 'required|string|max:255',
                 'Ref_NO' => 'required|string|max:255',
                 'datefrom' => 'required|date',
                'deadline' => 'required|date',
                'qualifications' => 'required|string',
            ]); 
            $deadline = Carbon::parse($validatedData['deadline']);
        $currentDate = Carbon::now();
        
        // Set status based on deadline
        $validatedData['status'] = $deadline->lt($currentDate) ? 'Closed' : 'Open';

        EXTJOB::create($validatedData);

            return redirect()->route('EXT.Application.listed')->with('status', 'Job created successfully!');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }


    // List all advertised jobs
    public function extlistedjob()
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $extjobs = EXTJOB::orderBy('datefrom', 'desc')->get();
            return view('EXT.Application.listed', compact('extjobs', 'admin'));
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // Show job details
    public function extdetailsjobext($id)
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $extjobs = EXTJOB::where('id', $id)->firstOrFail();
            return view('EXT.Application.detail', compact('extjobs', 'admin'));
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // Show the form to update a job
   

    // Process job update
   public function extupdatejobdataext(Request $request, $id)
{
    $admin = Auth::guard('admin')->user();
    $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

    if ($admin && in_array($admin->role, $allowedRoles)) {
        // Find the record by ID or fail
        $extjobs = EXTJOB::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validate([
            'Designation' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'Proposed_No_of_Positions' => 'nullable|integer|min:0',
            'AE' => 'required|string|max:255',
            'IP' => 'required|string|max:255',
            'Var' => 'required|string|max:255',
            'Ref_NO' => 'required|string|max:255',
            'datefrom' => 'required|date',
            'deadline' => 'required|date',
            'status' => 'required|in:Open,Closed',
            'qualifications' => 'required|string',
        ]);

        // Update the job record
        $extjobs->update($validatedData);

        return redirect()->route('EXT.Application.listed')->with('status', 'Job updated successfully!');
    }

    // Unauthorized access fallback
    return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
}


public function extapplicationtsext()
 {
     // Get the authenticated HR user
     $ext = Auth::guard('EXT')->user();
 
     // Ensure HR user exists
     if (!$ext) {
         abort(403, 'Unauthorized Access');
     }
 
     
    $now = Carbon::now(); // Current time now

    $extjobs = EXTJOB::where('status', 'Open')
        ->where('deadline', '>', $now->startOfDay()) // deadline must be today or future
        ->get(); 
     // Pass the HR user's job group and job group hierarchy to the view
     return view('EXT.Application.Jobs', compact('extjobs', 'ext'));
 }

  public function EXTAP($id)
    {
       $extjobs = EXTJOB::findOrFail($id);
    
        return view('EXT.Application.Apply', compact('extjobs'));
    }
    
   public function extjobApplyext(Request $request, $id)
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
        $extjobs = EXTJOB::findOrFail($id);

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
              'job_s_no' => $extjobs->id,
            'status' => 'Applied',
            'datetime' => now(),
        ]);
        

        // Send email to the user
        Mail::to($validated['email'])
        ->cc('internalrecruitment2025@ksg.ac.ke')
        ->send(new EXTJobApplicationMail($validated, $cvFullPath, $coverLetterFullPath, $bioPdfPath));

        return redirect()->route('EXT.Application.MY')->with('success', 'You have successfully applied for this job as ' . $validated['designation'] . '!');
    }

    private function generateAndSaveBioReport($upn_no, $uploadPath)
    {
        // Fetch data for the bio report
        $academics = Academic::where('upn_no', $upn_no)->get();

        // Fetch work experience records related to the user
        $experiences = Experience::where('upn_no', $upn_no)->get();
        
        
        $proffecional = Proffecional::all();
       $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
      
   $applications= Application::where('upn_no', $upn_no)->get();
   $licence= Licence::where('upn_no', $upn_no)->get();
   $referees= Referees::where('upn_no', $upn_no)->get();
        // Load the Blade template and render as HTML
        $html = view('pdf.user_Ext', compact('academics', 'experiences','referees', 'proffecional','profecionalbodies','licence','applications'))->render();

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
    public function EXTEXTMY()
    {
        // Get the logged-in HR user's UPN number
        $upn_no = Auth::guard('EXT')->user()->upn_no;

        // Fetch all job applications for this user
        $applications = Application::where('upn_no', $upn_no)->get();

        return view('EXT.Application.MY', compact('applications'));
    }
    public function EXTApplicationdetailsext($id)
    {
        // Fetch application details
        $application = Application::where('id', $id)->firstOrFail();

        // Fetch job details associated with this application
        $extjobs = EXTJOB::where('id', $application->job_s_no)->firstOrFail();

        return view('EXT.Application.Details', compact('application', 'extjobs'));
    }
      public function extabortApplicationext($id)
{
    // Find the application by Ref_No
    $application = Application::where('id', $id)->first();

    if (!$application) {
        return redirect()->route('EXT.Application.MY')->with('error', 'Application not found.');
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
    return redirect()->route('EXT.Application.MY')->with('success', 'Application deleted successfully. You can apply again.');
}

 public function extapplicatinsadj()
    {
        $latestApplications = Application::whereDate('created_at', '>=', Carbon::parse('2025-06-25'))
        ->where('upn_no', 'like', 'EXT-%')
        ->orderByDesc('datetime')
        ->get()
        ->groupBy('upn_no')
        ->map(function ($group) {
            return $group->first(); // pick most recent application per upn_no
        });

    // Step 2: Prepare dataset
    $data = $latestApplications->map(function ($app) {
      $experiences = Experience::where('upn_no', $app->upn_no)
    ->orderBy('enddate', 'desc')
    ->get();

// Initialize total days counter
$totalDays = 0;

foreach ($experiences as $experience) {
    if ($experience->stdate && $experience->enddate) {
        $start = Carbon::parse($experience->stdate);
        $end = Carbon::parse($experience->enddate);

        // Only add if end is after start
        if ($end->greaterThan($start)) {
            $totalDays += $start->diffInDays($end);
        }
    }
}

// Convert total days into years, months, days using CarbonInterval
$cumulativeExperience = 'N/A';
if ($totalDays > 0) {
    $interval = CarbonInterval::days($totalDays)->cascade();
    $cumulativeExperience = "{$interval->y} years, {$interval->m} months, {$interval->d} days";
}
        return [
            'application' => $app,
            'ext' => EXT::where('upn_no', $app->upn_no)->first(),
           'education_academic' => Academic::where('upn_no', $app->upn_no)
    ->where('Education_type', 'Academic')
    ->orderBy('enddate', 'desc')
    ->get(),
    'experiences' => $experiences,

'education_training' => Academic::where('upn_no', $app->upn_no)
    ->where('Education_type', 'Training')
    ->orderBy('enddate', 'desc')
    ->get(),
            
           //'experiences' => Experience::where('upn_no', $app->upn_no)
                           //->orderBy('enddate', 'desc')
                           //->get(),
                           'experiences' => $experiences,
            'cumulative_experience' => $cumulativeExperience,

            'profecionalbodies' => Profecionalbody::where('upn_no', $app->upn_no)->get(),
             'applications' => Application::where('upn_no', $app->upn_no)
                                     ->orderBy('datetime', 'desc')
                                     ->get(),
            'licence' => Licence::where('upn_no', $app->upn_no)->get(),
             'referees' => Referees::where('upn_no', $app->upn_no)->get(),                        
        ];
    });

       

        return view('EXT.Admin.Ext', compact('data'));
    }
    public function extmailupdate()
{
    $admin = Auth::guard('admin')->user(); // Authenticated admin
    $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

    // Allow only Admin or dex roles
    if ($admin && in_array($admin->role, $allowedRoles)) {
        $ext = EXT::all(); // Fetch all HRPU users
        return view('EXT.Admin.Users', ['admin' => $admin, 'ext' => $ext]);
    }

    // Unauthorized access
    return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
}
public function extupdateEmail(Request $request, $id)
{
    $request->validate([
        'email' => 'required|email|unique:ext,email,' . $id, // email must be unique except current user
    ]);

    $admin = Auth::guard('admin')->user(); // acting admin

    $ext = EXT::findOrFail($id);
    $ext->email = $request->email;
    $ext->updated_at = now();
    $ext->acted_by = $admin->email;
    $ext->save();

    return back()->with('success', 'Email updated successfully for ' . $ext->name);
}
}
