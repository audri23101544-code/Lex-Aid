<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Submit Case - LexAid</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-xl mx-auto mt-16 bg-white p-8 rounded-xl shadow">

<h2 class="text-2xl font-bold mb-6 text-center">Submit a New Case</h2>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

{{-- ERROR MESSAGE --}}
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/submit-case">
@csrf

<!-- TITLE -->
<input type="text" name="title" placeholder="Case Title"
class="w-full mb-4 p-3 border rounded" required>

<!-- DESCRIPTION -->
<textarea name="description" placeholder="Case Description"
class="w-full mb-4 p-3 border rounded" required></textarea>

<!-- CASE TYPE -->
<select name="case_type" class="w-full mb-4 p-3 border rounded">
    <option value="">Select Case Type</option>
    <option value="Criminal">Criminal</option>
    <option value="Civil">Civil</option>
    <option value="Family">Family</option>
</select>

<!-- PRIORITY -->
<select name="priority" class="w-full mb-4 p-3 border rounded">
    <option value="">Select Priority</option>
    <option value="Low">Low</option>
    <option value="Medium">Medium</option>
    <option value="High">High</option>
</select>

<!-- LOCATION -->
<input type="text" name="location" placeholder="Case Location"
class="w-full mb-4 p-3 border rounded" required>

<!-- DEADLINE -->
<input type="date" name="deadline"
class="w-full mb-4 p-3 border rounded" required>

<!-- SUBMIT BUTTON -->
<button type="submit"
class="w-full bg-black text-white py-3 rounded hover:bg-gray-800 transition">
Submit Case
</button>

</form>

</div>

</body>
</html>