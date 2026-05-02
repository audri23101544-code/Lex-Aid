<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LexAid | Client Payments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen text-[#002147]">

<header class="bg-[#002147] text-white px-8 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-[#FCD353]">LexAid Client Portal</h1>
    <nav class="flex gap-6">
        <a href="/client" class="hover:text-[#FCD353]">Dashboard</a>
        <a href="/client/payments" class="text-[#FCD353] font-bold">Payments</a>
        <a href="/logout" class="hover:text-[#FCD353]">Logout</a>
    </nav>
</header>

<main class="max-w-7xl mx-auto py-10 px-6">

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold">Case Payments</h2>
            <p class="text-slate-600 mt-2">
                View lawyer-set case fees and complete payment using mock bKash.
            </p>
        </div>

        <a href="/client" class="bg-blue-800 text-white px-5 py-3 rounded font-bold hover:bg-blue-900">
            Back to Client Dashboard
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
        <h3 class="text-xl font-bold mb-4">Payment Requests</h3>

        @if($payments->count() === 0)
            <p class="text-slate-600">No payment requests found yet.</p>
        @else
            <div class="space-y-6">
                @foreach($payments as $payment)
                    <div class="border rounded-xl p-5 hover:bg-slate-50">
                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-6">
                            <div>
                                <h4 class="text-xl font-bold text-[#002147]">
                                    {{ $payment->case_title }}
                                </h4>

                                <p class="text-sm text-slate-500 mt-1">
                                    Lawyer: {{ $payment->lawyer_name ?? 'N/A' }}
                                    · Type: {{ $payment->case_type ?? 'N/A' }}
                                    · Case Status: {{ ucfirst(str_replace('_', ' ', $payment->case_status ?? 'open')) }}
                                </p>

                                <p class="text-2xl font-bold text-green-700 mt-4">
                                    ৳{{ number_format($payment->amount, 2) }}
                                </p>

                                <p class="mt-2">
                                    Payment Status:
                                    @if($payment->status === 'paid')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                                            Paid
                                        </span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-bold">
                                            Pending
                                        </span>
                                    @endif
                                </p>

                                @if($payment->status === 'paid')
                                    <p class="text-sm text-slate-500 mt-2">
                                        Method: {{ $payment->payment_method }}
                                        · Transaction ID: {{ $payment->transaction_id }}
                                        · Paid At: {{ $payment->paid_at }}
                                    </p>
                                @endif
                            </div>

                            <div class="w-full lg:w-96">
                                @if($payment->status !== 'paid')
                                    <form method="POST" action="/client/payments/{{ $payment->id }}/bkash" class="bg-pink-50 border border-pink-100 rounded-xl p-5">
                                        @csrf

                                        <h5 class="font-bold text-pink-700 mb-3">Pay with bKash</h5>

                                        <div class="mb-3">
                                            <label class="block text-sm font-bold mb-1">bKash Number</label>
                                            <input type="text"
                                                   name="bkash_number"
                                                   class="w-full border rounded p-3"
                                                   placeholder="01XXXXXXXXX"
                                                   required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="block text-sm font-bold mb-1">Transaction ID</label>
                                            <input type="text"
                                                   name="transaction_id"
                                                   class="w-full border rounded p-3"
                                                   placeholder="Mock transaction ID"
                                                   required>
                                        </div>

                                        <button type="submit" class="w-full bg-pink-600 text-white py-3 rounded font-bold hover:bg-pink-700">
                                            Confirm Mock bKash Payment
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-green-50 border border-green-100 rounded-xl p-5 text-green-700 font-bold">
                                        Payment completed successfully.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</main>

</body>
</html>