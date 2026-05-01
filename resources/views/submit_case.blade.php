<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Case | LexAid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f6fb] text-[#0b1b34]">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-2xl rounded-2xl shadow p-8">

        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-[#002147]">Submit a New Case</h1>
            <p class="text-gray-500 mt-2">Provide your legal case information carefully.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-5">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/case/store" class="space-y-4">
            @csrf

            <div>
                <label class="font-semibold">Case Title</label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title') }}"
                    placeholder="Example: Urgent domestic violence case"
                    required
                    class="w-full border p-3 rounded-xl mt-1"
                >
            </div>

            <div>
                <label class="font-semibold">Description</label>
                <textarea 
                    name="description" 
                    required
                    placeholder="Describe your case details..."
                    class="w-full border p-3 rounded-xl mt-1 h-28"
                >{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="font-semibold">Case Type</label>
                <select name="case_type" required class="w-full border p-3 rounded-xl mt-1">
                    <option value="">Select Case Type</option>
                    <option value="Civil" {{ old('case_type') == 'Civil' ? 'selected' : '' }}>Civil</option>
                    <option value="Criminal" {{ old('case_type') == 'Criminal' ? 'selected' : '' }}>Criminal</option>
                    <option value="Family" {{ old('case_type') == 'Family' ? 'selected' : '' }}>Family</option>
                    <option value="Property" {{ old('case_type') == 'Property' ? 'selected' : '' }}>Property</option>
                    <option value="Employment" {{ old('case_type') == 'Employment' ? 'selected' : '' }}>Employment</option>
                    <option value="Domestic Violence" {{ old('case_type') == 'Domestic Violence' ? 'selected' : '' }}>Domestic Violence</option>
                    <option value="Harassment" {{ old('case_type') == 'Harassment' ? 'selected' : '' }}>Harassment</option>
                </select>
            </div>

            
            <div>
                <label class="font-semibold">Location</label>
                <input 
                    type="text" 
                    name="location" 
                    value="{{ old('location') }}"
                    placeholder="Example: Banasree, Dhaka"
                    required
                    class="w-full border p-3 rounded-xl mt-1"
                >
            </div>

            <div>
                <label class="font-semibold">Deadline</label>
                <input 
                    type="date" 
                    name="deadline" 
                    value="{{ old('deadline') }}"
                    required
                    class="w-full border p-3 rounded-xl mt-1"
                >
            </div>

            <button class="w-full bg-[#002147] text-white py-3 rounded-xl font-bold hover:bg-[#00152f]">
                Submit Case
            </button>
        </form>

        <div class="mt-5 text-center">
            <a href="/client" class="text-[#002147] font-bold hover:underline">
                Back to Client Dashboard
            </a>
        </div>

    </div>

</div>

</body>
</html>