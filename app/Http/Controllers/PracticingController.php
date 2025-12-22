<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticingController extends Controller
{
    //
     public function extlicence()
    {
        $ext = Auth::guard('EXT')->user();
        $upn_no = Auth::guard('EXT')->user()->upn_no;
        $licence = Licence::where('upn_no', $upn_no)->get();
        // Logic for Professional Licence page
        return view('EXT.Special.Licence', compact('ext','licence'));// Assuming you have a view file named `licence.blade.php`
    }
    public function extlicencepost(Request $request)
    {
        // Validate the request data
        $request->validate([
            'upn_no' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'name' => 'required|string',
            'job_group' => 'nullable|string',
            'has_license' => 'required|in:yes,no',
            'license_name' => 'nullable|required_if:has_license,yes|string|max:255',
            'license_date' => 'nullable|required_if:has_license,yes|date',
            'document' => 'nullable|required_if:has_license,yes|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload
        $documentName = null;
        if ($request->hasFile('document')) {
            $documentName = time() . '.' . $request->document->getClientOriginalExtension();
            $request->document->move(public_path('uploads/Licence'), $documentName);
        }

        // Save the data to the database
        Licence::create([
            'upn_no' => $request->upn_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'job_group' => $request->job_group,
            'has_license' => $request->has_license,
            'license_name' => $request->license_name,
            'license_date' => $request->license_date,
            'document_name' => $documentName, // Save the document name
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'The  proffecional  licence has  been saved successfully!');
    }
    public function extdestroy($id)
{
    // Find the licence entry by ID
    $licence = Licence::find($id);

    if ($licence) {
        // Delete the associated document from the uploads directory
        if ($licence->document_name && file_exists(public_path('uploads/Licence/' . $licence->document_name))) {
            unlink(public_path('uploads/Licence/' . $licence->document_name));
        }

        // Delete the licence entry from the database
        $licence->delete();

        // Redirect with a success message
        return redirect()->back()->with('success', 'The licence entry and associated document have been deleted successfully!');
    }

    // If the licence entry is not found, redirect with an error message
    return redirect()->back()->with('error', 'Licence entry not found.');
}
}
