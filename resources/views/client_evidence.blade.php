<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Evidence Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">LexAid</h1>
    <nav class="flex gap-6">
        <a href="/client" class="hover:text-[#FCD353]">Dashboard</a>
        <a href="/cases" class="hover:text-[#FCD353]">My Cases</a>
        <a href="/client/evidence" class="text-[#FCD353] font-bold">Evidence</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-6xl mx-auto py-10 px-6">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-[#002147]">Upload Evidence</h2>
        <p class="text-slate-600 mt-2">Attach case-related documents such as PDFs, images, affidavits, photos, or supporting records.</p>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <section class="lg:col-span-1 bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-bold text-[#002147] mb-4">Upload New File</h3>

            @if($cases->count() === 0)
                <p class="text-slate-600">You need to submit a case before uploading evidence.</p>
                <a href="/case/create" class="inline-block mt-4 bg-[#002147] text-white px-4 py-2 rounded">
                    Submit New Case
                </a>
            @else
                <form method="POST" action="/client/evidence/upload" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold mb-2">Select Case</label>
                        <select name="case_id" class="w-full border rounded p-3" required>
                            <option value="">Choose a case</option>
                            @foreach($cases as $case)
                                <option value="{{ $case->id }}">
                                    #{{ $case->id }} - {{ $case->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2">Evidence File</label>
                        <input type="file" name="evidence_file" class="w-full border rounded p-3" accept=".pdf,.jpg,.jpeg,.png" required>
                        <p class="text-xs text-slate-500 mt-2">Allowed: PDF, JPG, JPEG, PNG. Max size: 5MB.</p>
                    </div>

                    <button type="submit" class="w-full bg-[#002147] text-white py-3 rounded font-bold hover:bg-[#003366]">
                        Upload Evidence
                    </button>
                </form>
            @endif
        </section>

        <section class="lg:col-span-2 bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-bold text-[#002147] mb-4">Uploaded Evidence</h3>

            @if($documents->count() === 0)
                <p class="text-slate-600">No evidence uploaded yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-slate-100 text-left text-sm">
                                <th class="p-3">Case</th>
                                <th class="p-3">Type</th>
                                <th class="p-3">Uploaded</th>
                                <th class="p-3">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $doc)
                                <tr class="border-b">
                                    <td class="p-3">
                                        <div class="font-semibold text-[#002147]">{{ $doc->case_title }}</div>
                                        <div class="text-xs text-slate-500">{{ $doc->case_type }}</div>
                                    </td>
                                    <td class="p-3 uppercase">{{ $doc->file_type }}</td>
                                    <td class="p-3">{{ $doc->uploaded_at }}</td>
                                    <td class="p-3">
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-blue-600 font-bold hover:underline">
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

    </div>
</main>

</body>
</html>