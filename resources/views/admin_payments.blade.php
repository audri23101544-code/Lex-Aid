<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Admin Payment Monitoring</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen text-[#002147]">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">LexAid Admin Panel</h1>
    <nav class="flex gap-6">
        <a href="/admin" class="hover:text-[#FCD353]">Dashboard</a>
        <a href="/admin/payments" class="text-[#FCD353] font-bold">Payments</a>
        <a href="/admin/cases" class="hover:text-[#FCD353]">Cases</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-7xl mx-auto py-10 px-6">

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold">Payment Monitoring</h2>
            <p class="text-slate-600 mt-2">
                Monitor lawyer-set case fees, pending client payments, and completed mock bKash payments.
            </p>
        </div>

        <a href="/admin" class="bg-blue-800 text-white px-5 py-3 rounded font-bold hover:bg-blue-900">
            Back to Admin Dashboard
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-slate-500">Total Amount</p>
            <h3 class="text-2xl font-bold mt-2">৳{{ number_format($totalAmount ?? 0, 2) }}</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-slate-500">Paid Amount</p>
            <h3 class="text-2xl font-bold mt-2 text-green-700">৳{{ number_format($paidAmount ?? 0, 2) }}</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-slate-500">Pending Amount</p>
            <h3 class="text-2xl font-bold mt-2 text-yellow-700">৳{{ number_format($pendingAmount ?? 0, 2) }}</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-slate-500">Paid Payments</p>
            <h3 class="text-2xl font-bold mt-2 text-green-700">{{ $paidCount ?? 0 }}</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-slate-500">Pending Payments</p>
            <h3 class="text-2xl font-bold mt-2 text-yellow-700">{{ $pendingCount ?? 0 }}</h3>
        </div>
    </div>

    <section class="bg-white rounded-xl shadow p-6">
        <h3 class="text-xl font-bold mb-4">All Case Payments</h3>

        @if($payments->count() === 0)
            <p class="text-slate-600">No payment records found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-200 text-left text-sm">
                            <th class="p-3">Payment ID</th>
                            <th class="p-3">Case</th>
                            <th class="p-3">Client</th>
                            <th class="p-3">Lawyer</th>
                            <th class="p-3">Amount</th>
                            <th class="p-3">Case Status</th>
                            <th class="p-3">Payment Status</th>
                            <th class="p-3">Method</th>
                            <th class="p-3">Transaction ID</th>
                            <th class="p-3">Paid At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr class="border-b align-top">
                                <td class="p-3">#{{ $payment->id }}</td>
                                <td class="p-3">
                                    <div class="font-bold text-[#002147]">{{ $payment->case_title }}</div>
                                    <div class="text-xs text-slate-500">{{ $payment->case_type ?? 'N/A' }}</div>
                                </td>
                                <td class="p-3">{{ $payment->client_name }}</td>
                                <td class="p-3">{{ $payment->lawyer_name }}</td>
                                <td class="p-3 font-bold">৳{{ number_format($payment->amount, 2) }}</td>
                                <td class="p-3">
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ ucfirst(str_replace('_', ' ', $payment->case_status ?? 'open')) }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    @if($payment->status === 'paid')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                            Paid
                                        </span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3">{{ $payment->payment_method ?? 'N/A' }}</td>
                                <td class="p-3">{{ $payment->transaction_id ?? 'N/A' }}</td>
                                <td class="p-3">{{ $payment->paid_at ?? 'N/A' }}</td>
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