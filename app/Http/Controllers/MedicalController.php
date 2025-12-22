<?php

namespace App\Http\Controllers;

use App\Models\Medical;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    //
    
    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'upn_no' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'name' => 'required|string',
            'job_group' => 'nullable|string',
            'condition' => 'required|in:yes,no',
            'date' => 'nullable|string',
            'name_exam' => 'nullable|string',
            'document' => 'nullable|file',
        ]);
        $documentName = null;
        // Handle file upload
        if ($request->hasFile('document')) {
            $documentName = time() . '.' . $request->document->getClientOriginalExtension();
            $request->document->move(public_path('uploads/Medical'), $documentName);
        }

        // Save the data to the database
        Medical::create([
            'upn_no' => $request->upn_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'job_group' => $request->job_group,
            'condition' => $request->condition,
            'date' => $request->date,
            'name_exam' => $request->name_exam,
            'status' => 'Active',
            'document_name' => $documentName, // Save the document name
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'The  Medical Examination has  been saved successfully!');
    }
    public function destroymedical($id)
{
    // Find the licence entry by ID
    $medical = Medical::find($id);

    if ($medical) {
        // Delete the associated document from the uploads directory
        if ($medical->document_name && file_exists(public_path('uploads/Medical/' . $medical->document_name))) {
            unlink(public_path('uploads/Medical/' . $medical->document_name));
        }

        // Delete the licence entry from the database
        $medical->delete();

        // Redirect with a success message
        return redirect()->back()->with('success', 'The Medical entry and associated document have been deleted successfully!');
    }

    // If the licence entry is not found, redirect with an error message
    return redirect()->back()->with('error', 'Medical entry not found.');
}
}
