<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Admin Case Assignment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen text-[#002147]">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">LexAid Admin Panel</h1>
    <nav class="flex gap-6">
        <a href="/admin" class="hover:text-[#FCD353]">Dashboard</a>
        <a href="/admin/cases" class="text-[#FCD353] font-bold">Case Assignment</a>
        <a href="/admin/priority" class="hover:text-[#FCD353]">Priority</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-7xl mx-auto py-10 px-6">

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold">Assign Lawyers to Cases</h2>
            <p class="text-slate-600 mt-2">
                Select a lawyer for each client case. Assigned cases become visible to lawyers.
            </p>
        </div>

        <a href="/admin" class="bg-blue-800 text-white px-5 py-3 rounded font-bold hover:bg-blue-900">
            Back to Admin Dashboard
        </a>
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

    <section class="bg-white rounded-xl shadow p-6">
        <h3 class="text-xl font-bold mb-4">All Submitted Cases</h3>

        @if($cases->count() === 0)
            <p class="text-slate-600">No cases found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-200 text-left">
                            <th class="p-3">ID</th>
                            <th class="p-3">Title</th>
                            <th class="p-3">Client</th>
                            <th class="p-3">Type</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Priority</th>
                            <th class="p-3">Current Lawyer</th>
                            <th class="p-3">Assign Lawyer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cases as $case)
                            <tr class="border-b">
                                <td class="p-3">#{{ $case->id }}</td>
                                <td class="p-3 font-bold">{{ $case->title }}</td>
                                <td class="p-3">{{ $case->client_name ?? 'N/A' }}</td>
                                <td class="p-3">{{ $case->case_type ?? 'N/A' }}</td>
                                <td class="p-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                        {{ ucfirst($case->status ?? 'open') }}
                                    </span>
                                </td>
                                <td class="p-3">{{ ucfirst($case->priority ?? 'medium') }}</td>
                                <td class="p-3">
                                    {{ $case->lawyer_name ?? 'Unassigned' }}
                                </td>
                                <td class="p-3">
                                    <form method="POST" action="/admin/cases/{{ $case->id }}/assign-lawyer" class="flex gap-2">
                                        @csrf

                                        <select name="lawyer_id" class="border rounded px-3 py-2" required>
                                            <option value="">Select lawyer</option>
                                            @foreach($lawyers as $lawyer)
                                                <option value="{{ $lawyer->id }}" {{ $case->lawyer_id == $lawyer->id ? 'selected' : '' }}>
                                                    {{ $lawyer->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button type="submit" class="bg-[#002147] text-white px-4 py-2 rounded font-bold hover:bg-[#003366]">
                                            Assign
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</main>

</body>
</html>