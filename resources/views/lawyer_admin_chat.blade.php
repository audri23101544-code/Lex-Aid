<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Chat with Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
</head>
<body class="bg-slate-100 min-h-screen text-[#002147]">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">Lawyer ↔ Admin Chat</h1>
    <nav class="flex gap-6">
        <a href="/lawyer" class="hover:text-[#FCD353]">Dashboard</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-5xl mx-auto py-10 px-6">

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold">Chat with Admin</h2>
            <p class="text-slate-600 mt-1">{{ $admin->name }} · {{ $admin->email }}</p>
        </div>

        <a href="/lawyer" class="bg-blue-800 text-white px-5 py-3 rounded font-bold hover:bg-blue-900">
            Back to Lawyer Dashboard
        </a>
    </div>

    <section class="bg-white rounded-xl shadow p-6">
        <div id="messages" class="h-[500px] overflow-y-auto border rounded-xl p-5 bg-slate-50 space-y-4 mb-5">
            @foreach($messages as $msg)
                <div class="{{ $msg->sender_id == $user->id ? 'text-right' : 'text-left' }}">
                    <div class="inline-block px-4 py-3 rounded-xl {{ $msg->sender_id == $user->id ? 'bg-[#002147] text-white' : 'bg-white border text-slate-700' }}">
                        <p>{{ $msg->message }}</p>
                        <p class="text-xs mt-1 opacity-70">{{ $msg->created_at }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <form id="chatForm" class="flex gap-3">
            <input id="messageInput" type="text" class="flex-1 border rounded-xl p-4" placeholder="Type your message..." autocomplete="off" required>
            <button type="submit" class="bg-[#002147] text-white px-8 rounded-xl font-bold hover:bg-[#003366]">
                Send
            </button>
        </form>

        <p id="chatStatus" class="text-sm text-slate-500 mt-3"></p>
    </section>
</main>

<script>
    const socket = io('http://localhost:3000');

    const adminId = {{ $adminId }};
    const lawyerId = {{ $lawyerId }};
    const senderId = {{ $user->id }};

    const messagesDiv = document.getElementById('messages');
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const chatStatus = document.getElementById('chatStatus');

    socket.on('connect', () => {
        chatStatus.innerText = 'Connected to admin-lawyer real-time chat.';
        socket.emit('joinAdminLawyerRoom', {
            admin_id: adminId,
            lawyer_id: lawyerId
        });
    });

    socket.on('disconnect', () => {
        chatStatus.innerText = 'Disconnected from real-time chat server.';
    });

    socket.on('adminLawyerChatError', (error) => {
        chatStatus.innerText = error;
    });

    socket.on('receiveAdminLawyerMessage', (msg) => {
        const wrapper = document.createElement('div');
        wrapper.className = msg.sender_id == senderId ? 'text-right' : 'text-left';

        const bubble = document.createElement('div');
        bubble.className = msg.sender_id == senderId
            ? 'inline-block px-4 py-3 rounded-xl bg-[#002147] text-white'
            : 'inline-block px-4 py-3 rounded-xl bg-white border text-slate-700';

        bubble.innerHTML = `
            <p>${escapeHtml(msg.message)}</p>
            <p class="text-xs mt-1 opacity-70">${msg.created_at}</p>
        `;

        wrapper.appendChild(bubble);
        messagesDiv.appendChild(wrapper);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });

    chatForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const message = messageInput.value.trim();

        if (!message) {
            return;
        }

        socket.emit('sendAdminLawyerMessage', {
            admin_id: adminId,
            lawyer_id: lawyerId,
            sender_id: senderId,
            message: message
        });

        messageInput.value = '';
    });

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.innerText = text;
        return div.innerHTML;
    }

    messagesDiv.scrollTop = messagesDiv.scrollHeight;
</script>

</body>
</html>