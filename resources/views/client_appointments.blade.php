<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment | LexAid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f6fb] text-[#0b1b34]">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-[#002147] text-white p-7">
        <h1 class="text-4xl font-serif font-bold mb-1">⚖ LexAid</h1>
        <p class="text-yellow-300 text-sm mb-10">CLIENT PANEL</p>

        <nav class="space-y-3">
            <a href="/client" class="block px-5 py-3 rounded-xl hover:bg-white/10">Dashboard</a>
            <a href="/client/appointments" class="block bg-yellow-400/20 text-yellow-300 px-5 py-3 rounded-xl font-bold">Appointments</a>
            <a href="/client/sos" class="block px-5 py-3 rounded-xl hover:bg-white/10 text-red-300">Emergency SOS</a>
            <a href="/logout" class="block mt-10 bg-red-600 text-center py-3 rounded-xl font-bold">Logout</a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-[#002147]">Book Appointment</h1>
                <p class="text-gray-600">Request a meeting with a lawyer</p>
            </div>

            <a href="/client" class="bg-[#002147] text-white px-5 py-3 rounded-xl font-bold">
                Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Booking Form -->
            <div class="bg-white p-8 rounded-2xl shadow">
                <h2 class="text-2xl font-bold mb-6">Request Appointment</h2>

                <form method="POST" action="/client/appointments" class="space-y-4">
                    @csrf

                    <div>
                        <label class="font-semibold">Select Lawyer</label>
                        <select name="lawyer_id" required class="w-full border p-3 rounded-xl mt-1">
                            <option value="">Choose lawyer</option>
                            @foreach($lawyers as $lawyer)
                                <option value="{{ $lawyer->id }}">{{ $lawyer->name }} - {{ $lawyer->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="font-semibold">Related Case Optional</label>
                        <select name="case_id" class="w-full border p-3 rounded-xl mt-1">
                            <option value="">No case selected</option>
                            @foreach($cases as $case)
                                <option value="{{ $case->id }}">#LX-{{ $case->id }} - {{ $case->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="font-semibold">Date</label>
                            <input type="date" name="appointment_date" required class="w-full border p-3 rounded-xl mt-1">
                        </div>

                        <div>
                            <label class="font-semibold">Time</label>
                            <input type="time" name="appointment_time" required class="w-full border p-3 rounded-xl mt-1">
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">Reason</label>
                        <textarea name="reason" required class="w-full border p-3 rounded-xl mt-1 h-32" placeholder="Why do you need this appointment?"></textarea>
                    </div>

                    <button class="w-full bg-[#002147] text-white py-3 rounded-xl font-bold">
                        Submit Appointment Request
                    </button>
                </form>
            </div>

            <!-- My Appointments -->
            <div class="bg-white p-8 rounded-2xl shadow">
                <h2 class="text-2xl font-bold mb-6">My Appointment Requests</h2>

                @if($appointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($appointments as $appointment)
                            <div class="border rounded-xl p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-[#002147]">
                                            {{ $appointment->lawyer_name }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            {{ $appointment->appointment_date }} at {{ $appointment->appointment_time }}
                                        </p>
                                        <p class="text-sm mt-2">{{ $appointment->reason }}</p>

                                        @if($appointment->lawyer_note)
                                            <p class="text-sm mt-2 bg-gray-100 p-2 rounded">
                                                Lawyer Note: {{ $appointment->lawyer_note }}
                                            </p>
                                        @endif
                                    </div>

                                    @if($appointment->status == 'approved')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">Approved</span>
                                    @elseif($appointment->status == 'rejected')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">Rejected</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-bold">Pending</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-100 p-4 rounded-xl text-gray-600">
                        No appointment requests yet.
                    </div>
                @endif
            </div>

        </div>
    </main>
</div>

</body>
</html>