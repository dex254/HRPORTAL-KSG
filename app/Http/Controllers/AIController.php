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
    $userQuestion = strtolower(trim($request->input('question')));

    // Special response if user asks who developed the assistant
    if (strpos($userQuestion, 'who developed') !== false || strpos($userQuestion, 'developer') !== false) {
        return response()->json([
            'success' => true,
            'ai_response' => "This AI Job Assistant was developed by Denis Kiplagat, KSG Developer."
        ]);
    }

    // Base AI prompt
    $prompt = "Welcome to the KSG Career Portal Assistant.\n\n";
    $prompt .= "I provide guidance on how to apply for jobs at KSG.\n\n";

    // Internal Staff Instructions
    if (strpos($userQuestion, 'internal') !== false || $userQuestion === '1') {

        $prompt .= "INTERNAL STAFF APPLICATION INSTRUCTIONS:\n";
        $prompt .= "1. Internal staff must apply using their Unified Payroll Number (UPN).\n";
        $prompt .= "2. Enter your UPN number on the Internal Staff login page.\n";
        $prompt .= "3. If you experience any difficulty, kindly contact the KSG HR Team for assistance.\n";
        $prompt .= "4. After entering your UPN, an OTP will be sent to your registered contact details.\n";
        $prompt .= "5. Enter the OTP to verify your identity.\n";
        $prompt .= "6. You will receive an email verification link — please check your email and verify every login.\n";
        $prompt .= "7. Once logged in, update your profile fully before applying for any job.\n";
        $prompt .= "8. Review the Career Guide carefully to understand the requirements for each advertised job.\n\n";
        $prompt .= "⚠️ Reminder: The AI assistant cannot submit applications for you. You must log in and provide all required information.\n\n";
        $prompt .= "Internal Application Portal: " . route('HR.Login') . "\n";

    }
    // External Applicant Instructions
    elseif (strpos($userQuestion, 'external') !== false || $userQuestion === '2') {

        $prompt .= "EXTERNAL APPLICANT INSTRUCTIONS:\n";
        $prompt .= "1. External applicants must first register on the portal.\n";
        $prompt .= "2. Use a valid email address during registration.\n";
        $prompt .= "3. A system-generated password will be sent to your email.\n";
        $prompt .= "4. Log in using the provided credentials.\n";
        $prompt .= "5. IMPORTANT: Update your profile completely before starting any job application.\n";
        $prompt .= "6. Carefully read the job requirements to ensure you meet the minimum qualifications before applying.\n\n";
        $prompt .= "⚠️ Reminder: The AI assistant cannot submit applications for you. You must log in and provide all required information.\n\n";
        $prompt .= "External Application Portal: " . route('EXT.Register') . "\n";

    }
    // Invalid or unspecified option
    else {
        $prompt .= "Please specify the type of job application you want guidance on:\n";
        $prompt .= "1. Internal Staff\n";
        $prompt .= "2. External Applicant\n";
    }

    // Send prompt to AI service
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
