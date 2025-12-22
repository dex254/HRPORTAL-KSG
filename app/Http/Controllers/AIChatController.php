<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AIChatService;
use App\Models\AiUser;
use App\Models\AiMessage;

class AIChatController extends Controller
{
    protected AIChatService $ai;

    /**
     * Inject the AIChatService
     */
    public function __construct(AIChatService $ai)
    {
        $this->ai = $ai;
    }

    /**
     * Show chat interface with previous messages
     */
    public function index(Request $request)
    {
        // Identify guest by IP
        $ip = $request->ip();
        $user = $this->ai->getOrCreateGuest($ip);

        // Load previous conversation for this guest
        $messages = AiMessage::where('ai_user_id', $user->id)
                             ->orderBy('created_at', 'asc')
                             ->get();

        return view('ai.chat', compact('messages'));
    }

    /**
     * Handle AJAX request to send message to AI
     */
    public function send(Request $request)
    {
        // Validate incoming message
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $ip = $request->ip();
        $user = $this->ai->getOrCreateGuest($ip);

        // Send question to AI and get response
        $reply = $this->ai->chat($user, $request->message);

        // Return JSON response
        return response()->json([
            'success' => true,
            'reply' => $reply
        ]);
    }
}
