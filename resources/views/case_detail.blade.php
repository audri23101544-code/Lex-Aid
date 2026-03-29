<!DOCTYPE html>
<html>
<head>
<title>Case Detail</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h2 class="text-2xl font-bold mb-6">Case Details</h2>

<div class="bg-white p-6 rounded shadow">

<p><strong>Title:</strong> {{ $case->title }}</p>
<p><strong>Description:</strong> {{ $case->description }}</p>
<p><strong>Type:</strong> {{ $case->case_type }}</p>
<p><strong>Status:</strong> {{ $case->status }}</p>
<p><strong>Priority:</strong> {{ $case->priority }}</p>
<p><strong>Location:</strong> {{ $case->location }}</p>
<p><strong>Deadline:</strong> {{ $case->deadline }}</p>

<p><strong>Submitted By:</strong> {{ $case->client_name ?? 'Unknown' }} ({{ $case->client_email ?? 'unknown email' }})</p>

@if($case->lawyer_name)
    <p><strong>Assigned Lawyer:</strong> {{ $case->lawyer_name }}</p>
@endif

<p><strong>Submitted At:</strong> {{ \Carbon\Carbon::parse($case->created_at)->format('M d, Y h:i:s A') }}</p>
<p><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($case->updated_at)->format('M d, Y h:i:s A') }}</p>

</div>

</body>
</html>