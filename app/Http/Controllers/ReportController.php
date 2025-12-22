<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\HR;
use App\Models\JOB;
use App\Models\Other;
use App\Models\Addjob;
use App\Models\Licence;
use App\Models\Medical;
use App\Models\Academic;
use App\Models\Teaching;
use App\Models\Experience;
use App\Models\Application;
use App\Models\Association;
use App\Models\Coremandate;
use App\Mail\UserReportMail;
use App\Models\Proffecional;
use Illuminate\Http\Request;
use App\Models\Profecionalbody;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class ReportController extends Controller
{
    //
    public function reportscomplete()
    {
        $upn_no = Auth::guard('HR')->user()->upn_no;

        // Fetch academic records related to the user
        $academics = Academic::where('upn_no', $upn_no)->get();

        // Fetch work experience records related to the user
        $experiences = Experience::where('upn_no', $upn_no)->get();
        //$coremandate = Coremandate::where('upn_no', $upn_no)->get();
        $others = Other::where('upn_no', $upn_no)->get();
        $licence = Licence::where('upn_no', $upn_no)->get();
        $proffecional = Proffecional::all();
       $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
       $medical= Medical::where('upn_no', $upn_no)->get();
       $associations= Association::where('upn_no', $upn_no)->get();

        return view('Report.Complete', compact('academics','others','experiences', 'licence', 'proffecional','profecionalbodies','medical','associations'));
    }
    public function generateUserReport()
{
    $upn_no = Auth::guard('HR')->user()->upn_no;
    $academics = Academic::where('upn_no', $upn_no)->get();
    $experiences = Experience::where('upn_no', $upn_no)->get();
    //$coremandate = Coremandate::where('upn_no', $upn_no)->get();
    $others = Other::where('upn_no', $upn_no)->get();
    $licence = Licence::where('upn_no', $upn_no)->get();
    $proffecional = Proffecional::all();
   $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
   $medical= Medical::where('upn_no', $upn_no)->get();
   $associations= Association::where('upn_no', $upn_no)->get();
    // Load the Blade template as HTML
    $html = view('pdf.user_report', compact('academics', 'experiences','others', 'licence', 'proffecional','profecionalbodies','medical','associations'))->render();

    // Initialize mPDF
    $mpdf = new Mpdf();
    $mpdf->WriteHTML($html);

    // Return PDF inline (open in browser)
    return response($mpdf->Output('User_Report.pdf', 'I'))->header('Content-Type', 'application/pdf');
}
public function finalcomplete()
    {
        $upn_no = Auth::guard('HR')->user()->upn_no;

        // Fetch academic records related to the user
        $academics = Academic::where('upn_no', $upn_no)->get();

        // Fetch work experience records related to the user
        $experiences = Experience::where('upn_no', $upn_no)->get();
        

        // Fetch all job applications for this user
        $applications = Application::where('upn_no', $upn_no)->get();

        return view('Report.Final', compact('academics', 'experiences','applications'));
    }

    
    
    public function generateFinalReport()
    {
        $user = Auth::guard('HR')->user();
        $upn_no = $user->upn_no;
        $email = $user->email;
    
        // Fetch user-related data
        $academics = Academic::where('upn_no', $upn_no)
        ->whereIn('Education_type', ['Academic'])
        ->get();
        
        $experiences = Experience::where('upn_no', $upn_no)->get();
        $applications = Application::where('upn_no', $upn_no)->get();
    
        // Generate a unique filename
        $pdfFileName = 'User_Report_' . $user->id . '.pdf';
        $pdfFilePath = storage_path('app/public/' . $pdfFileName);
    
        // Load the Blade template as HTML
        $html = view('pdf.user_final', compact('academics', 'experiences', 'applications',))->render();
    
        // Initialize mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, 'F'); // Save PDF to file
    
        // Prepare email data
        $applicationData = [
            'name' => $user->name,
            'designation' => 'Job Position', // Modify if necessary
            'Ref_No' => strtoupper(uniqid('KSG-')),
        ];
    
        // Send email with the PDF attachment
        Mail::to($email)->send(new UserReportMail($applicationData, $pdfFilePath));
    
        // Return PDF inline (open in browser)
        return response()->file($pdfFilePath, ['Content-Type' => 'application/pdf']);
    }
    public function qualifiedApplicants()
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant', 'dex'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
        $Applicants = Application::where('status', 'Qualified')
            ->with(['job','hr']) // Eager loading job details
            ->get();

        return view('Applications.Qualified ', compact('Applicants'));
    }
    return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
}
public function NotqualifiedApplicants()
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant', 'dex'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
        $Applicants = Application::where('status', 'Not Qualified')
            ->with(['job','hr']) // Eager loading job details
            ->get();

        return view('Applications.NotQualified ', compact('Applicants'));
    }
    return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
}
public function addJobget()
    {
        $admin = Auth::guard('admin')->user();
        $allowedRoles = ['Admin', 'AdminAssistant', 'dex'];

        if ($admin && in_array($admin->role, $allowedRoles)) {
       

        return view('Report.addjob ');
    }
    return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
}

