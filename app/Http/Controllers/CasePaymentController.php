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
}