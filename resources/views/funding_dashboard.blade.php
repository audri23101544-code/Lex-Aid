<!DOCTYPE html>
<html>
<head>
    <title>Grant & Funding Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="min-h-screen p-8">
    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-[#002147]">Grant & Funding Tracker</h1>
                <p class="text-gray-600">Monitor legal aid funding sources and case allocations</p>
            </div>

            <a href="/admin" class="bg-[#002147] text-white px-5 py-3 rounded font-bold">
                Back to Admin
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Total Funding</p>
                <h2 class="text-4xl font-bold text-green-700">৳{{ number_format($totalFunding ?? 0, 2) }}</h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Allocated</p>
                <h2 class="text-4xl font-bold text-blue-700">৳{{ number_format($allocated ?? 0, 2) }}</h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Remaining</p>
                <h2 class="text-4xl font-bold text-yellow-700">৳{{ number_format($remaining ?? 0, 2) }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-2xl font-bold mb-4">Add Funding Source</h2>

                <form method="POST" action="/admin/funding/source" class="space-y-4">
                    @csrf

                    <input type="text" name="source_name" placeholder="Source name" required class="w-full border p-3 rounded">

                    <input type="number" step="0.01" name="total_amount" placeholder="Total amount" required class="w-full border p-3 rounded">

                    <textarea name="description" placeholder="Description" class="w-full border p-3 rounded"></textarea>

                    <button class="bg-green-700 text-white px-5 py-3 rounded font-bold">
                        Add Source
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-2xl font-bold mb-4">Funding Sources</h2>

                @if($sources->count() > 0)
                    <div class="space-y-3">
                        @foreach($sources as $source)
                            <div class="border rounded p-4">
                                <h3 class="font-bold">{{ $source->source_name }}</h3>
                                <p class="text-green-700 font-bold">৳{{ number_format($source->total_amount, 2) }}</p>
                                <p class="text-sm text-gray-500">{{ $source->description }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No funding sources added yet.</p>
                @endif
            </div>

        </div>

        <div class="bg-white p-6 rounded-xl shadow mb-8">
            <h2 class="text-2xl font-bold mb-4">Allocate Funding to Case</h2>

            <form method="POST" action="/admin/funding/allocate" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @csrf

                <select name="funding_source_id" required class="border p-3 rounded">
                    <option value="">Select Source</option>
                    @foreach($sources as $source)
                        <option value="{{ $source->id }}">{{ $source->source_name }}</option>
                    @endforeach
                </select>

                <input type="number" name="case_id" required placeholder="Case ID" class="border p-3 rounded">

                <input type="number" step="0.01" name="allocated_amount" required placeholder="Amount" class="border p-3 rounded">

                <input type="text" name="note" placeholder="Note" class="border p-3 rounded">

                <button class="bg-[#002147] text-white px-5 py-3 rounded font-bold md:col-span-4">
                    Allocate Funding
                </button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-4">Recent Allocations</h2>

            @if($allocations->count() > 0)
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-3">Source</th>
                            <th class="border p-3">Case</th>
                            <th class="border p-3">Amount</th>
                            <th class="border p-3">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allocations as $allocation)
                            <tr>
                                <td class="border p-3">{{ $allocation->source_name }}</td>
                                <td class="border p-3">#{{ $allocation->case_id }} - {{ $allocation->title }}</td>
                                <td class="border p-3 font-bold text-green-700">৳{{ number_format($allocation->allocated_amount, 2) }}</td>
                                <td class="border p-3">{{ $allocation->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No funding allocations yet.</p>
            @endif
        </div>

    </div>
</div>

</body>
</html>