<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lawyer Calendar | LexAid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f6fb] text-[#0b1b34]">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-[#002147] text-white p-7">
        <h1 class="text-4xl font-serif font-bold mb-1">⚖ LexAid</h1>
        <p class="text-yellow-300 text-sm mb-10">LAWYER PANEL</p>

        <nav class="space-y-3">
            <a href="/lawyer" class="block px-5 py-3 rounded-xl hover:bg-white/10">Dashboard</a>
            <a href="/lawyer/appointments" class="block bg-yellow-400/20 text-yellow-300 px-5 py-3 rounded-xl font-bold">Calendar</a>
            <a href="/lawyer#cases" class="block px-5 py-3 rounded-xl hover:bg-white/10">My Cases</a>
            <a href="/lawyer#sos" class="block px-5 py-3 rounded-xl hover:bg-white/10 text-red-300">SOS Alerts</a>
            <a href="/logout" class="block mt-10 bg-red-600 text-center py-3 rounded-xl font-bold">Logout</a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-[#002147]">Appointment Calendar</h1>
                <p class="text-gray-600">Approve requests and manage your schedule</p>
            </div>

            <a href="/lawyer" class="bg-[#002147] text-white px-5 py-3 rounded-xl font-bold">
                Back to Dashboard
            </a>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-500">Total Requests</p>
                <h2 class="text-4xl font-bold">{{ $appointments->count() }}</h2>
            </div>

            <div class="bg-yellow-100 p-6 rounded-2xl shadow">
                <p class="text-yellow-700">Pending</p>
                <h2 class="text-4xl font-bold text-yellow-700">
                    {{ $appointments->where('status', 'pending')->count() }}
                </h2>
            </div>

            <div class="bg-green-100 p-6 rounded-2xl shadow">
                <p class="text-green-700">Approved</p>
                <h2 class="text-4xl font-bold text-green-700">
                    {{ $appointments->where('status', 'approved')->count() }}
                </h2>
            </div>

        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

            <!-- Requests -->
            <section class="bg-white p-6 rounded-2xl shadow">
                <h2 class="text-2xl font-bold mb-5">Appointment Requests</h2>

                @if($appointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($appointments as $appointment)
                            <div class="border rounded-xl p-4">
                                <div class="flex justify-between gap-4">
                                    <div>
                                        <h3 class="font-bold text-[#002147]">{{ $appointment->client_name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $appointment->client_email }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $appointment->appointment_date }} at {{ $appointment->appointment_time }}
                                        </p>
                                        <p class="text-sm mt-2">
                                            Case: {{ $appointment->case_title ?? 'No case selected' }}
                                        </p>
                                        <p class="text-sm mt-2">{{ $appointment->reason }}</p>

                                        @if($appointment->status == 'approved')
                                            <span class="inline-block mt-3 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">Approved</span>
                                        @elseif($appointment->status == 'rejected')
                                            <span class="inline-block mt-3 bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">Rejected</span>
                                        @else
                                            <span class="inline-block mt-3 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-bold">Pending</span>
                                        @endif
                                    </div>
                                </div>

                                @if($appointment->status == 'pending')
                                    <form method="POST" action="/lawyer/appointments/update/{{ $appointment->id }}" class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-3">
                                        @csrf

                                        <input type="text" name="lawyer_note" placeholder="Optional note" class="border p-2 rounded-xl md:col-span-3">

                                        <button name="status" value="approved" class="bg-green-600 text-white py-2 rounded-xl font-bold">
                                            Approve
                                        </button>

                                        <button name="status" value="rejected" class="bg-red-600 text-white py-2 rounded-xl font-bold">
                                            Reject
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-100 p-4 rounded-xl text-gray-600">
                        No appointment requests yet.
                    </div>
                @endif
            </section>

            <!-- Calendar -->
            <section class="bg-white p-6 rounded-2xl shadow">
                <h2 class="text-2xl font-bold mb-5">Approved Calendar</h2>

                @if($approvedAppointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($approvedAppointments as $appointment)
                            <div class="border-l-4 border-green-600 bg-green-50 rounded-xl p-4">
                                <div class="flex justify-between">
                                    <div>
                                        <h3 class="font-bold text-[#002147]">{{ $appointment->client_name }}</h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $appointment->appointment_date }} at {{ $appointment->appointment_time }}
                                        </p>
                                        <p class="text-sm mt-2">{{ $appointment->reason }}</p>
                                    </div>

                                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm h-fit">
                                        Confirmed
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-100 p-4 rounded-xl text-gray-600">
                        No approved appointments yet.
                    </div>
                @endif
            </section>

        </div>

        <div class="mt-8 bg-blue-50 border border-blue-200 p-5 rounded-2xl">
            <h3 class="font-bold text-blue-800">Conflict Alert Rule</h3>
            <p class="text-sm text-blue-700">
                The system blocks approval if you already have an approved appointment at the same date and time.
            </p>
        </div>

    </main>
</div>

</body>
</html>