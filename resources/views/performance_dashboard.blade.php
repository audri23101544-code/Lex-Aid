<!DOCTYPE html>
<html>
<head>
    <title>Performance Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen p-10">
    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Performance Dashboard</h1>
                <p class="text-gray-600">Analytics and workload reporting</p>
            </div>

            <a href="/admin" class="bg-blue-900 text-white px-4 py-2 rounded">
                Back to Admin Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Total Cases</h3>
                <p class="text-4xl font-bold">{{ $totalCases }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Open Cases</h3>
                <p class="text-4xl font-bold text-blue-600">{{ $openCases }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">In Progress</h3>
                <p class="text-4xl font-bold text-yellow-600">{{ $inProgressCases }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Closed Cases</h3>
                <p class="text-4xl font-bold text-green-600">{{ $closedCases }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Clients</h3>
                <p class="text-4xl font-bold">{{ $totalClients }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Lawyers</h3>
                <p class="text-4xl font-bold">{{ $totalLawyers }}</p>
            </div>

            <div class="bg-red-100 p-6 rounded shadow">
                <h3 class="text-red-700">Total SOS</h3>
                <p class="text-4xl font-bold text-red-700">{{ $totalSos }}</p>
            </div>

            <div class="bg-yellow-100 p-6 rounded shadow">
                <h3 class="text-yellow-700">Pending SOS</h3>
                <p class="text-4xl font-bold text-yellow-700">{{ $pendingSos }}</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Lawyer Workload</h2>

            @if($lawyerWorkload->count() > 0)
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-3">Lawyer Name</th>
                            <th class="border p-3">Assigned Cases</th>
                            <th class="border p-3">Workload Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lawyerWorkload as $lawyer)
                            <tr>
                                <td class="border p-3">{{ $lawyer->name }}</td>
                                <td class="border p-3 text-center">{{ $lawyer->total_cases }}</td>
                                <td class="border p-3 text-center">
                                    @if($lawyer->total_cases >= 5)
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded">High Load</span>
                                    @elseif($lawyer->total_cases >= 2)
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">Medium Load</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded">Low Load</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">No lawyers found.</p>
            @endif
        </div>

    </div>
</div>

</body>
</html>