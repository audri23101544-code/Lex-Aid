<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Lawyer Evidence Review</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">LexAid Lawyer Portal</h1>
    <nav class="flex gap-6">
        <a href="/lawyer" class="hover:text-[#FCD353]">Dashboard</a>
        <a href="/lawyer/evidence" class="text-[#FCD353] font-bold">Evidence</a>
        <a href="/lawyer/appointments" class="hover:text-[#FCD353]">Appointments</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-6xl mx-auto py-10 px-6">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-[#002147]">Client Evidence Review</h2>
            <p class="text-slate-600 mt-2">
                View evidence uploaded by clients for cases assigned to you.
            </p>
        </div>

        <a href="/lawyer" class="bg-blue-800 text-white px-5 py-3 rounded font-bold hover:bg-blue-900">
            Back to Lawyer Dashboard
        </a>
    </div>

    <section class="bg-white rounded-xl shadow p-6">
        <h3 class="text-xl font-bold text-[#002147] mb-4">Uploaded Evidence</h3>

        @if($documents->count() === 0)
            <p class="text-slate-600">No evidence has been uploaded for your assigned cases yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-left text-sm">
                            <th class="p-3">Client</th>
                            <th class="p-3">Case</th>
                            <th class="p-3">Case Type</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">File Type</th>
                            <th class="p-3">Uploaded</th>
                            <th class="p-3">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $doc)
                            <tr class="border-b">
                                <td class="p-3 font-semibold">{{ $doc->client_name }}</td>
                                <td class="p-3 text-[#002147] font-bold">{{ $doc->case_title }}</td>
                                <td class="p-3">{{ $doc->case_type }}</td>
                                <td class="p-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                        {{ ucfirst($doc->case_status) }}
                                    </span>
                                </td>
                                <td class="p-3 uppercase">{{ $doc->file_type }}</td>
                                <td class="p-3">{{ $doc->uploaded_at }}</td>
                                <td class="p-3">
                                    <a href="{{ asset('storage/' . $doc->file_path) }}"
                                       target="_blank"
                                       class="text-blue-600 font-bold hover:underline">
                                        View File
                                    </a>
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