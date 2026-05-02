<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid Lawyer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f5f7fb] text-[#0b1b34]">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-[#002147] text-white p-7 flex flex-col">
        <div class="mb-10">
            <h1 class="text-4xl font-serif font-bold text-white">⚖ LexAid</h1>
            <p class="text-yellow-300 text-sm tracking-widest mt-1">LAWYER DASHBOARD</p>
        </div>

        <nav class="space-y-3">
            <a href="/lawyer" class="flex items-center justify-between bg-yellow-400/20 text-yellow-300 px-5 py-4 rounded-xl font-bold">
                <span>Dashboard</span>
            </a>

            <a href="#cases" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                My Cases
            </a>

            <a href="#sos" class="flex justify-between items-center px-5 py-4 rounded-xl hover:bg-white/10">
                <span>SOS Alerts</span>
                <span class="bg-red-500 text-white rounded-full px-3 py-1 text-sm">{{ $totalSos ?? 0 }}</span>
            </a>

            <a href="/lawyer/appointments" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                Calendar
            </a>

            <a href="/lawyer/hearing-notes" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                Hearing Notes
            </a>

            <a href="/lawyer/evidence" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                Documents
            </a>

            <a href="/forum" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                Legal Forum
            </a>

            <a href="#" class="block px-5 py-4 rounded-xl hover:bg-white/10">
                Messages
            </a>
        </nav>

        <div class="mt-auto border-t border-white/20 pt-6">
            <a href="/logout" class="block bg-red-600 text-center py-3 rounded-xl font-bold">
                Logout
            </a>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-8 overflow-y-auto">

        <!-- Top -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold">Good Morning, Advocate 👋</h2>
                <p class="text-gray-500">Here’s what’s happening with your legal work today.</p>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm text-gray-500">Welcome back,</p>
                    <p class="font-bold">{{ $user->name ?? 'Lawyer' }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#002147] text-white flex items-center justify-center font-bold">
                    {{ strtoupper(substr($user->name ?? 'L', 0, 1)) }}
                </div>
            </div>
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

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">My Active Cases</p>
                <h3 class="text-4xl font-bold mt-3">{{ $totalCases ?? 0 }}</h3>
                <p class="text-blue-600 text-sm mt-4">Assigned cases</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Open Cases</p>
                <h3 class="text-4xl font-bold mt-3">{{ $openCases ?? 0 }}</h3>
                <p class="text-blue-600 text-sm mt-4">Need action</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">SOS Alerts</p>
                <h3 class="text-4xl font-bold mt-3 text-red-600">{{ $totalSos ?? 0 }}</h3>
                <p class="text-red-600 text-sm mt-4">Require attention</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Completed Cases</p>
                <h3 class="text-4xl font-bold mt-3 text-green-600">{{ $closedCases ?? 0 }}</h3>
                <p class="text-green-600 text-sm mt-4">Resolved</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Total Earnings</p>
                <h3 class="text-3xl font-bold mt-3 text-green-700">
                    ৳{{ number_format($totalEarnings ?? 0, 2) }}
                </h3>
                <p class="text-green-600 text-sm mt-4">Paid payments</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Pending Payments</p>
                <h3 class="text-3xl font-bold mt-3 text-yellow-700">
                    ৳{{ number_format($pendingPayments ?? 0, 2) }}
                </h3>
                <p class="text-yellow-600 text-sm mt-4">Awaiting client payment</p>
            </div>
        </div>

        <!-- Admin Notifications -->
        <section class="bg-white rounded-2xl shadow p-6 mb-8">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-2xl font-bold">🔔 Admin Notifications</h3>
                    <p class="text-gray-500">Messages sent by admin</p>
                </div>
            </div>

            @if(isset($notifications) && $notifications->count() > 0)
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        <div class="border rounded-xl p-4 bg-blue-50">
                            <h4 class="font-bold text-[#002147]">{{ $notification->subject }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-100 p-4 rounded text-gray-600">
                    No notifications from admin yet.
                </div>
            @endif
        </section>

        <!-- Middle Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

            <!-- SOS -->
            <section id="sos" class="bg-white rounded-2xl shadow p-6">
                <div class="flex justify-between items-center mb-5">
                    <div>
                        <h3 class="text-2xl font-bold">🚨 SOS Alerts</h3>
                        <p class="text-gray-500">Urgent client requests</p>
                    </div>
                </div>

                @if(isset($sosRequests) && $sosRequests->count() > 0)
                    <div class="space-y-4">
                        @foreach($sosRequests as $sos)
                            <div class="flex items-center justify-between border rounded-xl p-4 hover:bg-red-50">
                                <div class="flex gap-4">
                                    <div class="bg-red-100 text-red-600 font-bold px-4 py-3 rounded-xl">
                                        SOS
                                    </div>
                                    <div>
                                        <h4 class="font-bold">{{ $sos->emergency_type }}</h4>
                                        <p class="text-sm text-gray-500">{{ $sos->location }}</p>
                                        <p class="text-sm text-gray-500">{{ $sos->phone }}</p>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <form action="/sos/update/{{ $sos->id }}" method="POST">
                                        @csrf
                                        <select name="status"
                                            onchange="this.form.submit()"
                                            class="border px-2 py-1 rounded text-sm">

                                            <option value="pending" {{ $sos->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="reviewing" {{ $sos->status == 'reviewing' ? 'selected' : '' }}>
                                                Reviewing
                                            </option>

                                            <option value="resolved" {{ $sos->status == 'resolved' ? 'selected' : '' }}>
                                                Resolved
                                            </option>
                                        </select>
                                    </form>
                                    <p class="text-xs text-gray-400">Client: {{ $sos->client_name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-100 p-4 rounded text-gray-600">
                        No active SOS alerts.
                    </div>
                @endif
            </section>

            <!-- Hearing Notes -->
            <section class="bg-white rounded-2xl shadow p-6">
                <div class="flex justify-between items-center mb-5">
                    <div>
                        <h3 class="text-2xl font-bold">📅 Hearing Notes</h3>
                        <p class="text-gray-500">Recent notes from your assigned cases</p>
                    </div>

                    <a href="/lawyer/hearing-notes" class="text-blue-600 font-bold hover:underline">
                        View All
                    </a>
                </div>

                @if(isset($hearingNotes) && $hearingNotes->count() > 0)
                    <div class="space-y-4">
                        @foreach($hearingNotes as $note)
                            <div class="border rounded-xl p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start gap-4">
                                    <div>
                                        <h4 class="font-bold text-[#002147]">
                                            {{ $note->case_title }}
                                        </h4>

                                        <p class="text-sm text-gray-500">
                                            Client: {{ $note->client_name ?? 'N/A' }}
                                            · Type: {{ $note->case_type ?? 'N/A' }}
                                        </p>

                                        <p class="text-sm text-gray-600 mt-2">
                                            {{ \Illuminate\Support\Str::limit($note->note, 100) }}
                                        </p>
                                    </div>

                                    <span class="text-yellow-700 font-bold text-sm whitespace-nowrap">
                                        {{ $note->hearing_date ?? 'No date' }}
                                    </span>
                                </div>

                                <p class="text-xs text-gray-400 mt-3">
                                    Created: {{ $note->created_at }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-100 p-4 rounded text-gray-600">
                        No hearing notes yet.
                    </div>
                @endif
            </section>

        </div>

        <!-- Cases -->
        <section id="cases" class="bg-white rounded-2xl shadow p-6">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-2xl font-bold">Recent Case Updates</h3>
                    <p class="text-gray-500">Assigned cases, billing amount, and current status</p>
                </div>
            </div>

            @if(isset($allCases) && $allCases->count() > 0)
                <div class="space-y-4">
                    @foreach($allCases as $case)
                        <div class="border rounded-xl p-4 flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4 hover:bg-gray-50">
                            <div>
                                <h4 class="font-bold">{{ $case->title ?? 'Untitled Case' }}</h4>
                                <p class="text-sm text-gray-500">
                                    Case #LX-{{ $case->id }} · {{ $case->case_type ?? 'N/A' }}
                                </p>

                                @if($case->payment_amount)
                                    <p class="text-sm text-gray-600 mt-2">
                                        Amount: <strong>৳{{ number_format($case->payment_amount, 2) }}</strong>
                                        · Payment:
                                        <strong>{{ ucfirst($case->payment_status ?? 'pending') }}</strong>
                                    </p>
                                @else
                                    <p class="text-sm text-gray-400 mt-2">
                                        No amount set yet.
                                    </p>
                                @endif
                            </div>

                            <div class="text-right min-w-[280px]">
                                <p class="font-bold text-[#002147]">
                                    {{ ucfirst(str_replace('_', ' ', $case->status ?? 'open')) }}
                                </p>

                                <p class="text-sm text-gray-500">Deadline: {{ $case->deadline ?? 'N/A' }}</p>

                                @if(($case->status ?? '') !== 'closed')
                                    <form method="POST" action="/lawyer/cases/{{ $case->id }}/set-amount" class="mt-3">
                                        @csrf
                                        <div class="flex gap-2 justify-end">
                                            <input type="number"
                                                name="amount"
                                                step="0.01"
                                                min="1"
                                                value="{{ $case->payment_amount ?? '' }}"
                                                placeholder="Set amount"
                                                class="border rounded px-3 py-2 text-sm w-32">

                                            <button type="submit" class="bg-[#002147] text-white px-3 py-2 rounded text-sm font-bold hover:bg-[#003366]">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                @endif

                                @if(($case->status ?? '') === 'in_progress')
                                    <form method="POST" action="/lawyer/cases/{{ $case->id }}/complete" class="mt-2">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded font-bold hover:bg-green-700 text-sm">
                                            Mark Completed
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-100 p-4 rounded text-gray-600">
                    No assigned cases yet.
                </div>
            @endif
        </section>

    </main>
</div>

</body>
</html>