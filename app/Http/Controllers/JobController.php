<?php

namespace App\Http\Controllers;


use Mpdf\Mpdf;
use App\Models\HR;
use Carbon\Carbon;
use App\Models\JOB;
use App\Models\Licence;
use App\Models\Medical;
use App\Models\Academic;
use App\Models\Experience;
use App\Models\Application;
use App\Models\Association;
use App\Models\Coremandate;
use App\Models\Proffecional;
use Illuminate\Http\Request;
use App\Models\Profecionalbody;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InterviewScheduled;
use App\Mail\JobApplicationMail;
use App\Mail\ApplicationRejected;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    //
    public function createjob()
    {
        
        $admin = Auth::guard('admin')->user(); // Use guard for admin
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

       
        if ($admin && (in_array($admin->role, $allowedRoles) || $admin->role === 'Dex')){
            return view('JOB.create', ['admin' => $admin]); // Pass the admin to the view
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.'); 
    }  
    public function createjobdata(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $validatedData = $request->validate([
                'Designation' => 'required|string|max:255',
                'Job_Group' => 'required|string',
                'Proposed_No_of_Positions' => 'required|string',
                'AE' => 'required|string|max:255',
                'IP' => 'required|string|max:255',
                'Var' => 'required|string|max:255',
                 'Ref_NO' => 'required|string|max:255',
                 'datefrom' => 'required|date',
                'deadline' => 'required|date',
                'qualifications' => 'nullable|string',
            ]); 
            $deadline = Carbon::parse($validatedData['deadline']);
        $currentDate = Carbon::now();
        
        // Set status based on deadline
        $validatedData['status'] = $deadline->lt($currentDate) ? 'Closed' : 'Open';

        JOB::create($validatedData);

            return redirect()->route('JOB.listed')->with('status', 'Job created successfully!');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }
//deleting  
public function destroy($s_no)
{
    $job = JOB::findOrFail($s_no);
    $job->delete();

    return redirect()->back()->with('status', 'Job deleted successfully!');
}
    // List all advertised jobs
    public function listedjob()
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
           $jobs = JOB::where('deadline', '>', Carbon::today())
           ->orderBy('datefrom', 'desc')
           ->get();            return view('JOB.listed', compact('jobs', 'admin'));
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // Show job details
    public function detailsjob($s_no)
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $jobs = JOB::where('s_no', $s_no)->firstOrFail();
            return view('JOB.details', compact('jobs', 'admin'));
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // Show the form to update a job
    public function updatejob($s_no)
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $jobs = JOB::where('s_no', $s_no)->firstOrFail();
            return view('jobs.update', compact('job', 'admin'));
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

    // Process job update
    public function updatejobdata(Request $request, $s_no)
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
            $jobs = JOB::where('s_no', $s_no)->firstOrFail();

            $validatedData = $request->validate([
               'Designation' => 'required|string|max:255',
                'Job_Group' => 'required|string',
                'Proposed_No_of_Positions' => 'required|string',
                'AE' => 'required|string|max:255',
                'IP' => 'required|string|max:255',
                'Var' => 'required|string|max:255',
                 'Ref_NO' => 'required|string|max:255',
                 'datefrom' => 'required|date',
                'deadline' => 'required|date',
                'status' => 'required|string',
                'qualifications' => 'nullable|string',
            ]); 
           

            $jobs->update($validatedData);

            return redirect()->route('JOB.listed')->with('status', 'Job updated successfully!');
        }

        return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
    }

 public function applicationts()
 {
     // Get the authenticated HR user
     $hr = Auth::guard('HR')->user();

    // Ensure HR user exists
    if (!$hr) {
        abort(403, 'Unauthorized Access');
    }

    // Fetch all open jobs (no filtering based on job group)
    $jobs = JOB::where('status', 'Open')
    ->whereDate('deadline', '>=', Carbon::today())
    ->get();
     // Pass the HR user's job group and job group hierarchy to the view
     return view('JOB.applicants', compact('hr', 'jobs'));
 }
    public function showApplyPage($s_no)
    {
        $jobs = JOB::where('s_no', $s_no)->get();

        // Ensure at least one application exists, otherwise return 404
      
    
        // Fetch job details associated with this Ref_No (assuming all applications belong to the same job)
        $jobs = JOB::where('s_no', $s_no)->firstOrFail();
    
        return view('JOB.Apply', compact('jobs'));
    }
    
    public function jobApply(Request $request, $s_no)
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
            'cover_letter' => 'required|file|mimes:pdf|max:2048', // Cover letter must be PDF and max 2MB
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
        $jobs = JOB::where('s_no', $s_no)->firstOrFail();

        // Define the upload path
        $uploadPath = public_path('uploads/Application');

        // Ensure the upload directory exists
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Handle CV Upload
        $cvName = time() . '_cv.pdf';
        $cvFullPath = $request->file('cv')->move($uploadPath, $cvName);

    // Handle Cover Letter Upload
    $coverLetterName = time() . '_cover_letter.pdf';
    $coverLetterFullPath = $request->file('cover_letter')->move($uploadPath, $coverLetterName);
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
            'job_s_no' => $s_no,
            'status' => 'Applied',
            'datetime' => now(),
            
        ]);
        

        // Send email to the user
        Mail::to($validated['email'])
        ->cc('internalrecruitment2025@ksg.ac.ke')
        ->send(new JobApplicationMail($validated, $cvFullPath, $coverLetterFullPath, $bioPdfPath));

        return redirect()->route('JOB.applicants')->with('success', 'You have successfully applied for this job as ' . $validated['designation'] . '!');
    }

    private function generateAndSaveBioReport($upn_no, $uploadPath)
    {
        // Fetch data for the bio report
        $academics = Academic::where('upn_no', $upn_no)->get();
        $experiences = Experience::where('upn_no', $upn_no)->get();
        $coremandate = Coremandate::where('upn_no', $upn_no)->get();
        $licence = Licence::where('upn_no', $upn_no)->get();
        $proffecional = Proffecional::all();
        $profecionalbodies = Profecionalbody::where('upn_no', $upn_no)->get();
        $medical = Medical::where('upn_no', $upn_no)->get();
        $associations = Association::where('upn_no', $upn_no)->get();

        // Load the Blade template and render as HTML
        $html = view('pdf.user_apply', compact('academics', 'experiences', 'coremandate', 'licence', 'proffecional', 'profecionalbodies', 'medical', 'associations'))->render();

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

public function myApplications()
    {
        // Get the logged-in HR user's UPN number
        $upn_no = Auth::guard('HR')->user()->upn_no;

        // Fetch all job applications for this user
        $applications = Application::where('upn_no', $upn_no)->get();

        return view('JOB.Myapplications', compact('applications'));
    }
    public function Applicationdetails($id)
    {
        // Fetch application details
        $application = Application::where('id', $id)->firstOrFail();

        // Fetch job details associated with this application
        $job = JOB::where('s_no', $application->job_s_no)->firstOrFail();

        return view('JOB.Applicationdetails', compact('application', 'job'));
    }
    public function abortApplication($id)
{
    // Find the application by Ref_No
    $application = Application::where('id', $id)->first();

    if (!$application) {
        return redirect()->route('JOB.Myapplicants')->with('error', 'Application not found.');
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
    return redirect()->route('JOB.Myapplicants')->with('success', 'Application deleted successfully. You can apply again.');
}

    public function adminApplications()
{
    
    $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant','Dex','Super Admin','Data','HRM'];

        if ($admin && in_array($admin->role, $allowedRoles)) {// Fetch all applications grouped by designation and Ref_No
            $groupedApplicants = Application::select('upn_no', 'name')
            ->groupBy('upn_no', 'name')
            ->selectRaw('COUNT(*) as total_applications')
            ->selectRaw('SUM(CASE WHEN status = "Applied" THEN 1 ELSE 0 END) as applied_count')
            ->selectRaw('SUM(CASE WHEN status = "Qualified" THEN 1 ELSE 0 END) as qualified_count')
            ->selectRaw('SUM(CASE WHEN status = "Not Qualified" THEN 1 ELSE 0 END) as not_qualified_count')
            ->get();
    
        return view('JOB.adminapplicatins', compact('groupedApplicants'));
        }

return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
}
public function Veiwapplicatnts($upn_no)
{
    // Fetch HR details for the given upn_no
    $hr = HR::where('upn_no', $upn_no)->first();

    // Ensure HR user exists, otherwise return 404
    if (!$hr) {
        abort(404, 'HR details not found for this UPN number.');
    }

    // Fetch applications with status "Applied" for the given upn_no
    $applications = Application::where('upn_no', $upn_no)
        ->where('status', 'Applied')
        ->get();

    // Fetch academics for the given upn_no, ordered by enddate (most recent first)
    $academics = Academic::where('upn_no', $upn_no)
        ->orderBy('enddate', 'desc')
        ->get();

    // Fetch experiences for the given upn_no
    $experiences = Experience::where('upn_no', $upn_no)->get();

    // Fetch licences for the given upn_no
    $licences = Licence::where('upn_no', $upn_no)->get();

    // Fetch core mandates for the given upn_no
    $coremandates = Coremandate::where('upn_no', $upn_no)->get();

    // Fetch professional bodies for the given upn_no
    $profecionalbodies = Profecionalbody::where('upn_no', $upn_no)->get();

    // Fetch medical details for the given upn_no
    $medical = Medical::where('upn_no', $upn_no)->get();

    // Fetch associations for the given upn_no
    $associations = Association::where('upn_no', $upn_no)->get();

    return view('JOB.Veiwapplicatnts', compact(
        'hr',
        'applications',
        'academics',
        'experiences',
        'licences',
        'coremandates',
        'profecionalbodies',
        'medical',
        'associations'
    ));
}
public function ApplicantsDetail($ref_no)
{
    // Fetch all applicants for the given Ref_No
    $applications = Application::where('Ref_No', $ref_no)->get();

    // Ensure at least one application exists, otherwise return 404
    if ($applications->isEmpty()) {
        abort(404, 'No applicants found for this reference number.');
    }

    // Fetch HR details based on UPN numbers of the applicants
    $upnNumbers = $applications->pluck('upn_no'); // Get all UPN numbers from applications
    $hrDetails = HR::whereIn('upn_no', $upnNumbers)->get();

    return view('JOB.Applicantsdetails', compact('applications', 'hrDetails'));
}
public function scheduleInterview(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'intervew' => 'required|date_format:Y-m-d\TH:i',
        'venue' => 'required|string',
    ]);

    // Find the application by ID
    $application = Application::findOrFail($id);

    // Update the application with interview details and set status to "Qualified"
    $application->update([
        'intervew' => $request->input('intervew'),
        'venue' => $request->input('venue'),
        'status' => 'Qualified', // Update the status to "Qualified"
    ]);

    // Generate a memo (PDF document) and save it in the public/uploads/MEMO folder
    $filePath = $this->generateMemo($application, 'uploads/MEMO');

    // Update the memo field in the database with the file path
    $application->update(['MEMO' => $filePath]);

    // Send an email to the user with additional details, updated status, and attached PDF
    Mail::to($application->email)->send(new InterviewScheduled(
        $application->idnumber,
        $application->name,
        $application->Ref_No,
        $application->designation,
        $application->intervew, // Pass the interview date
        $application->venue, // Pass the venue
        $application->status, // Pass the updated status
        public_path($filePath) // Attach the PDF from the public directory
    ));

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Interview scheduled successfully, status updated to "Qualified", memo generated, and email sent to the user.');
}
private function generateMemo($application, $uploadPath)
{
    // Sanitize the upload path
    $uploadPath = str_replace(' ', '_', $uploadPath); // Replace spaces with underscores
    $uploadPath = preg_replace('/[^A-Za-z0-9_\-]/', '', $uploadPath); // Remove special characters

    // Ensure the upload path exists in the public directory
    $publicPath = public_path($uploadPath);
    if (!file_exists($publicPath)) {
        mkdir($publicPath, 0755, true); // Create the directory with proper permissions
    }

    // Data to pass to the PDF view
    $data = [
        'application' => $application,
    ];

    // Generate the PDF
    $pdf = Pdf::loadView('pdf.user_memo', $data);

    // Define the file name and path
    $fileName = 'memo_' . $application->upn_no . '_' . time() . '.pdf';
    $filePath = $uploadPath . '/' . $fileName;

    // Save the PDF to the specified path in the public directory
    $pdf->save($publicPath . '/' . $fileName);

    // Return the file path (relative to the public directory)
    return $filePath;
}
public function rejectApplication(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'rejection_reason' => 'required|string',
    ]);

    // Find the application by ID
    $application = Application::findOrFail($id);

    // Update the application status to "Rejected"
    $application->update([
        'status' => 'Not Qualified', // Update the status
        'rejection_reason' => $request->input('rejection_reason'),
    ]);

    // Generate a rejection memo (PDF document)
    $filePath = $this->generateRejectionMemo($application, $request->input('rejection_reason'), 'uploads/RJMEMO');

    // Update the memo field in the database with the file path
    $application->update(['MEMO' => $filePath]);

    // Send an email to the user with the rejection details and attached PDF
    Mail::to($application->email)->send(new ApplicationRejected(
        $application->idnumber,
        $application->name,
        $application->Ref_No,
        $application->designation,
        $application->status, // Pass the updated status
        $request->input('rejection_reason'), // Pass the rejection reason
        public_path($filePath) // Attach the PDF
    ));

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Application rejected successfully, memo generated, and email sent to the user.');
}

private function generateRejectionMemo($application, $rejectionReason, $uploadPath)
{
    // Sanitize the upload path
    $uploadPath = str_replace(' ', '_', $uploadPath); // Replace spaces with underscores
    $uploadPath = preg_replace('/[^A-Za-z0-9_\-]/', '', $uploadPath); // Remove special characters

    // Ensure the upload path exists in the public directory
    $publicPath = public_path($uploadPath);
    if (!file_exists($publicPath)) {
        mkdir($publicPath, 0755, true); // Create the directory with proper permissions
    }

    // Data to pass to the PDF view
    $data = [
        'application' => $application,
        'rejectionReason' => $rejectionReason,
    ];

    // Generate the PDF
    $pdf = Pdf::loadView('pdf.rejection_memo', $data);

    // Define the file name and path
    $fileName = 'rejection_memo_' . $application->upn_no . '_' . time() . '.pdf';
    $filePath = $uploadPath . '/' . $fileName;

    // Save the PDF to the specified path in the public directory
    $pdf->save($publicPath . '/' . $fileName);

    // Return the file path (relative to the public directory)
    return $filePath;
}
}
