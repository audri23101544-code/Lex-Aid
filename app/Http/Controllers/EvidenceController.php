<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EvidenceController extends Controller
{
    public function index()
    {
        if (!Session::has('user')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $user = Session::get('user');

        if ($user->role !== 'client') {
            return redirect('/dashboard')->with('error', 'Only clients can access evidence upload.');
        }

        $cases = DB::table('cases')
            ->where('client_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $documents = DB::table('documents')
            ->join('cases', 'documents.case_id', '=', 'cases.id')
            ->where('cases.client_id', $user->id)
            ->select(
                'documents.*',
                'cases.title as case_title',
                'cases.case_type'
            )
            ->orderBy('documents.uploaded_at', 'desc')
            ->get();

        return view('client_evidence', compact('cases', 'documents'));
    }

    public function upload(Request $request)
    {
        if (!Session::has('user')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $user = Session::get('user');

        if ($user->role !== 'client') {
            return redirect('/dashboard')->with('error', 'Only clients can upload evidence.');
        }

        $request->validate([
            'case_id' => 'required|exists:cases,id',
            'evidence_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $case = DB::table('cases')
            ->where('id', $request->case_id)
            ->where('client_id', $user->id)
            ->first();

        if (!$case) {
            return back()->with('error', 'Invalid case selected.');
        }

        $file = $request->file('evidence_file');
        $path = $file->store('evidence', 'public');

        DB::table('documents')->insert([
            'case_id' => $request->case_id,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'uploaded_at' => now(),
        ]);

        DB::table('case_history')->insert([
            'case_id' => $request->case_id,
            'status' => 'Evidence uploaded',
            'updated_at' => now(),
        ]);

        return redirect('/client/evidence')->with('success', 'Evidence uploaded successfully.');
    }
}