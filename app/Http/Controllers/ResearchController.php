<?php

namespace App\Http\Controllers;

use App\Models\Other;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResearchController extends Controller
{
    //
    public function ResearchHome()
    {
        $userUpnNo = Auth::guard('HR')->user()->upn_no;

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

        return view('Research.Home', compact('other','others'));
    }
    public function Researchotherpost(Request $request)
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
        $documentName = null;
    if ($request->hasFile('document')) {
        $documentName = time() . '.' . $request->document->getClientOriginalExtension();
        $request->document->move(public_path('uploads/Other'), $documentName);
    }

        // Upload the document
        
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
    public function Researchotherspost(Request $request)
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
         $documentName = null;
    if ($request->hasFile('document')) {
        $documentName = time() . '.' . $request->document->getClientOriginalExtension();
        $request->document->move(public_path('uploads/Other'), $documentName);
    }

        // Upload the document
        
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
    public function Researchdestroyother($id)
    {
        $other = Other::findOrFail($id);

        // Delete the certificate file if it exists
       

        // Delete record
        $other->delete();

        return redirect()->back()->with('success', 'Consultancy assignments and Research assignments deleted successfully.');
    }
}
