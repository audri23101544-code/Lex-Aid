<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PriorityController extends Controller
{
    private function calculatePriority($case)
    {
        $score = 0;

        // Deadline urgency
        if (!empty($case->deadline)) {
            $daysLeft = Carbon::now()->diffInDays(Carbon::parse($case->deadline), false);

            if ($daysLeft <= 3) {
                $score += 40;
            } elseif ($daysLeft <= 7) {
                $score += 25;
            } elseif ($daysLeft <= 14) {
                $score += 10;
            }
        }

        // Case type urgency
        $caseType = strtolower($case->case_type ?? '');

        $urgentTypes = [
            'criminal',
            'domestic',
            'violence',
            'abuse',
            'harassment',
            'emergency',
            'family',
            'rape',
            'assault'
        ];

        foreach ($urgentTypes as $type) {
            if (str_contains($caseType, $type)) {
                $score += 30;
                break;
            }
        }

        // Description urgency keywords
        $description = strtolower($case->description ?? '');

        $urgentWords = [
            'urgent',
            'emergency',
            'arrest',
            'violence',
            'threat',
            'abuse',
            'rape',
            'assault',
            'danger',
            'eviction',
            'court tomorrow'
        ];

        foreach ($urgentWords as $word) {
            if (str_contains($description, $word)) {
                $score += 20;
                break;
            }
        }

        // Open cases get slight priority
        if (($case->status ?? '') == 'open') {
            $score += 10;
        }

        if ($score >= 60) {
            return ['priority' => 'high', 'score' => $score];
        } elseif ($score >= 30) {
            return ['priority' => 'medium', 'score' => $score];
        } else {
            return ['priority' => 'low', 'score' => $score];
        }
    }

    public function index()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        $cases = DB::table('cases')
            ->leftJoin('users as clients', 'cases.client_id', '=', 'clients.id')
            ->leftJoin('users as lawyers', 'cases.lawyer_id', '=', 'lawyers.id')
            ->select(
                'cases.*',
                'clients.name as client_name',
                'lawyers.name as lawyer_name'
            )
            ->latest('cases.id')
            ->get();

        foreach ($cases as $case) {
            $result = $this->calculatePriority($case);
            $case->calculated_priority = $result['priority'];
            $case->priority_score = $result['score'];
        }

        $highCount = $cases->where('priority', 'high')->count();
        $mediumCount = $cases->where('priority', 'medium')->count();
        $lowCount = $cases->where('priority', 'low')->count();

        return view('priority_dashboard', compact(
            'user',
            'cases',
            'highCount',
            'mediumCount',
            'lowCount'
        ));
    }

    public function updateOne($id)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        $case = DB::table('cases')->where('id', $id)->first();

        if (!$case) {
            return back()->with('error', 'Case not found.');
        }

        $result = $this->calculatePriority($case);

        DB::table('cases')
            ->where('id', $id)
            ->update([
                'priority' => $result['priority']
            ]);

        return back()->with('success', 'Priority updated successfully.');
    }

    public function updateAll()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        $cases = DB::table('cases')->get();

        foreach ($cases as $case) {
            $result = $this->calculatePriority($case);

            DB::table('cases')
                ->where('id', $case->id)
                ->update([
                    'priority' => $result['priority']
                ]);
        }

        return back()->with('success', 'All case priorities recalculated successfully.');
    }
}