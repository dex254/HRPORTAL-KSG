<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KSG - Career & AI Job Assistant</title>
 <link rel="icon" href="{{ asset('assets/images/KSG Logo (1).png') }}" type="image/png">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
<style>
:root {
    --primary-yellow: #c5c538;
    --dark-brown: #5D4037;
    --light-brown: #D2B48C;
    --white: #fff;
    --off-white: #f5f5f5;
    --dark-gray: #333;
    --btn-hover-dark: #444;
    --ai-blue: #007bff;
    --ai-blue-dark: #0056cc;
}

/* Reset */
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Roboto', sans-serif; background:var(--off-white); color:var(--dark-gray); line-height:1.6; }

/* Header */
header {
    background: linear-gradient(135deg, var(--primary-yellow), var(--dark-brown));
    color: var(--white);
    padding: 2rem 0;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.logo { display:flex; justify-content:center; align-items:center; margin-bottom:1rem; flex-wrap:wrap; }
.logo img { height:80px; margin-right:15px; }
.logo-text h1 { font-family:'Playfair Display', serif; font-size:2.5rem; text-shadow:2px 2px 4px rgba(0,0,0,0.3); }
.logo-text p { font-size:1.1rem; opacity:0.9; }

/* Hero Section */
.hero {
    background: url('https://via.placeholder.com/1400x500') center/cover no-repeat;
    position: relative;
    height: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: var(--white);
}
.hero::before {
    content:'';
    position:absolute;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.5);
}
.hero-content { position:relative; z-index:1; max-width:900px; padding:0 20px; }
.hero-content h2 { font-family:'Playfair Display', serif; font-size:3rem; margin-bottom:1rem; text-shadow:2px 2px 6px rgba(0,0,0,0.5); }
.hero-content p { font-size:1.2rem; margin-bottom:2rem; text-shadow:1px 1px 3px rgba(0,0,0,0.5); }

/* CTA Buttons */
.cta-buttons { display:flex; justify-content:center; gap:2rem; flex-wrap:wrap; }
.btn {
    padding:15px 40px;
    border-radius:50px;
    font-weight:600;
    font-size:1.1rem;
    text-decoration:none;
    transition:all 0.3s ease;
    cursor:pointer;
}
.btn-internal { background: var(--primary-yellow); color: var(--dark-gray); border:2px solid transparent; }
.btn-internal:hover { background:transparent; border-color:var(--primary-yellow); color:var(--white); transform:translateY(-3px); box-shadow:0 10px 20px rgba(0,0,0,0.2); }
.btn-external { background: var(--light-brown); color: var(--dark-gray); border:2px solid transparent; }
.btn-external:hover { background:transparent; border-color:var(--light-brown); color:var(--white); transform:translateY(-3px); box-shadow:0 10px 20px rgba(0,0,0,0.2); }

