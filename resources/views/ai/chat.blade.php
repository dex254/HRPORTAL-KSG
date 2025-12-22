<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AI Job Charting Assistant</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f4f7f6; }
        #chat-box { width:60%; min-width:400px; margin:50px auto; padding:20px; background:white; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.1); }
        #messages { height:400px; overflow-y:auto; border-bottom:1px solid #eee; margin-bottom:20px; padding:10px; display:flex; flex-direction:column; }
        .msg { margin:8px 0; padding:12px; border-radius:12px; max-width:80%; line-height:1.4; word-wrap: break-word; }
        .user-msg { background:#007bff; color:white; align-self:flex-end; border-bottom-right-radius:2px; }
        .bot-msg { background:#f1f0f0; color:#333; align-self:flex-start; border-bottom-left-radius:2px; }
        .typing { font-style:italic; color:#888; font-size:0.8rem; }
        textarea { resize:none; }
    </style>
</head>
<body>
<div id="chat-box">
    <h3>AI Job Charting Assistant</h3>

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

    <div style="display:flex; gap:10px;">
        <textarea id="message" placeholder="Ask about advertised jobs..." style="flex-grow:1; height:60px; border-radius:8px; border:1px solid #ccc; padding:10px;"></textarea>
        <button onclick="sendMessage()" id="send-btn" style="padding:0 20px; background:#007bff; color:white; border:none; border-radius:8px; cursor:pointer;">Send</button>
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
    messages.innerHTML += `<div class="msg user-msg">${text}</div>`;
    messages.innerHTML += `<div id="typing-indicator" class="typing">AI is analyzing advertised jobs...</div>`;
    input.value = '';
    messages.scrollTop = messages.scrollHeight;
    btn.disabled = true;

    fetch("{{ route('ai.generate') }}", {
        method: "POST",
        headers: {
            "Content-Type":"application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ question: text })
    })
    .then(res => res.json())
    .then(data => {
        const typing = document.getElementById('typing-indicator');
        if (typing) typing.remove();

        if(data.success) {
            messages.innerHTML += `<div class="msg bot-msg">${data.ai_response}</div>`;
        } else {
            messages.innerHTML += `<div class="msg bot-msg" style="color:red;">Error: ${data.ai_response}</div>`;
        }
        messages.scrollTop = messages.scrollHeight;
        btn.disabled = false;
    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
    });
}

// Send on Enter key (without Shift)
document.getElementById('message').addEventListener('keypress', function(e) {
    if(e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});
</script>
</body>
</html>
