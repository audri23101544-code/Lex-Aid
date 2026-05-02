<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CasePaymentController extends Controller
{
    public function setAmount(Request $request, $caseId)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'lawyer') {
            return redirect('/login');
        }

        $request->validate([
            'amount' => 'required|numeric|min:1|max:99999999',
        ]);

        $case = DB::table('cases')
            ->where('id', $caseId)
            ->where('lawyer_id', $user->id)
            ->first();

        if (!$case) {
            return back()->with('error', 'Case not found or not assigned to you.');
        }

        $existingPayment = DB::table('case_payments')
            ->where('case_id', $caseId)
            ->first();

        if ($existingPayment) {
            DB::table('case_payments')
                ->where('case_id', $caseId)
                ->update([
                    'amount' => $request->amount,
                    'client_id' => $case->client_id,
                    'lawyer_id' => $user->id,
                    'status' => $existingPayment->status ?? 'pending',
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('case_payments')->insert([
                'case_id' => $caseId,
                'client_id' => $case->client_id,
                'lawyer_id' => $user->id,
                'amount' => $request->amount,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Case payment amount saved successfully.');
    }

    public function clientPayments()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'client') {
            return redirect('/login');
        }

        $payments = DB::table('case_payments')
            ->join('cases', 'case_payments.case_id', '=', 'cases.id')
            ->join('users as lawyers', 'case_payments.lawyer_id', '=', 'lawyers.id')
            ->where('case_payments.client_id', $user->id)
            ->select(
                'case_payments.*',
                'cases.title as case_title',
                'cases.case_type',
                'cases.status as case_status',
                'lawyers.name as lawyer_name'
            )
            ->latest('case_payments.id')
            ->get();

        return view('client_payments', compact('user', 'payments'));
    }

    public function payWithBkash(Request $request, $paymentId)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'client') {
            return redirect('/login');
        }

        $request->validate([
            'bkash_number' => 'required|string|max:20',
            'transaction_id' => 'required|string|max:100',
        ]);

        $payment = DB::table('case_payments')
            ->where('id', $paymentId)
            ->where('client_id', $user->id)
            ->first();

        if (!$payment) {
            return back()->with('error', 'Payment record not found.');
        }

        if ($payment->status === 'paid') {
            return back()->with('error', 'This payment is already completed.');
        }

        DB::table('case_payments')
            ->where('id', $paymentId)
            ->where('client_id', $user->id)
            ->update([
                'status' => 'paid',
                'payment_method' => 'bKash Mock',
                'transaction_id' => $request->transaction_id,
                'paid_at' => now(),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Payment completed successfully via mock bKash.');
    }
}