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
            'confirmation' => 'accepted',
            'phone' => 'required|string',
        ]);
       $exists = Nomination::where('phone', $validated['phone'])
    ->where('county', $validated['county'])
    ->where('subcounty', $validated['subcounty'])
    ->where('nominee_name', $validated['nominee_name']) // must match to block
    ->exists();

if ($exists) {
    return redirect()->back()->withErrors([
        'error' => 'You have already nominated this person in the same county and subcounty.'
    ])->withInput();
}

        // ✅ Handle file upload (if any)
        if ($request->hasFile('attachment')) {
    $file = $request->file('attachment');
    $fileName = time() . '_' . $file->getClientOriginalName();

    // Ensure folder exists
    $destination = public_path('CTDRH');
    if (!file_exists($destination)) {
        mkdir($destination, 0777, true);
    }

    // Move file to public/CTDRH
    $file->move($destination, $fileName);

    // Save relative path to DB
    $filePath = 'CTDRH/' . $fileName;
}

        // ✅ Get client IP address
        $ipAddress = $request->ip();

        // ✅ Save the data
        $nomination = new Nomination();
        $nomination->country = $validated['country'];
        $nomination->county = $validated['county'];
        $nomination->subcounty = $validated['subcounty'];
        $nomination->nominee_name = $validated['nominee_name'];
        $nomination->phone = $validated['phone'];
        $nomination->work_station = $validated['work_station'];
        $nomination->designation = $validated['designation'];
        $nomination->duties = $validated['duties'];
        $nomination->outstanding_behavior = $validated['outstanding_behavior'];
        $nomination->justification = $validated['justification'];
        $nomination->lessons = $validated['lessons'];
        $nomination->attachment_path = $filePath;
        $nomination->ip_address = $ipAddress;
        $nomination->status = 'Nominated';
        $nomination->save();

        return redirect()->back()->with('success', 'Nomination submitted successfully!');
    }
}
