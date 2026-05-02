<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Means Test Review | LexAid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f6fb] text-[#0b1b34]">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-[#002147] text-white p-7">
        <h1 class="text-4xl font-serif font-bold mb-1">⚖ LexAid</h1>
        <p class="text-yellow-300 text-sm mb-10">ADMIN PANEL</p>

        <nav class="space-y-3">
            <a href="/admin" class="block px-5 py-3 rounded-xl hover:bg-white/10">Dashboard</a>
            <a href="/admin/means-tests" class="block bg-yellow-400/20 text-yellow-300 px-5 py-3 rounded-xl font-bold">Means Test Review</a>
            <a href="/admin/priority" class="block px-5 py-3 rounded-xl hover:bg-white/10">Case Priority</a>
            <a href="/admin/sos" class="block px-5 py-3 rounded-xl hover:bg-white/10">Emergency SOS</a>
            <a href="/admin/performance" class="block px-5 py-3 rounded-xl hover:bg-white/10">Performance</a>
            <a href="/admin/funding" class="block px-5 py-3 rounded-xl hover:bg-white/10">Funding Tracker</a>
            <a href="/admin/notifications" class="block px-5 py-3 rounded-xl hover:bg-white/10">Bulk Notifications</a>
            <a href="/logout" class="block mt-10 bg-red-600 text-center py-3 rounded-xl font-bold">Logout</a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-[#002147]">Means Test Review</h1>
                <p class="text-gray-600">Review automated eligibility results submitted by clients.</p>
            </div>

            <a href="/admin" class="bg-[#002147] text-white px-5 py-3 rounded-xl font-bold">
                Back to Admin
            </a>
        </div>

        <!-- Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-green-100 border border-green-200 p-6 rounded-2xl shadow">
                <p class="text-green-700 font-semibold">Eligible</p>
                <h2 class="text-5xl font-bold text-green-700 mt-2">{{ $eligibleCount }}</h2>
                <p class="text-sm text-green-600 mt-2">Qualified for legal aid</p>
            </div>

            <div class="bg-yellow-100 border border-yellow-200 p-6 rounded-2xl shadow">
                <p class="text-yellow-700 font-semibold">Partially Eligible</p>
                <h2 class="text-5xl font-bold text-yellow-700 mt-2">{{ $partialCount }}</h2>
                <p class="text-sm text-yellow-600 mt-2">Needs admin review</p>
            </div>

            <div class="bg-red-100 border border-red-200 p-6 rounded-2xl shadow">
                <p class="text-red-700 font-semibold">Not Eligible</p>
                <h2 class="text-5xl font-bold text-red-700 mt-2">{{ $notEligibleCount }}</h2>
                <p class="text-sm text-red-600 mt-2">Does not meet criteria</p>
            </div>
        </div>

        <!-- Rule Explanation -->
        <div class="bg-white p-6 rounded-2xl shadow mb-8">
            <h2 class="text-2xl font-bold mb-4">Eligibility Rules</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <h3 class="font-bold text-[#002147]">Income</h3>
                    <p class="text-gray-600">Lower monthly income gives a higher eligibility score.</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <h3 class="font-bold text-[#002147]">Family Size</h3>
                    <p class="text-gray-600">Larger families receive a higher income threshold.</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <h3 class="font-bold text-[#002147]">Assets</h3>
                    <p class="text-gray-600">Lower total assets improve eligibility score.</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <h3 class="font-bold text-[#002147]">Employment</h3>
                    <p class="text-gray-600">Unemployed or student status can improve eligibility score.</p>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-2xl font-bold">Submitted Means Tests</h2>
                <p class="text-gray-600">Latest eligibility assessments from clients.</p>
            </div>

            @if($tests->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100 text-sm">
                                <th class="p-4">Client</th>
                                <th class="p-4">Income</th>
                                <th class="p-4">Family</th>
                                <th class="p-4">Employment</th>
                                <th class="p-4">Assets</th>
                                <th class="p-4">Score</th>
                                <th class="p-4">Result</th>
                                <th class="p-4">Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tests as $test)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-4">
                                        <p class="font-bold text-[#002147]">{{ $test->client_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $test->client_email }}</p>
                                    </td>

                                    <td class="p-4">৳{{ number_format($test->monthly_income, 2) }}</td>
                                    <td class="p-4">{{ $test->family_members }}</td>
                                    <td class="p-4">{{ ucfirst($test->employment_status) }}</td>
                                    <td class="p-4">৳{{ number_format($test->total_assets, 2) }}</td>
                                    <td class="p-4 font-bold">{{ $test->score }}</td>

                                    <td class="p-4">
                                        @if($test->result == 'eligible')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold text-sm">Eligible</span>
                                        @elseif($test->result == 'partially_eligible')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-bold text-sm">Partially Eligible</span>
                                        @else
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full font-bold text-sm">Not Eligible</span>
                                        @endif
                                    </td>

                                    <td class="p-4 text-sm text-gray-500">{{ $test->created_at }}</td>
                                </tr>

                                @if($test->notes)
                                    <tr class="bg-gray-50">
                                        <td colspan="8" class="p-4 text-sm text-gray-600">
                                            <strong>Client Notes:</strong> {{ $test->notes }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-gray-500">
                    No means test submissions yet.
                </div>
            @endif
        </div>

    </main>
</div>

</body>
</html>