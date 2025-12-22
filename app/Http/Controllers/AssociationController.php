<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    //
    public function make(Request $request)
    {
        // Validate the request data
        $request->validate([
            'upn_no' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'name' => 'required|string',
            'job_group' => 'nullable|string',
            'condition' => 'required|in:yes,no',
            'association_name' => 'nullable|string',
            'status' => 'nullable|in:Active,Inactive',
            'date' => 'nullable|string',

            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Initialize $documentName as null
        $documentName = null;
        if ($request->hasFile('document')) {
            $documentName = time() . '.' . $request->document->getClientOriginalExtension();
            $request->document->move(public_path('uploads/Association'), $documentName);
        }

        // Save the data to the database
        Association::create([
            'upn_no' => $request->upn_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'job_group' => $request->job_group,
            'condition' => $request->condition,
            'association_name' => $request->association_name,
            'status' => $request->status ?? null,
            'date' => $request->date, // Default to null if not provided
            'document_name' => $documentName, // Save the document name (can be null)
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'The Association information has been saved successfully!');
    }

    /**
     * Handle the deletion of an association.
     */
    public function destroyassociation($id)
    {
        // Find the association entry by ID
        $association = Association::find($id);

        if ($association) {
            // Delete the associated document from the uploads directory
            if ($association->document_name && file_exists(public_path('uploads/Association/' . $association->document_name))) {
                unlink(public_path('uploads/Association/' . $association->document_name));
            }

            // Delete the association entry from the database
            $association->delete();

            // Redirect with a success message
            return redirect()->back()->with('success', 'The Association entry and associated document have been deleted successfully!');
        }

        // If the association entry is not found, redirect with an error message
        return redirect()->back()->with('error', 'Association entry not found.');
    }
}
