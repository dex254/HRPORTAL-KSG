<?php

namespace App\Http\Controllers;

use App\Models\Proffecional;
use Illuminate\Http\Request;
use App\Models\Profecionalbody;
use App\Imports\ProffecionalImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProfecionalbodyController extends Controller
{
    //
    public function exellbody()
{
    $admin = Auth::guard('admin')->user();
   
    if (in_array($admin->role, ['Admin', 'dex', 'Admissions','AdminAssistant'])) {
        // Fetch all programs for these roles
        return view('Profecionalbody.Upload');

   
    }

    return redirect()->route('Admin.Dashboard')->with('error', 'You are not authorized to access this page.');
}
public function body(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new ProffecionalImport, $request->file('file'));

        return back()->with('success', 'Excel file imported successfully!');
    }
    public function proffecionalbody(Request $request)
{
    // Validate the request
    $request->validate([
        'upn_no' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'name' => 'required',
        'job_group' => 'nullable|string',
        'is_member' => 'required|string',
        'professional_body' => 'nullable|string',
        'new_professional_body' => 'nullable|string', // New field for custom entry
        'law' => 'nullable|string',
        'new_law' => 'nullable|string', // New field for custom law
        'status' => 'nullable|string',
        'date' => 'nullable|string',
        'document' => 'nullable|file',
    ]);

    // Handle file upload
    $documentName = null;
    if ($request->hasFile('document')) {
        $documentName = time() . '.' . $request->document->getClientOriginalExtension();
        $request->document->move(public_path('uploads/Profecionalbody'), $documentName);
    }

    // Check if "Other" was selected
    if ($request->professional_body === "Other") {
        // Validate the new professional body and law fields
        $request->validate([
            'new_professional_body' => 'required|string',
            'new_law' => 'required|string',
        ]);

        // Save the new professional body to the database
        $newProfessionalBody = new Proffecional([
            'name' => $request->new_professional_body,
            'law' => $request->new_law
        ]);
        $newProfessionalBody->save();

        // Use the newly added professional body
        $professionalBodyName = $request->new_professional_body;
        $law = $request->new_law;
    } else {
        $professionalBodyName = $request->professional_body;
        $law = $request->law;
    }

    // Prepare data for saving
    $data = [
        'upn_no' => $request->upn_no,
        'email' => $request->email,
        'phone' => $request->phone,
        'name' => $request->name,
        'job_group' => $request->job_group,
        'is_member' => $request->is_member,
        'professional_body' => $professionalBodyName,
        'law' => $law,
        'status' => $request->status,
        'date' => $request->date,
        'document_name' => $documentName,
    ];

    // Save the data to the database
    Profecionalbody::create($data);

    return redirect()->back()->with('success', '  Professional Body Data saved successfully.');
}

    public function destroybody($id)
{
    // Find the licence entry by ID
    $profecionalbodies = Profecionalbody::find($id);

    if ($profecionalbodies) {
        // Delete the associated document from the uploads directory
        if ($profecionalbodies->document_name && file_exists(public_path('uploads/Profecionalbody/' . $profecionalbodies->document_name))) {
            unlink(public_path('uploads/Profecionalbody/' . $profecionalbodies->document_name));
        }

        // Delete the licence entry from the database
        $profecionalbodies->delete();

        // Redirect with a success message
        return redirect()->back()->with('success', 'The Proffecional body entry and associated document have been deleted successfully!');
    }

    // If the licence entry is not found, redirect with an error message
    return redirect()->back()->with('error', 'Licence entry not found.');
}

//

 public function proffecionalbodyext(Request $request)
{
    // Validate the request
    $request->validate([
        'upn_no' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'name' => 'required',
        'job_group' => 'nullable|string',
        'is_member' => 'required|string',
        'professional_body' => 'nullable|string',
        'new_professional_body' => 'nullable|string', // New field for custom entry
        'law' => 'nullable|string',
        'new_law' => 'nullable|string', // New field for custom law
        'status' => 'nullable|string',
        'date' => 'nullable|string',
        'document' => 'nullable|file',
    ]);

    // Handle file upload
    $documentName = null;
    if ($request->hasFile('document')) {
        $documentName = time() . '.' . $request->document->getClientOriginalExtension();
        $request->document->move(public_path('uploads/Profecionalbody'), $documentName);
    }

    // Check if "Other" was selected
    if ($request->professional_body === "Other") {
        // Validate the new professional body and law fields
        $request->validate([
            'new_professional_body' => 'required|string',
            'new_law' => 'required|string',
        ]);

        // Save the new professional body to the database
        $newProfessionalBody = new Proffecional([
            'name' => $request->new_professional_body,
            'law' => $request->new_law
        ]);
        $newProfessionalBody->save();

        // Use the newly added professional body
        $professionalBodyName = $request->new_professional_body;
        $law = $request->new_law;
    } else {
        $professionalBodyName = $request->professional_body;
        $law = $request->law;
    }

    // Prepare data for saving
    $data = [
        'upn_no' => $request->upn_no,
        'email' => $request->email,
        'phone' => $request->phone,
        'name' => $request->name,
        'job_group' => $request->job_group,
        'is_member' => $request->is_member,
        'professional_body' => $professionalBodyName,
        'law' => $law,
        'status' => $request->status,
        'date' => $request->date,
        'document_name' => $documentName,
    ];

    // Save the data to the database
    Profecionalbody::create($data);

    return redirect()->back()->with('success', '  Professional Body Data saved successfully.');
}

    public function destroybodyext($id)
{
    // Find the licence entry by ID
    $profecionalbodies = Profecionalbody::find($id);

    if ($profecionalbodies) {
        // Delete the associated document from the uploads directory
        if ($profecionalbodies->document_name && file_exists(public_path('uploads/Profecionalbody/' . $profecionalbodies->document_name))) {
            unlink(public_path('uploads/Profecionalbody/' . $profecionalbodies->document_name));
        }

        // Delete the licence entry from the database
        $profecionalbodies->delete();

        // Redirect with a success message
        return redirect()->back()->with('success', 'The Proffecional body entry and associated document have been deleted successfully!');
    }

    // If the licence entry is not found, redirect with an error message
    return redirect()->back()->with('error', 'Licence entry not found.');
}
}
