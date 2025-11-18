<?php

namespace App\Http\Controllers;

use App\Models\Innovation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ReasonsController extends Controller
{
    // Step 0: Instructions page
    public function problem()
    {
        $invent = Auth::guard('invent')->user();

        if (!$invent) {
            return redirect()->route('invent')->with('error', 'Please log in first.');
        }

        return view('Invent.Inovation.Reasons', compact('invent'));
    }

    // STEP POST handler for Steps 1–3
    public function storeStep(Request $request)
{
    $invent = Auth::guard('invent')->user();
    if (!$invent) {
        return redirect()->route('invent')->with('error', 'Please log in first.');
    }

    $step = $request->input('step');
    $data = Session::get('innovation_data', []);

    switch ($step) {

        case 'step1':
            $request->validate([
                'title' => 'required|string|max:255',
                 'industry' => 'required|string',
                'content' => 'required|string',
                'securitykey' => 'required|string',
            ]);

            $data['step1'] = $request->only(['title', 'content', 'industry','securitykey']);
            Session::put('innovation_data', $data);

            return redirect()->route('innovation.step2')
                ->with('success', 'Step 1 saved. Proceed to Step 2.');

        case 'step2':
            $request->validate([
                'innovation_type' => 'required|string|max:255',
                'link' => 'nullable|url|max:255',
                'attachment' => 'nullable|file|max:5120',
            ]);

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $folder = public_path('storage/attachments');
                if (!File::exists($folder)) File::makeDirectory($folder, 0755, true);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($folder, $filename);
                $data['step2']['attachment'] = 'storage/attachments/' . $filename;
            }

            $data['step2']['innovation_type'] = $request->innovation_type;
            $data['step2']['link'] = $request->link;
            Session::put('innovation_data', $data);

            return redirect()->route('innovation.step3')
                ->with('success', 'Step 2 saved. Proceed to Step 3.');

        case 'step3':
            $request->validate([
                'evidence' => 'required|file|max:10240',
            ]);

            if ($request->hasFile('evidence')) {
                $file = $request->file('evidence');
                $folder = public_path('storage/evidence');
                if (!File::exists($folder)) File::makeDirectory($folder, 0755, true);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($folder, $filename);
                $data['step3']['evidence'] = 'storage/evidence/' . $filename;
            }

            Session::put('innovation_data', $data);

            return redirect()->route('innovation.step4')
                ->with('success', 'Step 3 saved. Proceed to review.');

        default:
            return back()->with('error', 'Invalid step submitted.');
    }
}
public function submitAll()
{
    $invent = Auth::guard('invent')->user();
    if (!$invent) {
        return redirect()->route('invent')->with('error', 'Please log in first.');
    }

    $data = Session::get('innovation_data', []);
    if (empty($data['step1']) || empty($data['step2']) || empty($data['step3'])) {
        return redirect()->route('innovation.step1')->with('error', 'Please complete all steps before submitting.');
    }

    // Generate unique innovation number
    do {
        $innovationNumber = strtoupper('INOV-' . Str::random(8));
    } while (Innovation::where('innovation_number', $innovationNumber)->exists());

    // Save to DB (invent_id nullable)
    $innovation = Innovation::create([
        'securitykey'      => $data['step1']['securitykey'],
        'title'            => $data['step1']['title'],
        'industry'         => $data['step1']['industry'],
        'content'          => $data['step1']['content'],
        'innovation_number'=> $innovationNumber,
        'innovation_type'  => $data['step2']['innovation_type'] ?? null,
        'attachment'       => $data['step2']['attachment'] ?? null,
        'link'             => $data['step2']['link'] ?? null,
        'evidence'         => $data['step3']['evidence'] ?? null,
         'status'           => 'Applied', 
    ]);

    // Generate PDF report directly in public/reports
    $folder = public_path('storage/reports');
    if (!File::exists($folder)) File::makeDirectory($folder, 0755, true);
    $pdf = PDF::loadView('Invent.Inovation.Report', compact('innovation'));
    $pdfFileName = 'Innovation_Report_' . $innovationNumber . '.pdf';
    $pdfPath = 'storage/reports/' . $pdfFileName;
    $pdf->save(public_path($pdfPath));

    $innovation->update(['report_pdf' => $pdfPath]);

    // Clear session
    Session::forget('innovation_data');

    return redirect()->route('innovation.my')
        ->with('success', 'Innovation submitted successfully! PDF report generated.');
}
    // STEP 4: Review & Final submit
    public function step4()
    {
        $invent = Auth::guard('invent')->user();
        if (!$invent) {
            return redirect()->route('invent')->with('error', 'Please log in first.');
        }

        $data = Session::get('innovation_data', []);
        if (empty($data)) {
            return redirect()->route('innovation.problem')->with('error', 'Please start the submission process first.');
        }

        // Pass all session data to review page
        return view('Invent.Inovation.step4_review', compact('invent', 'data'));
    }

    // Final submit: save all to DB + generate PDF
   

    // STEP 1 view
    public function step1()
    {
        $invent = Auth::guard('invent')->user();
        return view('Invent.Inovation.step1_problem', compact('invent'));
    }

    // STEP 2 view
    public function step2()
    {
        $invent = Auth::guard('invent')->user();
        return view('Invent.Inovation.step2_innovation', compact('invent'));
    }

    // STEP 3 view
    public function step3()
    {
        $invent = Auth::guard('invent')->user();
        return view('Invent.Inovation.step3_evidence', compact('invent'));
    }

    // STEP 4 view (review)
    public function step4Review()
    {
        $invent = Auth::guard('invent')->user();
        $data = Session::get('innovation_data', []);

        if (empty($data)) {
            return redirect()->route('innovation.problem')->with('error', 'Please start the submission process first.');
        }

        return view('Invent.Inovation.step4_review', compact('invent', 'data'));
    }
    public function myInnovations()
{
    $invent = Auth::guard('invent')->user();

    if (!$invent) {
        return redirect()->route('invent')->with('error', 'Please log in first.');
    }

    // Fetch all innovations for this user based on their securitykey
    $innovations = Innovation::where('securitykey', $invent->securitykey)
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('Invent.Inovation.my_innovations', compact('innovations', 'invent'));
}

