<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#002147] text-white p-6">
        <h1 class="text-3xl font-bold mb-1">LexAid</h1>
        <p class="text-yellow-300 text-sm mb-10">Admin Panel</p>

        <nav class="space-y-3">
            <a href="/admin" class="block bg-yellow-400 text-[#002147] px-4 py-3 rounded font-bold">
                Dashboard
            </a>

            <a href="/admin/sos" class="block hover:bg-white/10 px-4 py-3 rounded">
                Emergency SOS
            </a>

            <a href="/admin/performance" class="block hover:bg-white/10 px-4 py-3 rounded">
                Performance Dashboard
            </a>

            <a href="#" class="block hover:bg-white/10 px-4 py-3 rounded">
                Grant & Funding Tracker
            </a>

            <a href="#" class="block hover:bg-white/10 px-4 py-3 rounded">
                Bulk Email Notifications
            </a>

            <a href="/cases" class="block hover:bg-white/10 px-4 py-3 rounded">
                Case Files
            </a>

            <a href="/logout" class="block mt-10 bg-red-600 px-4 py-3 rounded text-center font-bold">
                Logout
            </a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-4xl font-bold text-[#002147]">Admin Dashboard</h2>
                <p class="text-gray-600">Welcome, {{ $user->name ?? 'Admin' }}</p>
            </div>

            <a href="/admin/performance" class="bg-[#002147] text-white px-5 py-3 rounded font-bold">
                View Performance
            </a>
        </div>

        <!-- Main Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Total Cases</p>
                <h3 class="text-4xl font-bold text-[#002147]">{{ $totalCases ?? 0 }}</h3>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Total Users</p>
                <h3 class="text-4xl font-bold text-[#002147]">{{ $totalUsers ?? 0 }}</h3>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Lawyers</p>
                <h3 class="text-4xl font-bold text-[#002147]">{{ $totalLawyers ?? 0 }}</h3>
            </div>

            <div class="bg-red-100 p-6 rounded-xl shadow border border-red-300">
                <p class="text-red-700">Pending SOS</p>
                <h3 class="text-4xl font-bold text-red-700">{{ $pendingSos ?? 0 }}</h3>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

            <a href="/admin/sos" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-red-600 mb-2">Emergency SOS</h3>
                <p class="text-gray-600 mb-4">View and manage urgent legal requests.</p>
                <span class="text-red-600 font-bold">Open SOS →</span>
            </a>

            <a href="/admin/performance" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-blue-700 mb-2">Performance Dashboard</h3>
                <p class="text-gray-600 mb-4">Track cases, workload, clients, lawyers and SOS.</p>
                <span class="text-blue-700 font-bold">View Analytics →</span>
            </a>

            <a href="#" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-green-700 mb-2">Grant & Funding</h3>
                <p class="text-gray-600 mb-4">Monitor funding sources and case allocations.</p>
                <span class="text-green-700 font-bold">Coming Next →</span>
            </a>

            <a href="#" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-purple-700 mb-2">Bulk Email</h3>
                <p class="text-gray-600 mb-4">Send automated updates and reminders.</p>
                <span class="text-purple-700 font-bold">Coming Next →</span>
            </a>

        </div>

        <!-- SOS Section -->
        <div class="bg-white rounded-xl shadow p-6 mb-10">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-2xl font-bold text-red-600">Latest SOS Requests</h3>
                    <p class="text-gray-600">Fast-track urgent client requests</p>
                </div>

                <a href="/admin/sos" class="bg-red-600 text-white px-4 py-2 rounded">
                    View All
                </a>
            </div>

            @if(isset($sosRequests) && $sosRequests->count() > 0)
                <table class="w-full border">
                    <thead>
                        <tr class="bg-red-100">
                            <th class="border p-3">Client</th>
                            <th class="border p-3">Type</th>
                            <th class="border p-3">Location</th>
                            <th class="border p-3">Phone</th>
                            <th class="border p-3">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($sosRequests as $sos)
                            <tr>
                                <td class="border p-3">{{ $sos->client_name }}</td>
                                <td class="border p-3">{{ $sos->emergency_type }}</td>
                                <td class="border p-3">{{ $sos->location }}</td>
                                <td class="border p-3">{{ $sos->phone }}</td>
                                <td class="border p-3 font-bold text-red-600">
                                    {{ ucfirst($sos->status) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="bg-gray-100 p-4 rounded text-gray-600">
                    No SOS requests submitted yet.
                </div>
            @endif
        </div>

        <!-- Recent Cases -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-2xl font-bold text-[#002147]">Recent Cases</h3>
                    <p class="text-gray-600">Latest submitted legal aid cases</p>
                </div>

                <a href="/cases" class="bg-[#002147] text-white px-4 py-2 rounded">
                    View Cases
                </a>
            </div>

            @if(isset($recentCases) && $recentCases->count() > 0)
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-3">ID</th>
                            <th class="border p-3">Title</th>
                            <th class="border p-3">Type</th>
                            <th class="border p-3">Status</th>
                            <th class="border p-3">Priority</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($recentCases as $case)
                            <tr>
                                <td class="border p-3">#{{ $case->id }}</td>
                                <td class="border p-3">{{ $case->title ?? 'N/A' }}</td>
                                <td class="border p-3">{{ $case->case_type ?? 'N/A' }}</td>
                                <td class="border p-3">{{ ucfirst($case->status ?? 'open') }}</td>
                                <td class="border p-3">{{ ucfirst($case->priority ?? 'medium') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="bg-gray-100 p-4 rounded text-gray-600">
                    No recent cases found.
                </div>
            @endif
        </div>

    </main>
</div>

</body>
</html>