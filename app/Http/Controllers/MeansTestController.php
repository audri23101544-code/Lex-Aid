<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MeansTestController extends Controller
{
    private function calculateEligibility($monthlyIncome, $familyMembers, $totalAssets, $employmentStatus)
    {
        $score = 100;

        // Income rule: larger family gets higher allowed income threshold
        $incomeThreshold = 25000 + (($familyMembers - 1) * 5000);

        if ($monthlyIncome <= $incomeThreshold) {
            $score -= 0;
        } elseif ($monthlyIncome <= ($incomeThreshold + 15000)) {
            $score -= 30;
        } else {
            $score -= 55;
        }

        // Asset rule
        if ($totalAssets <= 50000) {
            $score -= 0;
        } elseif ($totalAssets <= 150000) {
            $score -= 25;
        } else {
            $score -= 45;
        }

        // Employment rule
        $employmentStatus = strtolower($employmentStatus ?? '');

        if ($employmentStatus == 'unemployed') {
            $score += 10;
        } elseif ($employmentStatus == 'student') {
            $score += 5;
        } elseif ($employmentStatus == 'employed') {
            $score -= 5;
        }

        if ($score >= 70) {
            return ['result' => 'eligible', 'score' => $score];
        } elseif ($score >= 45) {
            return ['result' => 'partially_eligible', 'score' => $score];
        }

        return ['result' => 'not_eligible', 'score' => $score];
    }

    public function create()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'client') {
            return redirect('/login');
        }

        $latestTest = DB::table('means_tests')
            ->where('client_id', $user->id)
            ->latest('id')
            ->first();

        return view('means_test', compact('user', 'latestTest'));
    }

    public function store(Request $request)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'client') {
            return redirect('/login');
        }

        $request->validate([
            'monthly_income' => 'required|numeric|min:0',
            'family_members' => 'required|integer|min:1',
            'employment_status' => 'required',
            'total_assets' => 'required|numeric|min:0'
        ]);

        $calculation = $this->calculateEligibility(
            $request->monthly_income,
            $request->family_members,
            $request->total_assets,
            $request->employment_status
        );

        DB::table('means_tests')->insert([
            'client_id' => $user->id,
            'monthly_income' => $request->monthly_income,
            'family_members' => $request->family_members,
            'employment_status' => $request->employment_status,
            'total_assets' => $request->total_assets,
            'result' => $calculation['result'],
            'score' => $calculation['score'],
            'notes' => $request->notes
        ]);

        return redirect('/client/means-test')->with('success', 'Means test submitted successfully.');
    }

    public function adminIndex()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        $tests = DB::table('means_tests')
            ->join('users', 'means_tests.client_id', '=', 'users.id')
            ->select('means_tests.*', 'users.name as client_name', 'users.email as client_email')
            ->latest('means_tests.id')
            ->get();

        $eligibleCount = $tests->where('result', 'eligible')->count();
        $partialCount = $tests->where('result', 'partially_eligible')->count();
        $notEligibleCount = $tests->where('result', 'not_eligible')->count();
        $sources = DB::table('funding_sources')->get();

       
        $cases = DB::table('cases')
            ->leftJoin('users', 'cases.client_id', '=', 'users.id')
            ->select('cases.*', 'users.name as client_name')
            ->latest('cases.id')
            ->get();
        return view('admin_means_tests', compact(
            'user',
            'tests',
            'eligibleCount',
            'partialCount',
            'notEligibleCount',
            'sources',
            'cases'
        ));
    }
}
