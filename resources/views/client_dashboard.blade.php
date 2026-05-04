<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>LexAid | {{ __('messages.client_dashboard') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f6f8fc] text-[#082044]">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r min-h-screen p-6 fixed left-0 top-0">
        <div class="mb-10">
            <h1 class="text-4xl font-serif font-bold text-[#002147]">⚖ LexAid</h1>
            <p class="text-sm text-yellow-700 font-bold mt-1">{{ __('messages.client_dashboard') }}</p>
        </div>

        <nav class="space-y-3">
            <a href="/client" class="block bg-yellow-100 text-[#8a6500] px-5 py-3 rounded-xl font-bold">
                🏠 {{ __('messages.dashboard') }}
            </a>

            <a href="#cases" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                📁 {{ __('messages.my_cases') }}
            </a>

            <a href="/client/appointments" class="block px-5 py-3 rounded-xl hover:bg-green-50 text-green-700 font-bold">
                📅 {{ __('messages.appointments') }}
            </a>

            <a href="/client/means-test" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                ✅ {{ __('messages.means_test') }}
            </a>

            <a href="/client/evidence" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                📄 {{ __('messages.evidence') }}
            </a>

            <a href="#notifications" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                ✉️ {{ __('messages.notifications') }}
            </a>

            <a href="/forum" class="block px-5 py-3 rounded-xl hover:bg-gray-100">
                💬 {{ __('messages.legal_forum') }}
            </a>

            <a href="/client/sos" class="block px-5 py-3 rounded-xl hover:bg-red-50 text-red-600 font-bold">
                ⚠️ {{ __('messages.emergency_sos') }}
            </a>
            
            <a href="/logout" class="block mt-6 bg-red-600 text-white text-center py-3 rounded-xl font-bold hover:bg-red-700">
                {{ __('messages.logout') }}
            </a>
        </nav>

        <div class="mt-10 bg-[#002147] text-white rounded-xl p-5">
            <h3 class="font-bold mb-2">{{ __('messages.need_help') ?? 'Need Help?' }}</h3>
            <p class="text-sm text-gray-300 mb-4">
                {{ __('messages.support_text') ?? 'Our support team is available to assist you.' }}
            </p>
            <a href="#" class="block bg-yellow-400 text-[#002147] text-center py-2 rounded font-bold">
                {{ __('messages.contact_support') ?? 'Contact Support' }}
            </a>
        </div>
    </aside>

    <!-- Main Area -->
    <main class="ml-64 flex-1">

        <!-- Top Bar -->
        <header class="h-20 bg-[#002147] text-white flex justify-between items-center px-8 shadow">
            <nav class="hidden md:flex gap-8 text-sm font-semibold">
                <a href="/client" class="text-yellow-300 border-b-2 border-yellow-300 pb-2">
                    {{ __('messages.overview') }}
                </a>
                <a href="#cases" class="hover:text-yellow-300">{{ __('messages.my_cases') }}</a>
                <a href="/client/evidence" class="hover:text-yellow-300">{{ __('messages.evidence') }}</a>
                <a href="/forum" class="hover:text-yellow-300">{{ __('messages.legal_forum') }}</a>
                <a href="#notifications" class="hover:text-yellow-300">{{ __('messages.notifications') }}</a>
            </nav>

            <div class="flex items-center gap-5">
                <div class="relative">
                    <span class="text-2xl">🔔</span>

                    @if(isset($notifications) && $notifications->count() > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2">
                            {{ $notifications->count() }}
                        </span>
                    @endif
                </div>

                <div class="flex gap-2">
                    <a href="/language/en" class="bg-white text-[#002147] px-3 py-1 rounded font-bold text-sm">
                        EN
                    </a>

                    <a href="/language/bn" class="bg-yellow-400 text-[#002147] px-3 py-1 rounded font-bold text-sm">
                        বাংলা
                    </a>
                </div>

                <div class="w-10 h-10 bg-white text-[#002147] rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}
                </div>

                <div>
                    <p class="font-bold">{{ $user->name ?? 'Client' }}</p>
                    <p class="text-xs text-gray-300">{{ __('messages.client') ?? 'Client' }}</p>
                </div>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto">

            <!-- Hero -->
            <section class="bg-[#002147] rounded-2xl p-10 text-white mb-8 shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-xl mb-2">{{ __('messages.welcome_back') }},</p>
                    <h1 class="text-5xl font-bold mb-4">{{ $user->name ?? 'Client' }}</h1>
                    <p class="text-gray-200">
                        {{ __('messages.client_dashboard_subtitle') ?? "Here's what's happening with your legal aid cases today." }}
                    </p>
                </div>

                <div class="absolute right-10 top-8 text-8xl opacity-20">
                    ⚖️
                </div>
            </section>

            <!-- Grant Support Card -->
            <section class="bg-white rounded-2xl shadow p-6 mb-8 border border-green-100">
                <div class="flex justify-between items-start mb-5">
                    <div>
                        <h2 class="text-2xl font-bold text-[#002147]">{{ __('messages.grant_support') }}</h2>
                        <p class="text-gray-500">
                            {{ __('messages.grant_support_subtitle') ?? 'Legal aid funding approved for your cases' }}
                        </p>
                    </div>

                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-xl font-bold">
                        ৳{{ number_format($totalGrantReceived ?? 0, 2) }}
                    </div>
                </div>

                @if(isset($grantAllocations) && $grantAllocations->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($grantAllocations->take(4) as $grant)
                            <div class="border rounded-xl p-4 bg-green-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-[#002147]">
                                            {{ __('messages.case') ?? 'Case' }} #LX-{{ $grant->case_number }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $grant->case_title }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ __('messages.fund') ?? 'Fund' }}: {{ $grant->source_name }}
                                        </p>

                                        @if($grant->note)
                                            <p class="text-xs text-gray-500 mt-2">
                                                {{ __('messages.note') ?? 'Note' }}: {{ $grant->note }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="text-right">
                                        <p class="text-xl font-bold text-green-700">
                                            ৳{{ number_format($grant->allocated_amount, 2) }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            {{ $grant->created_at }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 rounded-xl p-5 text-gray-600">
                        {{ __('messages.no_grant_support') ?? 'No grant support has been allocated yet. If you pass the means test, admin may allocate funding support to your case.' }}
                    </div>
                @endif
            </section>

            <!-- Notifications + Summary -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                <!-- Notifications -->
                <section id="notifications" class="bg-white rounded-2xl shadow p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">{{ __('messages.notifications') }}</h2>
                    </div>

                    @if(isset($notifications) && $notifications->count() > 0)
                        <div class="space-y-5">
                            @foreach($notifications->take(4) as $n)
                                <div class="flex gap-4 border-b pb-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl">
                                        📢
                                    </div>

                                    <div>
                                        <h3 class="font-bold">{{ $n->subject }}</h3>
                                        <p class="text-sm text-gray-600">{{ $n->message }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $n->created_at ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('messages.no_notifications') ?? 'No notifications yet.' }}</p>
                    @endif
                </section>

                <!-- Case Summary -->
                <section class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-2xl font-bold mb-6">{{ __('messages.case_summary') }}</h2>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="bg-blue-50 p-5 rounded-xl">
                            <div class="text-2xl mb-3">📁</div>
                            <p class="text-sm text-blue-700">{{ __('messages.total_cases') }}</p>
                            <h3 class="text-3xl font-bold">{{ $yourCases->count() ?? 0 }}</h3>
                        </div>

                        <div class="bg-green-50 p-5 rounded-xl">
                            <div class="text-2xl mb-3">📈</div>
                            <p class="text-sm text-green-700">{{ __('messages.in_progress') }}</p>
                            <h3 class="text-3xl font-bold">
                                {{ $yourCases->where('status', 'in_progress')->count() }}
                            </h3>
                        </div>

                        <div class="bg-yellow-50 p-5 rounded-xl">
                            <div class="text-2xl mb-3">⏳</div>
                            <p class="text-sm text-yellow-700">{{ __('messages.pending') }}</p>
                            <h3 class="text-3xl font-bold">
                                {{ $yourCases->where('status', 'open')->count() }}
                            </h3>
                        </div>

                        <div class="bg-red-50 p-5 rounded-xl">
                            <div class="text-2xl mb-3">✅</div>
                            <p class="text-sm text-red-700">{{ __('messages.closed') }}</p>
                            <h3 class="text-3xl font-bold">
                                {{ $yourCases->where('status', 'closed')->count() }}
                            </h3>
                        </div>
                    </div>
                </section>
            </div>

            <!-- My Cases -->
            <section id="cases" class="bg-white rounded-2xl shadow p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">{{ __('messages.my_cases') }}</h2>
                        <p class="text-gray-500">{{ __('messages.my_cases_subtitle') ?? 'Your submitted legal aid cases' }}</p>
                    </div>

                    <a href="/case/create" class="bg-[#002147] text-white px-4 py-2 rounded-lg font-bold">
                        {{ __('messages.submit_new_case') }}
                    </a>
                </div>

                @if(isset($yourCases) && $yourCases->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left text-sm">
                                    <th class="p-4">{{ __('messages.case_title') ?? 'Case Title' }}</th>
                                    <th class="p-4">{{ __('messages.case_type') ?? 'Case Type' }}</th>
                                    <th class="p-4">{{ __('messages.status') ?? 'Status' }}</th>
                                    <th class="p-4">{{ __('messages.priority') ?? 'Priority' }}</th>
                                    <th class="p-4">{{ __('messages.deadline') ?? 'Deadline' }}</th>
                                    <th class="p-4">{{ __('messages.chat') ?? 'Chat' }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($yourCases as $case)
                                    <tr class="border-b">
                                        <td class="p-4 font-semibold">{{ $case->title ?? 'N/A' }}</td>
                                        <td class="p-4">{{ $case->case_type ?? 'N/A' }}</td>

                                        <td class="p-4">
                                            <span class="px-3 py-1 rounded-full text-sm font-bold
                                                {{ ($case->status ?? '') == 'closed' ? 'bg-green-100 text-green-700' : '' }}
                                                {{ ($case->status ?? '') == 'in_progress' ? 'bg-blue-100 text-blue-700' : '' }}
                                                {{ ($case->status ?? '') == 'open' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                                {{ ucfirst(str_replace('_', ' ', $case->status ?? 'Open')) }}
                                            </span>
                                        </td>

                                        <td class="p-4">{{ ucfirst($case->priority ?? 'Medium') }}</td>
                                        <td class="p-4">{{ $case->deadline ?? 'N/A' }}</td>

                                        <td class="p-4">
                                            @if($case->lawyer_id)
                                                <a href="/chat/{{ $case->id }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-700 text-sm">
                                                    {{ __('messages.chat_with_lawyer') ?? 'Chat with Lawyer' }}
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-400">
                                                    {{ __('messages.available_after_assignment') ?? 'Available after assignment' }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500">{{ __('messages.no_cases') ?? 'No cases submitted yet.' }}</p>
                @endif
            </section>

            <!-- Appointments + Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                <!-- Appointment Card -->
                <section class="bg-white rounded-2xl shadow p-6">
                    <div class="flex justify-between items-center mb-5">
                        <div>
                            <h2 class="text-2xl font-bold">{{ __('messages.appointments') }}</h2>
                            <p class="text-gray-500">{{ __('messages.appointments_subtitle') ?? 'Book and track lawyer meetings' }}</p>
                        </div>

                        <a href="/client/appointments" class="text-blue-700 font-bold">
                            {{ __('messages.open') ?? 'Open' }}
                        </a>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b pb-3">
                            <div>
                                <h3 class="font-bold">{{ __('messages.request_appointment') ?? 'Request Appointment' }}</h3>
                                <p class="text-sm text-gray-500">{{ __('messages.request_appointment_text') ?? 'Choose lawyer, date, time and reason' }}</p>
                            </div>

                            <a href="/client/appointments" class="bg-green-100 text-green-700 px-4 py-2 rounded-lg font-bold">
                                {{ __('messages.book_now') ?? 'Book Now' }}
                            </a>
                        </div>

                        <div class="flex justify-between items-center border-b pb-3">
                            <div>
                                <h3 class="font-bold">{{ __('messages.approval_tracking') ?? 'Approval Tracking' }}</h3>
                                <p class="text-sm text-gray-500">{{ __('messages.approval_tracking_text') ?? 'See pending, approved or rejected appointments' }}</p>
                            </div>

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm">
                                {{ __('messages.active') ?? 'Active' }}
                            </span>
                        </div>
                    </div>
                </section>

                <!-- Recent Activity -->
                <section class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-2xl font-bold mb-5">{{ __('messages.recent_activity') }}</h2>

                    <div class="space-y-5">
                        @if(isset($yourCases) && $yourCases->count() > 0)
                            @foreach($yourCases->take(3) as $case)
                                <div class="flex gap-3">
                                    <div class="w-3 h-3 bg-blue-600 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm">
                                            {{ __('messages.your_case') ?? 'Your case' }}
                                            <strong>{{ $case->title }}</strong>
                                            {{ __('messages.is_currently') ?? 'is currently' }}
                                            <strong>{{ ucfirst(str_replace('_', ' ', $case->status)) }}</strong>.
                                        </p>
                                        <p class="text-xs text-gray-400">{{ __('messages.recently_updated') ?? 'Recently updated' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500">{{ __('messages.no_recent_activity') ?? 'No recent activity.' }}</p>
                        @endif
                    </div>
                </section>
            </div>

            <!-- Quick Actions -->
            <section class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-2xl font-bold mb-5">{{ __('messages.quick_actions') }}</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    <a href="/case/create" class="bg-blue-50 p-5 rounded-xl text-center font-bold hover:bg-blue-100">
                        📄<br>{{ __('messages.submit_new_case') }}
                    </a>

                    <a href="/client/appointments" class="bg-green-50 p-5 rounded-xl text-center font-bold hover:bg-green-100">
                        📅<br>{{ __('messages.appointments') }}
                    </a>

                    <a href="/client/evidence" class="bg-purple-50 p-5 rounded-xl text-center font-bold hover:bg-purple-100">
                        ☁️<br>{{ __('messages.upload_evidence') ?? 'Upload Evidence' }}
                    </a>

                    <a href="/client/payments" class="bg-pink-50 p-5 rounded-xl text-center font-bold hover:bg-pink-100">
                        💳<br>{{ __('messages.payments') ?? 'Payments' }}
                    </a>

                    <a href="/client/sos" class="bg-red-50 p-5 rounded-xl text-center font-bold text-red-600 hover:bg-red-100">
                        🚨<br>{{ __('messages.emergency_sos') }}
                    </a>
                </div>
            </section>

        </div>

        <!-- Footer -->
        <footer class="bg-[#002147] text-white px-8 py-5 flex justify-between text-sm">
            <p>© 2025 LexAid. {{ __('messages.all_rights_reserved') ?? 'All rights reserved.' }}</p>
            <p>{{ __('messages.privacy_policy') ?? 'Privacy Policy' }} | {{ __('messages.terms_conditions') ?? 'Terms & Conditions' }}</p>
        </footer>

    </main>
</div>

</body>
</html>