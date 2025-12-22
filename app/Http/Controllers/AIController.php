<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use App\Models\JOB;
use App\Models\EXTJOB;
use App\Models\JOBExt;

class AIController extends Controller
{
    protected OpenAIService $aiService;

    /**
     * Inject the OpenAIService
     */
    public function __construct(OpenAIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Display the AI charting interface with previous messages
     */
    public function index(Request $request)
    {
        $ip = $request->ip();
        $history = $this->aiService->getChartHistory($ip);

        return view('ai.chat', compact('history'));
    }

    /**
     * Handle AJAX request to generate a new AI chart
     */
    public function generate(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:2000',
        ]);

        $ip = $request->ip();
        $userQuestion = $request->input('question');

        // Build the initial AI prompt
        $prompt = "Welcome to KSG Career Portal Assistant!\n";
        $prompt .= "Hello! I am your Career Portal Assistant. Please tell me which type of advertised jobs you want to know about:\n";
        $prompt .= "1. Internal\n2. External\n3. Adjunct\n\n";
        $prompt .= "User asked: {$userQuestion}\n\n";

        // Determine user choice
        $choice = strtolower(trim($userQuestion));

        $jobData = [];
        $links = [];

        if (strpos($choice, 'internal') !== false || $choice === '1') {
            $jobData = JOB::all()->toArray();
            $links['internal'] = route('HR.Login');
        } elseif (strpos($choice, 'external') !== false || $choice === '2') {
            $jobData = EXTJOB::all()->toArray();
            $links['external'] = route('EXT.Register');
        } elseif (strpos($choice, 'adjunct') !== false || $choice === '3') {
            $jobData = JOBExt::all()->toArray();
            $links['adjunct'] = route('HRPU.Login');
        } else {
            $prompt .= "Please specify 1 for Internal, 2 for External, or 3 for Adjunct jobs.\n";
        }

        // Append job data to the prompt
        if (!empty($jobData)) {
            $prompt .= "Here are the available jobs:\n";
            foreach ($jobData as $job) {
                $designation = $job['Designation'] ?? $job['Specialization'] ?? 'N/A';
                $positions = $job['Proposed_No_of_Positions'] ?? 'N/A';
                $deadline = $job['deadline'] ?? 'N/A';
                $prompt .= "- Designation: {$designation}, Positions: {$positions}, Deadline: {$deadline}\n";
            }

            $prompt .= "\nYou can apply through these links:\n";
            foreach ($links as $type => $link) {
                $prompt .= ucfirst($type) . " Application: {$link}\n";
            }
        }

        // Send prompt to OpenAIService and save
        $aiResponse = $this->aiService->askChart($ip, $prompt);

        return response()->json([
            'success' => true,
            'ai_response' => $aiResponse
        ]);
    }

    /**
     * Retrieve AI chart conversation history as JSON
     */
    public function history(Request $request)
    {
        $ip = $request->ip();
        $history = $this->aiService->getChartHistory($ip);

        return response()->json([
            'success' => true,
            'history' => $history
        ]);
    }
}
