<?php

namespace App\Http\Controllers;

use App\Models\HRPU;
use App\Models\Other;
use App\Models\Academic;
use App\Models\Teaching;
use App\Models\Experience;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Profecionalbody;
use Illuminate\Support\Facades\Auth;

class OtherController extends Controller
{
    //

    public function other()
    {
        $userUpnNo = Auth::guard('HRPU')->user()->upn_no;

        // Fetch academic records where `upn_no` matches the logged-in user
       $other = Other::where('upn_no', $userUpnNo)
    ->where('type', 'Consultancy')
    ->orderBy('compedate', 'desc')
    ->get();

// Fetch training records (Education_type = 'Training'), ordered by most recent start date
$others = Other::where('upn_no', $userUpnNo)
     ->where('type', 'Research')
    ->orderBy('compedate', 'desc')
    ->get();

        return view(' Experience.Other', compact('other','others'));
    }
    public function otherpost(Request $request)
    {
          
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'upn_no' => 'required|string',
            'type' => 'required|string',
            'Client' => 'required|string',
            'Sector' => 'required|string',
            'completed' => 'required|string',
            'compedate' => 'required|date',
           
            'Amount' => 'nullable|string',
            'document' => 'nullable|file',
           // Allow only PDFs, max size 2MB
        ]);

        // Upload the document
         $documentName = null;
    if ($request->hasFile('document')) {
        $documentName = time() . '.' . $request->document->getClientOriginalExtension();
        $request->document->move(public_path('uploads/Other'), $documentName);
    }
        // Save record in the database
        Other::create([
          'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'type' => $request->type,
    'upn_no' => $request->upn_no,
    'Client' => $request->Client,
    'Sector' => $request->Sector,
    'completed' => $request->completed,
    'compedate' => $request->compedate,
    'Amount' => $request->Amount,
    'document_name' => $documentName,
        ]);

        return redirect()->back()->with('success', 'Consultancy record added successfully.');
  
    }
    public function otherspost(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'upn_no' => 'required|string',
            'type' => 'required|string',
            'Client' => 'required|string',
            'Sector' => 'required|string',
            'completed' => 'required|string',
            'compedate' => 'required|date',
           
            'Amount' => 'nullable|string',
            'document' => 'nullable|file',
           // Allow only PDFs, max size 2MB
        ]);

        // Upload the document
         $documentName = null;
    if ($request->hasFile('document')) {
        $documentName = time() . '.' . $request->document->getClientOriginalExtension();
        $request->document->move(public_path('uploads/Other'), $documentName);
    }
        // Save record in the database
        Other::create([
          'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'upn_no' => $request->upn_no,
    'type' => $request->type,
    'Client' => $request->Client,
    'Sector' => $request->Sector,
    'completed' => $request->completed,
    'compedate' => $request->compedate,
    'Amount' => $request->Amount,
    'document_name' => $documentName,
        ]);

        return redirect()->back()->with('success', 'Research record added successfully.');
    }
    public function destroyother($id)
    {
        $other = Other::findOrFail($id);

        // Delete the certificate file if it exists
       

        // Delete record
        $other->delete();

        return redirect()->back()->with('success', 'Consultancy assignments and Research assignments deleted successfully.');
    }
     public function applicatinsadj()
    {
        $latestApplications = Application::whereDate('created_at', '>=', Carbon::parse('2025-06-25'))
        ->where('upn_no', 'like', 'ADJ-%')
        ->orderByDesc('datetime')
        ->get()
        ->groupBy('upn_no')
        ->map(function ($group) {
            return $group->first(); // pick most recent application per upn_no
        });

    // Step 2: Prepare dataset
    $data = $latestApplications->map(function ($app) {
        return [
            'application' => $app,
            'hrpu' => HRPU::where('upn_no', $app->upn_no)->first(),
           'academics' => Academic::where('upn_no', $app->upn_no)
                       ->orderBy('enddate', 'desc')
                       ->get(),
            'others' => Other::where('upn_no', $app->upn_no)->get(),
           'experiences' => Experience::where('upn_no', $app->upn_no)
                           ->orderBy('enddate', 'desc')
                           ->get(),

            'profecionalbodies' => Profecionalbody::where('upn_no', $app->upn_no)->get(),
             'applications' => Application::where('upn_no', $app->upn_no)
                                     ->orderBy('datetime', 'desc')
                                     ->get(),
            'teachings' => Teaching::where('upn_no', $app->upn_no)
                                     ->orderBy('enddate', 'desc')
                                     ->get(),
        ];
    });

       

        return view('HRPU.Applications', compact('data'));
    }
    public function mailupdate()
{
    $admin = Auth::guard('admin')->user(); // Authenticated admin
    $allowedRoles = ['Admin', 'dex'];

    // Allow only Admin or dex roles
    if ($admin && in_array($admin->role, $allowedRoles)) {
        $hrpu = HRPU::all(); // Fetch all HRPU users
        return view('HRPU.Admin', ['admin' => $admin, 'hrpu' => $hrpu]);
    }

    // Unauthorized access
    return redirect()->route('admin.dashboard')->with('error', 'You are not authorized to access this page.');
}
public function updateEmail(Request $request, $id)
{
    $request->validate([
        'email' => 'required|email|unique:hrpu,email,' . $id, // email must be unique except current user
    ]);

    $admin = Auth::guard('admin')->user(); // acting admin

    $hrpu = HRPU::findOrFail($id);
    $hrpu->email = $request->email;
    $hrpu->updated_at = now();
    $hrpu->acted_by = $admin->email;
    $hrpu->save();

    return back()->with('success', 'Email updated successfully for ' . $hrpu->name);
}
    
}