public function addJob(Request $request)
{
    // Validate the request
    $request->validate([
        'addjob' => 'required|file|mimes:pdf|max:2048', // Max file size: 2MB
    ]);

    // Handle file upload
    if ($request->hasFile('addjob')) {
        $file = $request->file('addjob');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Store the file in the "Uploads/Addjobs" folder
        $filePath = $file->storeAs('uploads/Addjobs', $fileName, 'public');

        // Get the existing record (if any)
        $existingJob = Addjob::first();

        // If there's an existing file, delete it first
        if ($existingJob) {
            try {
                // Delete the old file from storage
                Storage::disk('public')->delete($existingJob->file_path);
                
                // Update the existing record with new file path
                $existingJob->update([
                    'file_path' => $filePath,
                    'updated_at' => now()
                ]);
                
                return redirect()->back()->with('success', 'File updated successfully!');
            } catch (\Exception $e) {
                // Delete the new file if update fails
                Storage::disk('public')->delete($filePath);
                return redirect()->back()->with('error', 'Error updating file: '.$e->getMessage());
            }
        } else {
            // Create new record if no existing file
            Addjob::create(['file_path' => $filePath]);
            return redirect()->back()->with('success', 'File uploaded successfully!');
        }
    }

    return redirect()->back()->with('error', 'No file uploaded.');
}
    // Add this method to your controller
public function viewLatestPdf()
{
    $latestPdf = Addjob::latest()->first();

    if (!$latestPdf || !Storage::disk('public')->exists($latestPdf->file_path)) {
        abort(404, 'No PDF document found.');
    }

    return response()->file(storage_path('app/public/' . $latestPdf->file_path));
}


//ext
 public function reportscompleteext()
    {
        $upn_no = Auth::guard('HRPU')->user()->upn_no;

        // Fetch academic records related to the user
        $academics = Academic::where('upn_no', $upn_no)->get();

        // Fetch work experience records related to the user
        $experiences = Experience::where('upn_no', $upn_no)->get();
        
        
        $proffecional = Proffecional::all();
       $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
       $other= Other::where('upn_no', $upn_no)->get();
       $teachings= Teaching::where('upn_no', $upn_no)->get();
       

        return view('Report.Ext', compact('academics','teachings', 'experiences', 'proffecional','profecionalbodies','other'));
    }
    public function generateUserReportext()
{
    $upn_no = Auth::guard('HRPU')->user()->upn_no;

        // Fetch academic records related to the user
        $academics = Academic::where('upn_no', $upn_no)->get();

        // Fetch work experience records related to the user
        $experiences = Experience::where('upn_no', $upn_no)->get();
        
        
        $proffecional = Proffecional::all();
       $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
      $other= Other::where('upn_no', $upn_no)->get();
       $teachings= Teaching::where('upn_no', $upn_no)->get();
    // Load the Blade template as HTML
    $html = view('pdf.user_reportext', compact('academics', 'teachings','experiences', 'proffecional','profecionalbodies','other'))->render();

    // Initialize mPDF
    $mpdf = new Mpdf();
    $mpdf->WriteHTML($html);

    // Return PDF inline (open in browser)
    return response($mpdf->Output('User_Report.pdf', 'I'))->header('Content-Type', 'application/pdf');
}

}
