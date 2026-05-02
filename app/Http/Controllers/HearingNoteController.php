<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HearingNoteController extends Controller
{
    public function index()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'lawyer') {
            return redirect('/login');
        }

        $cases = DB::table('cases')
            ->leftJoin('users as clients', 'cases.client_id', '=', 'clients.id')
            ->where('cases.lawyer_id', $user->id)
            ->select(
                'cases.*',
                'clients.name as client_name'
            )
            ->latest('cases.id')
            ->get();

        $notes = DB::table('hearing_notes')
            ->join('cases', 'hearing_notes.case_id', '=', 'cases.id')
            ->join('users as clients', 'cases.client_id', '=', 'clients.id')
            ->where('hearing_notes.lawyer_id', $user->id)
            ->select(
                'hearing_notes.*',
                'cases.title as case_title',
                'cases.case_type',
                'clients.name as client_name'
            )
            ->latest('hearing_notes.id')
            ->get();

        return view('lawyer_hearing_notes', compact('user', 'cases', 'notes'));
    }

    public function store(Request $request)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'lawyer') {
            return redirect('/login');
        }

        $request->validate([
            'case_id' => 'required|exists:cases,id',
            'hearing_date' => 'nullable|date',
            'note' => 'required|string',
        ]);

        $case = DB::table('cases')
            ->where('id', $request->case_id)
            ->where('lawyer_id', $user->id)
            ->first();

        if (!$case) {
            return back()->with('error', 'Invalid case selected.');
        }

        DB::table('hearing_notes')->insert([
            'case_id' => $request->case_id,
            'lawyer_id' => $user->id,
            'hearing_date' => $request->hearing_date,
            'note' => $request->note,
            'created_at' => now(),
        ]);

        return redirect('/lawyer/hearing-notes')->with('success', 'Hearing note saved successfully.');
    }
}