<?php

namespace App\Services;

use App\Models\AIChart;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected $apiKey;
    protected $baseUrl;
    protected $model;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->baseUrl = env('OPENAI_API_URL', 'https://api.openai.com/v1');
        $this->model = env('OPENAI_MODEL', 'gpt-4o-mini');
    }

    /**
     * Send charting question to AI and save response
     */
    public function askChart(string $ip, string $question)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}/chat/completions", [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant providing charting and visualization insights.'],
                    ['role' => 'user', 'content' => $question],
                ],
                'temperature' => 0.7,
            ]);

            $aiResponse = $response->successful()
                ? $response->json()['choices'][0]['message']['content'] ?? 'No response received.'
                : 'Error contacting AI service.';

            AIChart::create([
                'ip_address' => $ip,
                'question' => $question,
                'response' => $aiResponse,
            ]);

            return $aiResponse;
        } catch (\Exception $e) {
            Log::error('OpenAIService Exception: ' . $e->getMessage());
            return 'Error processing AI request.';
        }
    }

    /**
     * Retrieve AI chart conversation history
     */
    public function getChartHistory(string $ip)
    {
        return AIChart::where('ip_address', $ip)->orderBy('created_at', 'desc')->get();
    }
}
