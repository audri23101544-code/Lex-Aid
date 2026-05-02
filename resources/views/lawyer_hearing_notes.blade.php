<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Hearing Notes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen text-[#002147]">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">LexAid Lawyer Portal</h1>
    <nav class="flex gap-6">
        <a href="/lawyer" class="hover:text-[#FCD353]">Dashboard</a>
        <a href="/lawyer/hearing-notes" class="text-[#FCD353] font-bold">Hearing Notes</a>
        <a href="/lawyer/evidence" class="hover:text-[#FCD353]">Evidence</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-7xl mx-auto py-10 px-6">

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold">Hearing Notes</h2>
            <p class="text-slate-600 mt-2">
                Add and review hearing notes for your assigned cases.
            </p>
        </div>

        <a href="/lawyer" class="bg-blue-800 text-white px-5 py-3 rounded font-bold hover:bg-blue-900">
            Back to Lawyer Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <section class="bg-white rounded-xl shadow p-6 lg:col-span-1">
            <h3 class="text-xl font-bold mb-4">Add Hearing Note</h3>

            @if($cases->count() === 0)
                <p class="text-slate-600">
                    No assigned cases available. Admin must assign cases to you first.
                </p>
            @else
                <form method="POST" action="/lawyer/hearing-notes/store" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold mb-2">Select Case</label>
                        <select name="case_id" class="w-full border rounded p-3" required>
                            <option value="">Choose assigned case</option>
                            @foreach($cases as $case)
                                <option value="{{ $case->id }}">
                                    #{{ $case->id }} - {{ $case->title }} (Client: {{ $case->client_name ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2">Hearing Date</label>
                        <input type="date" name="hearing_date" class="w-full border rounded p-3">
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2">Note</label>
                        <textarea name="note" rows="6" class="w-full border rounded p-3" placeholder="Write hearing notes, court observations, next steps..." required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-[#002147] text-white py-3 rounded font-bold hover:bg-[#003366]">
                        Save Hearing Note
                    </button>
                </form>
            @endif
        </section>

        <section class="bg-white rounded-xl shadow p-6 lg:col-span-2">
            <h3 class="text-xl font-bold mb-4">Saved Hearing Notes</h3>

            @if($notes->count() === 0)
                <p class="text-slate-600">No hearing notes saved yet.</p>
            @else
                <div class="space-y-5">
                    @foreach($notes as $note)
                        <div class="border rounded-xl p-5 hover:bg-slate-50">
                            <div class="flex justify-between items-start gap-4">
                                <div>
                                    <h4 class="text-lg font-bold text-[#002147]">
                                        {{ $note->case_title }}
                                    </h4>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Client: {{ $note->client_name ?? 'N/A' }}
                                        · Type: {{ $note->case_type ?? 'N/A' }}
                                        · Hearing Date: {{ $note->hearing_date ?? 'N/A' }}
                                    </p>
                                </div>

                                <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-bold">
                                    Note #{{ $note->id }}
                                </span>
                            </div>

                            <p class="text-slate-700 mt-4 leading-relaxed">
                                {{ $note->note }}
                            </p>

                            <p class="text-xs text-slate-400 mt-3">
                                Created at: {{ $note->created_at }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

    </div>
</main>

</body>
</html>