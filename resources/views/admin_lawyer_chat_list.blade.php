<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Admin Lawyer Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen text-[#002147]">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">Admin Lawyer Chat</h1>
    <nav class="flex gap-6">
        <a href="/admin" class="hover:text-[#FCD353]">Dashboard</a>
        <a href="/admin/lawyer-chat" class="text-[#FCD353] font-bold">Lawyer Chat</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-5xl mx-auto py-10 px-6">

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold">Select Lawyer</h2>
            <p class="text-slate-600 mt-2">Choose a lawyer to start direct real-time chat.</p>
        </div>

        <a href="/admin" class="bg-blue-800 text-white px-5 py-3 rounded font-bold hover:bg-blue-900">
            Back to Admin Dashboard
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <section class="bg-white rounded-xl shadow p-6">
        @if($lawyers->count() === 0)
            <p class="text-slate-600">No lawyers found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($lawyers as $lawyer)
                    <a href="/admin/lawyer-chat/{{ $lawyer->id }}" class="border rounded-xl p-5 hover:bg-blue-50 block">
                        <h3 class="text-xl font-bold">{{ $lawyer->name }}</h3>
                        <p class="text-slate-500">{{ $lawyer->email }}</p>
                        <span class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded font-bold">
                            Open Chat
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
</main>

</body>
</html>