<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
    public function showForm()
    {
        return view('submit_case');
    }

    public function submitCase(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'case_type' => 'required|in:Criminal,Civil,Family',
            'priority' => 'required|in:Low,Medium,High',
            'location' => 'required|string|max:255',
            'deadline' => 'required|date|after_or_equal:today'
        ]);

        $status = 'pending'; // mapped to takeover for existing enum mapping
        $priority = strtolower($request->priority); // unify values to match enum

        DB::table('cases')->insert([
            'client_id' => session('user_id'),
            'lawyer_id' => null,
            'title' => $request->title,
            'description' => $request->description,
            'case_type' => $request->case_type,
            'status' => $status,
            'priority' => $priority,
            'location' => $request->location,
            'deadline' => $request->deadline,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/submit-case')->with('success', 'Case submitted successfully ✅');
    }

    public function showCase($id)
    {
        $case = DB::table('cases')
            ->where('cases.id', $id)
            ->join('users as client', 'cases.client_id', '=', 'client.id')
            ->leftJoin('users as lawyer', 'cases.lawyer_id', '=', 'lawyer.id')
            ->select('cases.*', 'client.name as client_name', 'client.email as client_email', 'lawyer.name as lawyer_name')
            ->first();

        if (!$case) {
            return redirect('/admin/dashboard')->with('error', 'Case not found');
        }

        if (session('user_role') !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return view('case_detail', compact('case'));
    }
}