<!DOCTYPE html>
<html>
<head>
    <title>Bulk Email Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="min-h-screen p-8">
    <div class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-[#002147]">Bulk Email Notifications</h1>
                <p class="text-gray-600">Send updates to clients and lawyers</p>
            </div>

            <a href="/admin" class="bg-[#002147] text-white px-5 py-3 rounded font-bold">
                Back to Admin
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white p-6 rounded-xl shadow mb-8">
            <h2 class="text-2xl font-bold mb-4">Send Notification</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/admin/notifications/send" class="space-y-4">
                @csrf

                <select name="target_group" required class="w-full border p-3 rounded">
                    <option value="">Select Target Group</option>
                    <option value="all">All Users</option>
                    <option value="client">Clients</option>
                    <option value="lawyer">Lawyers</option>
                </select>

                <input type="text" name="subject" placeholder="Subject" required class="w-full border p-3 rounded">

                <textarea name="message" placeholder="Message" required class="w-full border p-3 rounded h-32"></textarea>

                <button class="bg-blue-700 text-white px-5 py-3 rounded font-bold">
                    Send Notification
                </button>
            </form>
        </div>

        <!-- History -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-2xl font-bold mb-4">Notification History</h2>

            @if($notifications->count() > 0)
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-3">Target</th>
                            <th class="border p-3">Subject</th>
                            <th class="border p-3">Recipients</th>
                            <th class="border p-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $n)
                            <tr>
                                <td class="border p-3">{{ ucfirst($n->target_group) }}</td>
                                <td class="border p-3">{{ $n->subject }}</td>
                                <td class="border p-3 text-center">{{ $n->total_recipients }}</td>
                                <td class="border p-3">{{ $n->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No notifications sent yet.</p>
            @endif
        </div>

    </div>
</div>

</body>
</html>