//oter fuctions
 public function edit($id)
    {
        $invent = Auth::guard('invent')->user();
        $innovation = Innovation::where('id', $id)
            ->where('securitykey', $invent->securitykey)
            ->firstOrFail();

        return view('Invent.Inovation.edit_innovation', compact('innovation'));
    }

    // UPDATE INNOVATION
  public function update(Request $request, $id)
{
    $invent = Auth::guard('invent')->user();

    // Find innovation by ID and security key
    $innovation = Innovation::where('id', $id)
        ->where('securitykey', $invent->securitykey)
        ->firstOrFail();

    // Validate request
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'innovation_type' => 'required|string|max:255',
        'link' => 'nullable|url|max:255',
        'attachment' => 'nullable|file|max:5120',
        'evidence' => 'nullable|file|max:10240',
    ]);

    $innovation->title = $request->title;
    $innovation->content = $request->content;
    $innovation->innovation_type = $request->innovation_type;
    $innovation->link = $request->link;

    // Handle attachment
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $folder = public_path('storage/attachments');
        if (!File::exists($folder)) File::makeDirectory($folder, 0755, true);
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($folder, $filename);
        $innovation->attachment = 'storage/attachments/' . $filename;
    }

    // Handle evidence
    if ($request->hasFile('evidence')) {
        $file = $request->file('evidence');
        $folder = public_path('storage/evidence');
        if (!File::exists($folder)) File::makeDirectory($folder, 0755, true);
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($folder, $filename);
        $innovation->evidence = 'storage/evidence/' . $filename;
    }

    $innovation->save();

    // Generate new PDF report
    $reportsFolder = public_path('storage/reports');
    if (!File::exists($reportsFolder)) File::makeDirectory($reportsFolder, 0755, true);

    $pdf = PDF::loadView('Invent.Inovation.Report', compact('innovation'));
    $pdfFileName = 'Innovation_Report_' . $innovation->innovation_number . '.pdf';
    $pdfPath = 'storage/reports/' . $pdfFileName;
    $pdf->save(public_path($pdfPath));

    $innovation->report_pdf = $pdfPath;
    $innovation->save();

    return redirect()->route('innovation.my')
        ->with('success', 'Innovation updated successfully! PDF report regenerated.');
}


    // DELETE INNOVATION
    public function destroy($id)
    {
        $invent = Auth::guard('invent')->user();
        $innovation = Innovation::where('id', $id)
            ->where('securitykey', $invent->securitykey)
            ->firstOrFail();

        // Delete files from storage
        if ($innovation->attachment && Storage::disk('public')->exists($innovation->attachment)) {
            Storage::disk('public')->delete($innovation->attachment);
        }
        if ($innovation->evidence && Storage::disk('public')->exists($innovation->evidence)) {
            Storage::disk('public')->delete($innovation->evidence);
        }
        if ($innovation->report_pdf && Storage::disk('public')->exists($innovation->report_pdf)) {
            Storage::disk('public')->delete($innovation->report_pdf);
        }

        $innovation->delete();

        return redirect()->route('innovation.my')
            ->with('success', 'Innovation deleted successfully.');
    }

}
