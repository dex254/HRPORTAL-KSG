<?php

namespace App\Http\Controllers;
use Mpdf\Mpdf;
use App\Models\Other;
use App\Models\Licence;
use App\Models\Academic;
use App\Models\Referees;
use App\Models\Experience;
use App\Models\Proffecional;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Profecionalbody;
use App\Models\YearsOfExperence;
use Illuminate\Support\Facades\Auth;

class NewController extends Controller
{
    //
     public function extExperinceext()
    {
        $upn_no = Auth::guard('EXT')->user()->upn_no;

        // Fetch experience records where `upn_no` matches the logged-in user
       $experiences = Experience::where('upn_no', $upn_no)
    ->orderBy('enddate', 'desc')
    ->get();

        return view('EXT.Experince.New', compact('experiences'));
    }

    // Store experience data
    public function extExperincepostext(Request $request)
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
    public function extepdestroyext($id)
    {
        $experiences = Experience::findOrFail($id);

        // Delete the certificate file if it exists
      
        // Delete record
        $experiences->delete();

        return redirect()->back()->with('success', 'Experince record deleted successfully.');
    }



    public function extreportscompleteext()
    {
        $upn_no = Auth::guard('EXT')->user()->upn_no;

        // Fetch academic records related to the user
        $academics = Academic::where('upn_no', $upn_no)->get();

        // Fetch work experience records related to the user
        $experiences = Experience::where('upn_no', $upn_no)->get();
        
        
        $proffecional = Proffecional::all();
       $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
       $licence = Licence::where('upn_no', $upn_no)->get();
       
       $referees= Referees::where('upn_no', $upn_no)->get();
       $other = Other::where('upn_no', $upn_no)
    ->where('type', 'Consultancy')
    ->orderBy('compedate', 'desc')
    ->get();

// Fetch training records (Education_type = 'Training'), ordered by most recent start date
$others = Other::where('upn_no', $upn_no)
     ->where('type', 'Research')
    ->orderBy('compedate', 'desc')
    ->get();
        $publications = Other::where('upn_no', $upn_no)
        ->where('type', 'Publication')
        ->orderBy('compedate', 'desc')
        ->get();
       

        return view('EXT.Report.User', compact('academics','licence','referees','experiences', 'proffecional','profecionalbodies','other','others','publications'));
    }
    public function extgenerateUserReportext()
{
    $upn_no = Auth::guard('EXT')->user()->upn_no;

        // Fetch academic records related to the user
        $academics = Academic::where('upn_no', $upn_no)->get();

        // Fetch work experience records related to the user
        $experiences = Experience::where('upn_no', $upn_no)->get();
        
        
        $proffecional = Proffecional::all();
       $profecionalbodies= Profecionalbody::where('upn_no', $upn_no)->get();
       $licence = Licence::where('upn_no', $upn_no)->get();
       
       $referees= Referees::where('upn_no', $upn_no)->get();
        $other = Other::where('upn_no', $upn_no)
    ->where('type', 'Consultancy')
    ->orderBy('compedate', 'desc')
    ->get();

// Fetch training records (Education_type = 'Training'), ordered by most recent start date
$others = Other::where('upn_no', $upn_no)
     ->where('type', 'Research')
    ->orderBy('compedate', 'desc')
    ->get();
        $publications = Other::where('upn_no', $upn_no)
        ->where('type', 'Publication')
        ->orderBy('compedate', 'desc')
        ->get();
    // Load the Blade template as HTML
    $html = view('pdf.user_Ext', compact('academics','licence','referees','experiences', 'proffecional','profecionalbodies','other','others','publications'))->render();

    // Initialize mPDF
    $mpdf = new Mpdf();
    $mpdf->WriteHTML($html);

    // Return PDF inline (open in browser)
    return response($mpdf->Output('User_Report.pdf', 'I'))->header('Content-Type', 'application/pdf');
}
}
