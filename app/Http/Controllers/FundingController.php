<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FundingController extends Controller
{
    public function index()
    {
        if (!Session::has('user')) return redirect('/login');

        $user = Session::get('user');

        if ($user->role != 'admin') return redirect('/login');

        $sources = DB::table('funding_sources')->get();

        $totalFunding = DB::table('funding_sources')->sum('total_amount');

        $allocated = DB::table('funding_allocations')->sum('allocated_amount');

        $remaining = $totalFunding - $allocated;

        $allocations = DB::table('funding_allocations')
            ->join('cases', 'funding_allocations.case_id', '=', 'cases.id')
            ->join('funding_sources', 'funding_allocations.funding_source_id', '=', 'funding_sources.id')
            ->select(
                'funding_allocations.*',
                'cases.title',
                'funding_sources.source_name'
            )
            ->latest('funding_allocations.id')
            ->get();

        return view('funding_dashboard', compact(
            'user',
            'sources',
            'allocations',
            'totalFunding',
            'allocated',
            'remaining'
        ));
    }
    public function allocateFromMeansTest(Request $request)
{
    if (!Session::has('user')) {
        return redirect('/login');
    }

    $user = Session::get('user');

    if ($user->role != 'admin') {
        return redirect('/login');
    }

    $request->validate([
        'funding_source_id' => 'required',
        'case_id' => 'required',
        'allocated_amount' => 'required|numeric|min:1',
        'note' => 'nullable'
    ]);

    $source = DB::table('funding_sources')
        ->where('id', $request->funding_source_id)
        ->first();

    if (!$source) {
        return back()->with('error', 'Funding source not found.');
    }

    $totalAllocatedFromSource = DB::table('funding_allocations')
        ->where('funding_source_id', $request->funding_source_id)
        ->sum('allocated_amount');

    $remainingForSource = $source->total_amount - $totalAllocatedFromSource;

    if ($request->allocated_amount > $remainingForSource) {
        return back()->with('error', 'Not enough remaining balance in this funding source.');
    }

    $case = DB::table('cases')
        ->where('id', $request->case_id)
        ->first();

    if (!$case) {
        return back()->with('error', 'Selected case not found.');
    }

    DB::table('funding_allocations')->insert([
        'funding_source_id' => $request->funding_source_id,
        'case_id' => $request->case_id,
        'allocated_amount' => $request->allocated_amount,
        'note' => $request->note
    ]);
    $case = DB::table('cases')
    ->where('id', $request->case_id)
    ->first();

    if ($case) {
        DB::table('user_notifications')->insert([
            'user_id' => $case->client_id,
            'subject' => 'Grant Funding Approved',
            'message' => 'Admin has allocated ৳' . number_format($request->allocated_amount, 2) . ' grant support for your case #' . $request->case_id . '.'
        ]);
}

    return back()->with('success', 'Grant allocated successfully to case #' . $request->case_id);
}
    public function storeSource(Request $request)
    {
        DB::table('funding_sources')->insert([
            'source_name' => $request->source_name,
            'total_amount' => $request->total_amount,
            'description' => $request->description
        ]);

        return back();
    }

    public function allocate(Request $request)
    {
        DB::table('funding_allocations')->insert([
            'funding_source_id' => $request->funding_source_id,
            'case_id' => $request->case_id,
            'allocated_amount' => $request->allocated_amount,
            'note' => $request->note
        ]);

        return back();
    }
}