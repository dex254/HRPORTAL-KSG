<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AI Job Charting Assistant</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f4f7f6; 
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        
        #chat-box { 
            width: 100%;
            max-width: 800px;
            margin: 30px auto; 
            padding: 25px; 
            background: white; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        h3 {
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eaeaea;
            font-weight: 600;
        }
        
        #messages { 
            height: 450px; 
            overflow-y: auto; 
            margin-bottom: 25px; 
            padding: 15px;
            background: #fafafa;
            border-radius: 12px;
            border: 1px solid #eee;
            display: flex; 
            flex-direction: column;
            gap: 12px;
        }
        
        .msg { 
            margin: 0;
            padding: 14px 18px; 
            border-radius: 14px; 
            max-width: 85%; 
            line-height: 1.5; 
            word-wrap: break-word;
            font-size: 0.95rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .user-msg { 
            background: linear-gradient(135deg, #007bff, #0056cc); 
            color: white; 
            align-self: flex-end; 
            border-bottom-right-radius: 4px;
        }
        
        .bot-msg { 
            background: white; 
            color: #333; 
            align-self: flex-start; 
            border-bottom-left-radius: 4px;
            border: 1px solid #e8e8e8;
        }
        
        /* Enhanced response styling */
        .bot-msg h4 {
            color: #2c3e50;
            margin: 0 0 10px 0;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .bot-msg ul, .bot-msg ol {
            margin: 8px 0;
            padding-left: 20px;
        }
        
        .bot-msg li {
            margin-bottom: 6px;
            padding-left: 5px;
        }
        
        .bot-msg strong {
            color: #2c3e50;
            font-weight: 600;
        }
        
        .bot-msg .job-highlight {
            background: #e8f4ff;
            padding: 12px 15px;
            border-radius: 8px;
            margin: 10px 0;
            border-left: 4px solid #007bff;
        }
        
        .bot-msg .job-list {
            margin: 15px 0;
        }
        
        .bot-msg .job-item {
            padding: 10px 15px;
            margin: 8px 0;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 3px solid #28a745;
        }
        
        .bot-msg .stat-box {
            display: inline-block;
            background: #f8f9fa;
            padding: 8px 12px;
            margin: 5px 10px 5px 0;
            border-radius: 6px;
            font-size: 0.9rem;
            border: 1px solid #dee2e6;
        }
        
        .typing { 
            font-style: italic; 
            color: #6c757d; 
            font-size: 0.85rem;
            padding: 10px 15px;
            align-self: flex-start;
        }
        
        .input-area {
            display: flex; 
            gap: 12px;
            align-items: flex-end;
        }
        
        textarea { 
            resize: none; 
            flex-grow: 1; 
            height: 65px; 
            border-radius: 10px; 
            border: 1px solid #ddd; 
            padding: 12px 15px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: border-color 0.3s;
            line-height: 1.4;
        }
        
        textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        }
        
        button { 
            padding: 0 25px; 
            height: 65px;
            background: linear-gradient(135deg, #007bff, #0056cc); 
            color: white; 
            border: none; 
            border-radius: 10px; 
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s;
            white-space: nowrap;
        }
        
        button:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(0,123,255,0.2);
        }
        
        button:active:not(:disabled) {
            transform: translateY(0);
        }
        
        button:disabled {
            background: #cccccc;
            cursor: not-allowed;
        }
        
        /* Scrollbar styling */
        #messages::-webkit-scrollbar {
            width: 8px;
        }
        
        #messages::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        #messages::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        #messages::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Timestamp for messages (optional) */
        .timestamp {
            font-size: 0.75rem;
            opacity: 0.6;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
<div id="chat-box">
    <h3>🤖 AI Job Charting Assistant</h3>

    <div id="messages">
        @foreach($history as $record)
            @if($record->question)
                <div class="msg user-msg">{{ $record->question }}</div>
            @endif
            @if($record->response)
                <div class="msg bot-msg">{{ $record->response }}</div>
            @endif
        @endforeach
    </div>

    <div class="input-area">
        <textarea id="message" placeholder="Ask about advertised jobs, e.g., 'What marketing roles are available?' or 'List remote software jobs...'"></textarea>
        <button onclick="sendMessage()" id="send-btn">Send</button>
    </div>
</div>

<script>
function sendMessage() {
    const input = document.getElementById('message');
    const text = input.value.trim();
    const btn = document.getElementById('send-btn');
    const messages = document.getElementById('messages');

    if (!text) return;

    // Display user's message immediately
    messages.innerHTML += `<div class="msg user-msg">${escapeHtml(text)}</div>`;
    messages.innerHTML += `<div id="typing-indicator" class="typing">🔍 AI is analyzing advertised jobs...</div>`;
    input.value = '';
    messages.scrollTop = messages.scrollHeight;
    btn.disabled = true;
    btn.textContent = 'Processing...';

    fetch("{{ route('ai.generate') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ question: text })
    })
    .then(res => res.json())
    .then(data => {
        const typing = document.getElementById('typing-indicator');
        if (typing) typing.remove();

        if(data.success && data.ai_response) {
            const formattedResponse = formatAIResponse(data.ai_response);
            messages.innerHTML += `<div class="msg bot-msg">${formattedResponse}</div>`;
        } else {
            messages.innerHTML += `<div class="msg bot-msg" style="color:#dc3545;">⚠️ Error: ${data.ai_response || 'Unable to process request'}</div>`;
        }
        messages.scrollTop = messages.scrollHeight;
        btn.disabled = false;
        btn.textContent = 'Send';
    })
    .catch(err => {
        console.error(err);
        const typing = document.getElementById('typing-indicator');
        if (typing) typing.remove();
        messages.innerHTML += `<div class="msg bot-msg" style="color:#dc3545;">⚠️ Network error. Please try again.</div>`;
        messages.scrollTop = messages.scrollHeight;
        btn.disabled = false;
        btn.textContent = 'Send';
    });
}

// Helper function to escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Function to format AI responses for better readability
function formatAIResponse(text) {
    let formatted = escapeHtml(text);
    
    // Add job list formatting
    formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
    
    // Format bullet points
    formatted = formatted.replace(/^\s*[\-•]\s+(.+)$/gm, '<li>$1</li>');
    formatted = formatted.replace(/(<li>.*<\/li>\n?)+/g, '<ul class="job-list">$&</ul>');
    
    // Format numbered lists
    formatted = formatted.replace(/^\s*(\d+)\.\s+(.+)$/gm, '<li>$2</li>');
    formatted = formatted.replace(/(<li>.*<\/li>\n?){2,}/g, '<ol class="job-list">$&</ol>');
    
    // Format job titles (assuming they're in quotes or have specific patterns)
    formatted = formatted.replace(/"([^"]+)"(?:\s*-\s*)/g, '<div class="job-item"><strong>$1</strong> - ');
    formatted = formatted.replace(/Salary:\s*(\$[\d,]+(\s*-\s*\$[\d,]+)?)/gi, '<br><strong>Salary:</strong> <span class="stat-box">$1</span>');
    formatted = formatted.replace(/Location:\s*([^\n<]+)/gi, '<br><strong>Location:</strong> <span class="stat-box">$1</span>');
    formatted = formatted.replace(/Type:\s*([^\n<]+)/gi, '<br><strong>Type:</strong> <span class="stat-box">$1</span>');
    
    // Format sections with headings
    formatted = formatted.replace(/^(Available Jobs:|Summary:|Recommendations:|Analysis:)/gmi, '<h4>$1</h4>');
    
    // Format statistics or numbers
    formatted = formatted.replace(/(\d+)\s+(jobs?|positions?|roles?)/gi, '<span class="stat-box">$1 $2</span>');
    
    // Close job items
    formatted = formatted.replace(/<\/span><br>/g, '</span></div>');
    
    return formatted;
}

// Send on Enter key (without Shift)
document.getElementById('message').addEventListener('keypress', function(e) {
    if(e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

// Auto-resize textarea
document.getElementById('message').addEventListener('input', function() {
    this.style.height = '65px';
    this.style.height = Math.min(this.scrollHeight, 150) + 'px';
});

// Focus textarea on load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('message').focus();
});
</script>
</body>
</html>