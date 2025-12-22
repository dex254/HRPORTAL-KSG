<?php

namespace App\Http\Controllers;

use App\Models\Academic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ExternalController extends Controller
{
    //
     public function extAcademicext()
    {
        $userUpnNo = Auth::guard('EXT')->user()->upn_no;

        // Fetch academic records where `upn_no` matches the logged-in user
       $academics = Academic::where('upn_no', $userUpnNo)
    ->where('Education_type', 'Academic')
    ->orderBy('stdate', 'desc')
    ->get();

// Fetch training records (Education_type = 'Training'), ordered by most recent start date
$trainning = Academic::where('upn_no', $userUpnNo)
    ->where('Education_type', 'Training')
    ->orderBy('stdate', 'desc')
    ->get();
        return view('EXT.Academic.Home', compact('academics','trainning'));
    }
    public function extAcademicpostext(Request $request)
    {
          
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'upn_no' => 'required|string',
            'institution' => 'required|string',
            'course' => 'required|string',
            'level' => 'required|string',
            'stdate' => 'required|date',
            'enddate' => 'required|date',
            'grade' => 'nullable|string',
            'document' => 'required|file',
            'Education_type' => 'required|string',// Allow only PDFs, max size 2MB
        ]);

        // Upload the document
        if ($request->hasFile('document')) {
            $documentName = time() . '.' . $request->document->getClientOriginalExtension();
            $request->document->move(public_path('uploads/Academic'), $documentName);

        // Save record in the database
        Academic::create([
            'upn_no' =>$request->upn_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'institution' => $request->institution,
            'course' => $request->course,
            'level' => $request->level,
            'stdate' => $request->stdate,
            'enddate' => $request->enddate,
            'grade' => $request->grade,
            'document_name' => $documentName,
            'Education_type' => $request->Education_type,
        ]);

        return redirect()->back()->with('success', 'Academic record added successfully.');
    }
        return redirect()->back()->with('error', 'Failed to upload document.');
    }
    public function extTrainingext(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'upn_no' => 'required|string',
            'institution' => 'required|string',
            'course' => 'required|string',
            'level' => 'required|string',
            'stdate' => 'required|date',
            'enddate' => 'required|date',
            'grade' => 'nullable|string',
            'document' => 'required|file',
            'Education_type' => 'required|string',// Allow only PDFs, max size 2MB
        ]);

        // Upload the document
        if ($request->hasFile('document')) {
            $documentName = time() . '.' . $request->document->getClientOriginalExtension();
            $request->document->move(public_path('uploads/Academic'), $documentName);

        // Save record in the database
        Academic::create([
            'upn_no' =>$request->upn_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'institution' => $request->institution,
            'course' => $request->course,
            'level' => $request->level,
            'stdate' => $request->stdate,
            'enddate' => $request->enddate,
            'grade' => $request->grade,
            'document_name' => $documentName,
            'Education_type' => $request->Education_type,
        ]);

        return redirect()->back()->with('success', 'Academic record added successfully.');
    }
        return redirect()->back()->with('error', 'Failed to upload document.');
    }
    public function extdestroyext($id)
    {
        $academic = Academic::findOrFail($id);

        // Delete the certificate file if it exists
        if ($academic->document_name) {
            $filePath = public_path('uploads/Academic/' . $academic->document_name);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        // Delete record
        $academic->delete();

        return redirect()->back()->with('success', 'Academic record deleted successfully.');
    }
}
