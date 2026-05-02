\<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Client Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f6f8fc] text-[#082044]">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r min-h-screen p-6 fixed left-0 top-0">
        <div class="mb-10">
            <h1 class="text-4xl font-serif font-bold text-[#002147]">⚖ LexAid</h1>
            <p class="text-sm text-yellow-700 font-bold mt-1">CLIENT PORTAL</p>
        </div>

        <nav class="space-y-3">
            <a href="/client" class="block bg-yellow-100 text-[#8a6500] px-5 py-3 rounded-xl font-bold">
                🏠 Dashboard
            </a>

            <a href="#cases" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                📁 My Cases
            </a>

            <a href="/client/appointments" class="block px-5 py-3 rounded-xl hover:bg-green-50 text-green-700 font-bold">
                📅 Book Appointment
            </a>

            <a href="/client/evidence" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                📄 Evidence
            </a>

            <a href="#notifications" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                ✉️ Notifications
            </a>

            <a href="/forum" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                💬 Legal Forum
            </a>

            <a href="/client/sos" class="block px-5 py-3 rounded-xl hover:bg-red-50 text-red-600 font-bold">
                ⚠️ Emergency SOS
            </a>
            
            <a href="/logout" class="block mt-6 bg-red-600 text-white text-center py-3 rounded-xl font-bold hover:bg-red-700">
                        Logout
            </a>
        </nav>

        <div class="mt-10 bg-[#002147] text-white rounded-xl p-5">
            <h3 class="font-bold mb-2">Need Help?</h3>
            <p class="text-sm text-gray-300 mb-4">
                Our support team is available to assist you.
            </p>
            <a href="#" class="block bg-yellow-400 text-[#002147] text-center py-2 rounded font-bold">
                Contact Support
            </a>
        </div>

        <a href="/logout" class="block mt-6 bg-red-600 text-white text-center py-3 rounded-xl font-bold">
            Logout
        </a>
    </aside>

    <!-- Main Area -->
    <main class="ml-64 flex-1">

        <!-- Top Bar -->
        <header class="h-20 bg-[#002147] text-white flex justify-between items-center px-8 shadow">
            <nav class="hidden md:flex gap-8 text-sm font-semibold">
                <a href="/client" class="text-yellow-300 border-b-2 border-yellow-300 pb-2">Overview</a>
                <a href="#cases" class="hover:text-yellow-300">My Cases</a>
                <a href="/client/evidence" class="hover:text-yellow-300">Evidence</a>
                <a href="/forum" class="hover:text-yellow-300">Legal Forum</a>
                <a href="#notifications" class="hover:text-yellow-300">Notifications</a>
            </nav>

            <div class="flex items-center gap-5">
                <div class="relative">
                    <span class="text-2xl">🔔</span>

                    @if(isset($notifications) && $notifications->count() > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2">
                            {{ $notifications->count() }}
                        </span>
                    @endif
                </div>

                <div class="w-10 h-10 bg-white text-[#002147] rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}
                </div>

                <div>
                    <p class="font-bold">{{ $user->name ?? 'Client' }}</p>
                    <p class="text-xs text-gray-300">Client</p>
                </div>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto">

            <!-- Hero -->
            <section class="bg-[#002147] rounded-2xl p-10 text-white mb-8 shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-xl mb-2">Welcome back,</p>
                    <h1 class="text-5xl font-bold mb-4">{{ $user->name ?? 'Client' }}</h1>
                    <p class="text-gray-200">
                        Here's what's happening with your legal aid cases today.
                    </p>
                </div>

                <div class="absolute right-10 top-8 text-8xl opacity-20">
                    ⚖️
                </div>
            </section>

            <!-- Notifications + Summary -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                <!-- Notifications -->
                <section id="notifications" class="bg-white rounded-2xl shadow p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Notifications</h2>
                    </div>

                    @if(isset($notifications) && $notifications->count() > 0)
                        <div class="space-y-5">
                            @foreach($notifications->take(4) as $n)
                                <div class="flex gap-4 border-b pb-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl">
                                        📢
                                    </div>

                                    <div>
                                        <h3 class="font-bold">{{ $n->subject }}</h3>
                                        <p class="text-sm text-gray-600">{{ $n->message }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $n->created_at ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No notifications yet.</p>
                    @endif
                </section>

                <!-- Case Summary -->
                <section class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-2xl font-bold mb-6">Case Summary</h2>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="bg-blue-50 p-5 rounded-xl">
                            <div class="text-2xl mb-3">📁</div>
                            <p class="text-sm text-blue-700">Total Cases</p>
                            <h3 class="text-3xl font-bold">{{ $yourCases->count() ?? 0 }}</h3>
                        </div>

                        <div class="bg-green-50 p-5 rounded-xl">
                            <div class="text-2xl mb-3">📈</div>
                            <p class="text-sm text-green-700">In Progress</p>
                            <h3 class="text-3xl font-bold">
                                {{ $yourCases->where('status', 'in_progress')->count() }}
                            </h3>
                        </div>

                        <div class="bg-yellow-50 p-5 rounded-xl">
                            <div class="text-2xl mb-3">⏳</div>
                            <p class="text-sm text-yellow-700">Pending/Open</p>
                            <h3 class="text-3xl font-bold">
                                {{ $yourCases->where('status', 'open')->count() }}
                            </h3>
                        </div>

                        <div class="bg-red-50 p-5 rounded-xl">
                            <div class="text-2xl mb-3">✅</div>
                            <p class="text-sm text-red-700">Closed</p>
                            <h3 class="text-3xl font-bold">
                                {{ $yourCases->where('status', 'closed')->count() }}
                            </h3>
                        </div>
                    </div>
                </section>
            </div>

            <!-- My Cases -->
            <section id="cases" class="bg-white rounded-2xl shadow p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">My Cases</h2>
                        <p class="text-gray-500">Your submitted legal aid cases</p>
                    </div>

                    <a href="/case/create" class="bg-[#002147] text-white px-4 py-2 rounded-lg font-bold">
                        Submit New Case
                    </a>
                </div>

                @if(isset($yourCases) && $yourCases->count() > 0)
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left text-sm">
                                <th class="p-4">Case Title</th>
                                <th class="p-4">Case Type</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Priority</th>
                                <th class="p-4">Deadline</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($yourCases as $case)
                                <tr class="border-b">
                                    <td class="p-4 font-semibold">{{ $case->title ?? 'N/A' }}</td>
                                    <td class="p-4">{{ $case->case_type ?? 'N/A' }}</td>

                                    <td class="p-4">
                                        <span class="px-3 py-1 rounded-full text-sm font-bold
                                            {{ ($case->status ?? '') == 'closed' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ ($case->status ?? '') == 'in_progress' ? 'bg-blue-100 text-blue-700' : '' }}
                                            {{ ($case->status ?? '') == 'open' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                            {{ ucfirst($case->status ?? 'Open') }}
                                        </span>
                                    </td>

                                    <td class="p-4">{{ ucfirst($case->priority ?? 'Medium') }}</td>
                                    <td class="p-4">{{ $case->deadline ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">No cases submitted yet.</p>
                @endif
            </section>

            <!-- Appointments + Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                <!-- Appointment Card -->
                <section class="bg-white rounded-2xl shadow p-6">
                    <div class="flex justify-between items-center mb-5">
                        <div>
                            <h2 class="text-2xl font-bold">Appointments</h2>
                            <p class="text-gray-500">Book and track lawyer meetings</p>
                        </div>

                        <a href="/client/appointments" class="text-blue-700 font-bold">
                            Open
                        </a>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b pb-3">
                            <div>
                                <h3 class="font-bold">Request Appointment</h3>
                                <p class="text-sm text-gray-500">Choose lawyer, date, time and reason</p>
                            </div>

                            <a href="/client/appointments" class="bg-green-100 text-green-700 px-4 py-2 rounded-lg font-bold">
                                Book Now
                            </a>
                        </div>

                        <div class="flex justify-between items-center border-b pb-3">
                            <div>
                                <h3 class="font-bold">Approval Tracking</h3>
                                <p class="text-sm text-gray-500">See pending, approved or rejected appointments</p>
                            </div>

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm">
                                Active
                            </span>
                        </div>
                    </div>
                </section>

                <!-- Recent Activity -->
                <section class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-2xl font-bold mb-5">Recent Activity</h2>

                    <div class="space-y-5">
                        @if(isset($yourCases) && $yourCases->count() > 0)
                            @foreach($yourCases->take(3) as $case)
                                <div class="flex gap-3">
                                    <div class="w-3 h-3 bg-blue-600 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm">
                                            Your case <strong>{{ $case->title }}</strong> is currently
                                            <strong>{{ ucfirst($case->status) }}</strong>.
                                        </p>
                                        <p class="text-xs text-gray-400">Recently updated</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500">No recent activity.</p>
                        @endif
                    </div>
                </section>
            </div>

            <!-- Quick Actions -->
            <section class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-2xl font-bold mb-5">Quick Actions</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    <a href="/case/create" class="bg-blue-50 p-5 rounded-xl text-center font-bold hover:bg-blue-100">
                        📄<br>Submit New Case
                    </a>

                    <a href="/client/appointments" class="bg-green-50 p-5 rounded-xl text-center font-bold hover:bg-green-100">
                        📅<br>Book Appointment
                    </a>

                    <a href="/client/evidence" class="bg-purple-50 p-5 rounded-xl text-center font-bold hover:bg-purple-100">
                        ☁️<br>Upload Evidence
                    </a>

                    <a href="/client/sos" class="bg-red-50 p-5 rounded-xl text-center font-bold text-red-600 hover:bg-red-100">
                        🚨<br>Emergency SOS
                    </a>
                </div>
            </section>

        </div>

        <!-- Footer -->
        <footer class="bg-[#002147] text-white px-8 py-5 flex justify-between text-sm">
            <p>© 2025 LexAid. All rights reserved.</p>
            <p>Privacy Policy | Terms & Conditions</p>
        </footer>

    </main>
</div>

</body>
</html>