<?php

namespace App\Services;

use App\Models\AiUser;
use App\Models\AiMessage;
use App\Models\Job;
use App\Models\ExtJob;
use App\Models\JobExt;
use Illuminate\Support\Facades\Http;

class AIChatService
{
    /**
     * Get or create guest user by IP
     */
    public function getOrCreateGuest(string $ip): AiUser
    {
        return AiUser::firstOrCreate(
            ['ip_address' => $ip],
            ['unique_id' => uniqid('usr_')]
        );
    }

    /**
     * Send question to AI and store the response
     */
    public function chat(AiUser $user, string $question): string
    {
        // Save user question
        AiMessage::create([
            'ai_user_id' => $user->id,
            'question' => $question
        ]);

        // Fetch all jobs data
        $jobsData = [
            'internal_jobs' => Job::all(),
            'external_jobs' => ExtJob::all(),
            'adjunct_jobs' => JobExt::all()
        ];

        $prompt = "You are an HR assistant. Answer the user's question using the following job data:\n";
        $prompt .= json_encode($jobsData, JSON_PRETTY_PRINT) . "\nQuestion: $question";

        // Call OpenAI via HTTP
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post(env('OPENAI_API_URL') . '/chat/completions', [
            'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ]
        ]);

        $answer = $response->json()['choices'][0]['message']['content'] ?? 'Sorry, no response from AI.';

        // Save AI response
        AiMessage::create([
            'ai_user_id' => $user->id,
            'response' => $answer
        ]);

        return $answer;
    }
}
