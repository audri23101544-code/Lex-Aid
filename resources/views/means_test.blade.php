<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Means Test | LexAid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f6fb] text-[#0b1b34]">

<div class="min-h-screen flex">

    <aside class="w-72 bg-[#002147] text-white p-7">
        <h1 class="text-4xl font-serif font-bold mb-1">⚖ LexAid</h1>
        <p class="text-yellow-300 text-sm mb-10">CLIENT PANEL</p>

        <nav class="space-y-3">
            <a href="/client" class="block px-5 py-3 rounded-xl hover:bg-white/10">Dashboard</a>
            <a href="/client/means-test" class="block bg-yellow-400/20 text-yellow-300 px-5 py-3 rounded-xl font-bold">Means Test</a>
            <a href="/client/appointments" class="block px-5 py-3 rounded-xl hover:bg-white/10">Appointments</a>
            <a href="/client/sos" class="block px-5 py-3 rounded-xl hover:bg-white/10 text-red-300">Emergency SOS</a>
            <a href="/logout" class="block mt-10 bg-red-600 text-center py-3 rounded-xl font-bold">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-[#002147]">Automated Eligibility Test</h1>
                <p class="text-gray-600">Check whether you qualify for legal aid support.</p>
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
                @foreach($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <section class="bg-white rounded-2xl shadow p-8">
                <h2 class="text-2xl font-bold mb-6">Submit Means Test</h2>

                <form method="POST" action="/client/means-test" class="space-y-4">
                    @csrf

                    <div>
                        <label class="font-semibold">Monthly Income</label>
                        <input type="number" step="0.01" name="monthly_income" required class="w-full border p-3 rounded-xl mt-1" placeholder="Example: 18000">
                    </div>

                    <div>
                        <label class="font-semibold">Family Members</label>
                        <input type="number" name="family_members" min="1" required class="w-full border p-3 rounded-xl mt-1" placeholder="Example: 4">
                    </div>

                    <div>
                        <label class="font-semibold">Employment Status</label>
                        <select name="employment_status" required class="w-full border p-3 rounded-xl mt-1">
                            <option value="">Select status</option>
                            <option value="unemployed">Unemployed</option>
                            <option value="student">Student</option>
                            <option value="employed">Employed</option>
                            <option value="self-employed">Self-employed</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-semibold">Total Assets</label>
                        <input type="number" step="0.01" name="total_assets" required class="w-full border p-3 rounded-xl mt-1" placeholder="Example: 30000">
                    </div>

                    <div>
                        <label class="font-semibold">Additional Notes Optional</label>
                        <textarea name="notes" class="w-full border p-3 rounded-xl mt-1 h-28" placeholder="Any special financial situation..."></textarea>
                    </div>

                    <button class="w-full bg-[#002147] text-white py-3 rounded-xl font-bold">
                        Calculate Eligibility
                    </button>
                </form>
            </section>

            <section class="bg-white rounded-2xl shadow p-8">
                <h2 class="text-2xl font-bold mb-6">Latest Eligibility Result</h2>

                @if($latestTest)
                    @if($latestTest->result == 'eligible')
                        <div class="bg-green-100 border border-green-300 p-6 rounded-2xl">
                            <h3 class="text-3xl font-bold text-green-700">Eligible</h3>
                            <p class="text-green-700 mt-2">You qualify for legal aid support.</p>
                        </div>
                    @elseif($latestTest->result == 'partially_eligible')
                        <div class="bg-yellow-100 border border-yellow-300 p-6 rounded-2xl">
                            <h3 class="text-3xl font-bold text-yellow-700">Partially Eligible</h3>
                            <p class="text-yellow-700 mt-2">You may qualify for partial legal aid support.</p>
                        </div>
                    @else
                        <div class="bg-red-100 border border-red-300 p-6 rounded-2xl">
                            <h3 class="text-3xl font-bold text-red-700">Not Eligible</h3>
                            <p class="text-red-700 mt-2">You may not qualify based on the submitted information.</p>
                        </div>
                    @endif

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-xl">
                            <p class="text-gray-500">Score</p>
                            <h3 class="text-3xl font-bold">{{ $latestTest->score }}</h3>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl">
                            <p class="text-gray-500">Monthly Income</p>
                            <h3 class="text-xl font-bold">৳{{ number_format($latestTest->monthly_income, 2) }}</h3>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl">
                            <p class="text-gray-500">Family Members</p>
                            <h3 class="text-xl font-bold">{{ $latestTest->family_members }}</h3>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl">
                            <p class="text-gray-500">Assets</p>
                            <h3 class="text-xl font-bold">৳{{ number_format($latestTest->total_assets, 2) }}</h3>
                        </div>
                    </div>
                @else
                    <div class="bg-gray-100 p-6 rounded-xl text-gray-600">
                        No means test submitted yet.
                    </div>
                @endif
            </section>

        </div>

    </main>
</div>

</body>
</html>