/* Chat Section */
.chat-section { padding:5rem 20px; display:flex; justify-content:center; }
#chat-box {
    width:100%; max-width:800px;
    background:white; border-radius:20px; padding:30px;
    box-shadow:0 20px 50px rgba(0,0,0,0.2);
    display:flex; flex-direction:column;
}
#chat-box h3 { text-align:center; margin-bottom:25px; font-weight:600; color:var(--dark-brown); font-size:1.7rem; }
#messages { height:450px; overflow-y:auto; margin-bottom:25px; padding:20px; background:#f8f9fa; border-radius:15px; border:1px solid #eee; display:flex; flex-direction:column; gap:12px; }
.msg { padding:14px 18px; border-radius:14px; max-width:85%; line-height:1.5; word-wrap:break-word; font-size:0.95rem; box-shadow:0 2px 5px rgba(0,0,0,0.05); transition:transform 0.15s ease; }
.user-msg { background:linear-gradient(135deg, var(--ai-blue), var(--ai-blue-dark)); color:white; align-self:flex-end; border-bottom-right-radius:4px; }
.user-msg:hover { transform:scale(1.02); }
.bot-msg { background:white; color:#333; align-self:flex-start; border-bottom-left-radius:4px; border-left:4px solid var(--ai-blue); padding:15px; }
.typing { font-style:italic; color:#6c757d; font-size:0.85rem; padding:10px 15px; align-self:flex-start; }
.input-area { display:flex; gap:12px; align-items:flex-end; }
textarea { flex-grow:1; height:65px; padding:12px 15px; border-radius:15px; border:1px solid #ddd; font-size:0.95rem; font-family:inherit; line-height:1.4; resize:none; transition:border-color 0.3s, box-shadow 0.3s; }
textarea:focus { outline:none; border-color:var(--ai-blue); box-shadow:0 0 10px rgba(0,123,255,0.2); }
button.send-btn { height:65px; padding:0 25px; background:linear-gradient(135deg, var(--ai-blue), var(--ai-blue-dark)); color:white; font-weight:600; font-size:1rem; border:none; border-radius:15px; cursor:pointer; transition:all 0.2s; }
button.send-btn:hover:not(:disabled) { transform:translateY(-2px); box-shadow:0 8px 25px rgba(0,123,255,0.25); }

/* Footer */
footer { background: linear-gradient(135deg, var(--dark-brown), #000); color: var(--white); padding:2rem 0; text-align:center; }
footer p, footer a { color:#F5F5F5; text-decoration:none; margin-bottom:0.5rem; display:block; }
footer a:hover { color:var(--primary-yellow); }

/* Scrollbar */
#messages::-webkit-scrollbar { width: 8px; }
#messages::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
#messages::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
#messages::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }

@media(max-width:768px) {
    .cta-buttons { flex-direction:column; gap:1rem; }
    .hero-content h2 { font-size:2rem; }
    .hero-content p { font-size:1rem; }
    textarea, button.send-btn { height:55px; }
}
</style>
</head>
<body>

<!-- Header -->
<header>
    <div class="logo">
        <img src="{{ asset('') }}assets/images/KSG Logo (1).png" alt="KSG Logo">
        <div class="logo-text">
            <h1>Kenya School of Government</h1>
            <p>Enhancing Public Service Through Learning and Development</p>
        </div>
    </div>
</header>

<!-- Hero Section -->


<!-- Chat Section -->
<section class="chat-section">
    <div id="chat-box">
 <div class="chat-header">
            <h3>KSG Career Opportunities Assistant</h3>
            <button id="clear-chat-btn" class="clear-btn">Clear Chat</button>
        </div>
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
            <textarea id="message" placeholder="Ask about advertised jobs, e.g., 'What marketing roles are available?'"></textarea>
            <button class="send-btn" onclick="sendMessage()" id="send-btn">Send</button>
        </div>
    </div>
</section>

<style>
/* ==== Chat Section Styling ==== */
.chat-section {
    padding: 4rem 20px;
    display: flex;
    justify-content: center;
    background: linear-gradient(to bottom, #f0f5f0, #e6f1e6); /* soft green gradient */
}

#chat-box {
    width: 100%;
    max-width: 800px;
    background: #fff8f0; /* light brown background */
    border-radius: 25px;
    padding: 30px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
}

#chat-box h3 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
    color: #4b3e2a; /* deep brown */
    font-size: 1.8rem;
}

#messages {
    height: 450px;
    overflow-y: auto;
    margin-bottom: 25px;
    padding: 20px;
    background: #f5f5f0; /* lighter brown for messages */
    border-radius: 15px;
    border: 1px solid #dcd6c9;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

/* Messages */
.msg {
    padding: 14px 18px;
    border-radius: 18px;
    max-width: 85%;
    line-height: 1.5;
    word-wrap: break-word;
    font-size: 0.95rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: transform 0.15s ease;
}

.user-msg {
    background: linear-gradient(135deg, #6a8f3b, #4b7030); /* green gradient */
    color: #fff;
    align-self: flex-end;
    border-bottom-right-radius: 4px;
}

.user-msg:hover {
    transform: scale(1.02);
}

.bot-msg {
    background: #fff3e0; /* soft light brown */
    color: #4b3e2a; /* dark brown text */
    align-self: flex-start;
    border-left: 4px solid #6a8f3b; /* green accent line */
    padding: 15px;
}

.typing {
    font-style: italic;
    color: #6c757d;
    font-size: 0.85rem;
    padding: 10px 15px;
    align-self: flex-start;
}

/* Input Area */
.input-area {
    display: flex;
    gap: 12px;
    align-items: flex-end;
}

textarea {
    flex-grow: 1;
    height: 65px;
    padding: 12px 15px;
    border-radius: 15px;
    border: 1px solid #dcd6c9;
    font-size: 0.95rem;
    font-family: inherit;
    line-height: 1.4;
    resize: none;
    transition: border-color 0.3s, box-shadow 0.3s;
}

textarea:focus {
    outline: none;
    border-color: #6a8f3b; /* green focus */
    box-shadow: 0 0 10px rgba(106,143,59,0.3);
}

button.send-btn {
    height: 65px;
    padding: 0 25px;
    background: linear-gradient(135deg, #6a8f3b, #4b7030); /* green gradient */
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.2s;
}

button.send-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(106,143,59,0.25);
}

/* Scrollbar Styling */
#messages::-webkit-scrollbar { width: 8px; }
#messages::-webkit-scrollbar-track { background: #f0f5f0; border-radius: 4px; }
#messages::-webkit-scrollbar-thumb { background: #a8b59a; border-radius: 4px; }
#messages::-webkit-scrollbar-thumb:hover { background: #6a8f3b; }

/* Responsive */
@media(max-width:768px) {
    #chat-box { padding: 20px; }
    #messages { height: 350px; padding: 15px; }
    textarea, button.send-btn { height: 55px; font-size:0.9rem; }
}

@media(max-width:480px) {
    #chat-box { padding: 15px; }
    #messages { height: 300px; }
}
.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

/* Clear Chat Button */
.clear-btn {
    padding: 8px 18px;
    background: #6b8e23; /* olive green */
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.clear-btn:hover {
    background: #556b2f; /* darker green on hover */
}

/* Responsive adjustment */
@media (max-width: 768px) {
    .chat-header {
        flex-direction: column;
        gap: 10px;
    }

    .clear-btn {
        width: 100%;
    }
}
</style>

<script>
// Clear chat messages on interface only
document.getElementById('clear-chat-btn').addEventListener('click', function() {
    const messages = document.getElementById('messages');
    messages.innerHTML = ''; // Clears the chat on the page
});
</script>

<section class="hero">
    <div class="hero-content">
        <h2>Join the KSG Workforce</h2>
        <p>Discover meaningful opportunities to contribute to public service excellence in Kenya. Both current staff and external applicants are welcome to apply and grow with KSG.</p>
        <div class="cta-buttons">
            <a href="{{ route('HR.Login') }}" class="btn btn-internal">Internal Staff Application</a>
            <a href="{{ route('EXT.Login') }}" class="btn btn-external">External Applicant Application</a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>P.O. Box 23030-00604, Lower Kabete, Nairobi</p>
    <p>Phone: +254 20 401 5000</p>
    <p>Email: info@ksg.ac.ke</p>
    <p>&copy; 2026 Kenya School of Government. All Rights Reserved.</p>
</footer>

<script>
function sendMessage() {
    const input = document.getElementById('message');
    const text = input.value.trim();
    const btn = document.getElementById('send-btn');
    const messages = document.getElementById('messages');
    if(!text) return;

    messages.innerHTML += `<div class="msg user-msg">${text}</div>`;
    messages.innerHTML += `<div id="typing-indicator" class="typing">🔍 AI is analyzing advertised jobs...</div>`;
    input.value=''; messages.scrollTop=messages.scrollHeight;
    btn.disabled=true; btn.textContent='Processing...';

    fetch("{{ route('ai.generate') }}", {
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body:JSON.stringify({question:text})
    })
    .then(res=>res.json())
    .then(data=>{
        const typing=document.getElementById('typing-indicator'); if(typing) typing.remove();
        if(data.success && data.ai_response){
            messages.innerHTML += `<div class="msg bot-msg">${data.ai_response}</div>`;
        } else {
            messages.innerHTML += `<div class="msg bot-msg" style="color:#dc3545;">⚠️ Error: ${data.ai_response||'Unable to process request'}</div>`;
        }
        messages.scrollTop=messages.scrollHeight;
        btn.disabled=false; btn.textContent='Send';
    })
    .catch(err=>{
        console.error(err);
        const typing=document.getElementById('typing-indicator'); if(typing) typing.remove();
        messages.innerHTML += `<div class="msg bot-msg" style="color:#dc3545;">⚠️ Network error. Please try again.</div>`;
        messages.scrollTop=messages.scrollHeight;
        btn.disabled=false; btn.textContent='Send';
    });
}

// Enter key sends message
document.getElementById('message').addEventListener('keypress', function(e){
    if(e.key==='Enter' && !e.shiftKey){ e.preventDefault(); sendMessage(); }
});

// Auto-resize textarea
document.getElementById('message').addEventListener('input', function(){
    this.style.height='65px';
    this.style.height=Math.min(this.scrollHeight,150)+'px';
});
</script>

</body>
</html>
