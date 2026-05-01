<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Case Priority Scoring | LexAid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f6fb] text-[#0b1b34]">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-[#002147] text-white p-7">
        <h1 class="text-4xl font-serif font-bold mb-1">⚖ LexAid</h1>
        <p class="text-yellow-300 text-sm mb-10">ADMIN PANEL</p>

        <nav class="space-y-3">
            <a href="/admin" class="block px-5 py-3 rounded-xl hover:bg-white/10">
                Dashboard
            </a>

            <a href="/admin/priority" class="block bg-yellow-400/20 text-yellow-300 px-5 py-3 rounded-xl font-bold">
                Case Priority
            </a>

            <a href="/admin/sos" class="block px-5 py-3 rounded-xl hover:bg-white/10">
                Emergency SOS
            </a>

            <a href="/admin/performance" class="block px-5 py-3 rounded-xl hover:bg-white/10">
                Performance
            </a>

            <a href="/admin/funding" class="block px-5 py-3 rounded-xl hover:bg-white/10">
                Funding Tracker
            </a>

            <a href="/admin/notifications" class="block px-5 py-3 rounded-xl hover:bg-white/10">
                Bulk Notifications
            </a>

            <a href="/logout" class="block mt-10 bg-red-600 text-center py-3 rounded-xl font-bold">
                Logout
            </a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-[#002147]">Case Priority Scoring</h1>
                <p class="text-gray-600">Automatically classify cases based on urgency, deadline, type and risk keywords.</p>
            </div>

            <form method="POST" action="/admin/priority/update-all">
                @csrf
                <button class="bg-[#002147] text-white px-5 py-3 rounded-xl font-bold">
                    Recalculate All
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-red-100 border border-red-200 p-6 rounded-2xl shadow">
                <p class="text-red-700 font-semibold">High Priority</p>
                <h2 class="text-5xl font-bold text-red-700 mt-2">{{ $highCount }}</h2>
                <p class="text-sm text-red-600 mt-2">Requires immediate review</p>
            </div>

            <div class="bg-yellow-100 border border-yellow-200 p-6 rounded-2xl shadow">
                <p class="text-yellow-700 font-semibold">Medium Priority</p>
                <h2 class="text-5xl font-bold text-yellow-700 mt-2">{{ $mediumCount }}</h2>
                <p class="text-sm text-yellow-600 mt-2">Normal administrative attention</p>
            </div>

            <div class="bg-green-100 border border-green-200 p-6 rounded-2xl shadow">
                <p class="text-green-700 font-semibold">Low Priority</p>
                <h2 class="text-5xl font-bold text-green-700 mt-2">{{ $lowCount }}</h2>
                <p class="text-sm text-green-600 mt-2">Can be handled routinely</p>
            </div>

        </div>

        <!-- Explanation -->
        <div class="bg-white p-6 rounded-2xl shadow mb-8">
            <h2 class="text-2xl font-bold mb-4">Scoring Rules</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <h3 class="font-bold text-[#002147]">Deadline</h3>
                    <p class="text-gray-600">Cases due within 3 days receive the highest deadline score.</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <h3 class="font-bold text-[#002147]">Case Type</h3>
                    <p class="text-gray-600">Criminal, abuse, harassment and emergency-related cases score higher.</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <h3 class="font-bold text-[#002147]">Risk Keywords</h3>
                    <p class="text-gray-600">Words like urgent, threat, violence, arrest and eviction increase priority.</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <h3 class="font-bold text-[#002147]">Case Status</h3>
                    <p class="text-gray-600">Open cases receive an extra score because they still need action.</p>
                </div>
            </div>
        </div>

        <!-- Cases Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-2xl font-bold">Case Priority List</h2>
                <p class="text-gray-600">Compare current priority with calculated system priority.</p>
            </div>

            @if($cases->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100 text-sm">
                                <th class="p-4">Case</th>
                                <th class="p-4">Client</th>
                                <th class="p-4">Type</th>
                                <th class="p-4">Deadline</th>
                                <th class="p-4">Current Priority</th>
                                <th class="p-4">Score</th>
                                <th class="p-4">Suggested</th>
                                <th class="p-4">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($cases as $case)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4">
                                        <p class="font-bold text-[#002147]">#LX-{{ $case->id }}</p>
                                        <p class="text-sm text-gray-600">{{ $case->title ?? 'Untitled Case' }}</p>
                                    </td>

                                    <td class="p-4">
                                        {{ $case->client_name ?? 'Unknown' }}
                                    </td>

                                    <td class="p-4">
                                        {{ $case->case_type ?? 'N/A' }}
                                    </td>

                                    <td class="p-4">
                                        {{ $case->deadline ?? 'N/A' }}
                                    </td>

                                    <td class="p-4">
                                        @if($case->priority == 'high')
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full font-bold text-sm">High</span>
                                        @elseif($case->priority == 'medium')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-bold text-sm">Medium</span>
                                        @else
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold text-sm">Low</span>
                                        @endif
                                    </td>

                                    <td class="p-4 font-bold">
                                        {{ $case->priority_score }}
                                    </td>

                                    <td class="p-4">
                                        @if($case->calculated_priority == 'high')
                                            <span class="bg-red-600 text-white px-3 py-1 rounded-full font-bold text-sm">High</span>
                                        @elseif($case->calculated_priority == 'medium')
                                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-full font-bold text-sm">Medium</span>
                                        @else
                                            <span class="bg-green-600 text-white px-3 py-1 rounded-full font-bold text-sm">Low</span>
                                        @endif
                                    </td>

                                    <td class="p-4">
                                        <form method="POST" action="/admin/priority/update/{{ $case->id }}">
                                            @csrf
                                            <button class="bg-[#002147] text-white px-4 py-2 rounded-lg text-sm font-bold">
                                                Apply
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-gray-500">
                    No cases found.
                </div>
            @endif
        </div>

    </main>
</div>

</body>
</html>