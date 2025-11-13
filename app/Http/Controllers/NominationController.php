<?php

namespace App\Http\Controllers;

use App\Models\Nomination;
use Illuminate\Http\Request;

class NominationController extends Controller
{
    //
    public function submitstore(Request $request)
    {
        // ✅ Validate the form input
        $validated = $request->validate([
            'country' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'subcounty' => 'required|string|max:255',
            'nominee_name' => 'required|string|max:255',
            'work_station' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'duties' => 'required|string',
            'outstanding_behavior' => 'required|string',
            'justification' => 'required|string',
            'lessons' => 'required|string',
            'attachment' => 'nullable|file|max:5120', // up to 5MB
            'confirmation' => 'accepted'
        ]);

        // ✅ Handle file upload (if any)
        $filePath = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Save in "public/CHDRT"
            $filePath = $file->storeAs('CHDRT', $fileName, 'public');
        }

        // ✅ Get client IP address
        $ipAddress = $request->ip();

        // ✅ Save the data
        $nomination = new Nomination();
        $nomination->country = $validated['country'];
        $nomination->county = $validated['county'];
        $nomination->subcounty = $validated['subcounty'];
        $nomination->nominee_name = $validated['nominee_name'];
        $nomination->work_station = $validated['work_station'];
        $nomination->designation = $validated['designation'];
        $nomination->duties = $validated['duties'];
        $nomination->outstanding_behavior = $validated['outstanding_behavior'];
        $nomination->justification = $validated['justification'];
        $nomination->lessons = $validated['lessons'];
        $nomination->attachment_path = $filePath;
        $nomination->ip_address = $ipAddress;
        $nomination->save();

        return redirect()->back()->with('success', 'Nomination submitted successfully!');
    }
}
