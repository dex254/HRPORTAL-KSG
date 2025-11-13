<?php

namespace App\Http\Controllers;

use App\Models\Innovation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ReasonsController extends Controller
{
    //
    public function problem()
    {
        // ✅ Ensure the agent (invent) is authenticated
        $invent = Auth::guard('invent')->user();

        if (!$invent) {
            return redirect()->route('invent')->with('error', 'Please log in first.');
        }

        // ✅ Return the form view
        return view('Invent.Inovation.Reasons', compact('invent'));
    }
    public function storeStep(Request $request)
    {
        $step = $request->input('step');
        $data = Session::get('innovation_data', []);

        switch ($step) {
            case 'step1':
                $request->validate([
                    'title' => 'required|string|max:255',
                    'content' => 'required|string',
                    'securitykey' => 'required|string',
                ]);
                $data['step1'] = $request->only(['title', 'content', 'securitykey']);
                break;

            case 'step2':
                $request->validate([
                    'innovation_type' => 'required|string|max:255',
                    'link' => 'nullable|url|max:255',
                    'attachment' => 'nullable|file|max:5120',
                ]);
                if ($request->hasFile('attachment')) {
                    $data['step2']['attachment'] = $request->file('attachment')->store('attachments', 'public');
                }
                $data['step2']['innovation_type'] = $request->innovation_type;
                $data['step2']['link'] = $request->link;
                break;

            case 'step3':
                $request->validate([
                    'evidence' => 'required|file|max:10240',
                ]);
                $data['step3']['evidence'] = $request->file('evidence')->store('evidence', 'public');
                break;

            default:
                return back()->with('error', 'Invalid step submitted.');
        }

        Session::put('innovation_data', $data);

        return back()->with('success', 'Step saved successfully! Proceed to next step.');
    }

    // Final submit: save to DB and generate PDF
    public function submitAll()
    {
        $invent = Auth::guard('invent')->user();
        if (!$invent) {
            return redirect()->route('invent')->with('error', 'Please log in first.');
        }

        $data = Session::get('innovation_data', []);
        if (empty($data['step1']) || empty($data['step2']) || empty($data['step3'])) {
            return back()->with('error', 'Please complete all steps before submitting.');
        }

        do {
            $innovationNumber = strtoupper('INOV-' . Str::random(8));
        } while (Innovation::where('innovation_number', $innovationNumber)->exists());

        // Save record
        $innovation = Innovation::create([
            'invent_id'        => $invent->id,
            'securitykey'      => $data['step1']['securitykey'],
            'title'            => $data['step1']['title'],
            'content'          => $data['step1']['content'],
            'innovation_number'=> $innovationNumber,
            'innovation_type'  => $data['step2']['innovation_type'],
            'attachment'       => $data['step2']['attachment'] ?? null,
            'link'             => $data['step2']['link'] ?? null,
            'evidence'         => $data['step3']['evidence'] ?? null,
        ]);

        // Generate PDF
        $pdf = PDF::loadView('Invent.Inovation.Report', compact('innovation'));
        $pdfFileName = 'Innovation_Report_' . $innovationNumber . '.pdf';
        $pdfPath = 'reports/' . $pdfFileName;
        Storage::disk('public')->put($pdfPath, $pdf->output());

        $innovation->update(['report_pdf' => $pdfPath]);

        // Clear session
        Session::forget('innovation_data');

        return redirect()->route('innovation.list')
            ->with('success', 'Innovation submitted successfully! PDF report generated.');
    }

}
