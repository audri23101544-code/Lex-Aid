<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CaseController extends Controller
{
    public function create()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'client') {
            return redirect('/login');
        }

        return view('submit_case', compact('user'));
    }

    private function calculatePriority($caseType, $description, $deadline)
    {
        $score = 0;

        // Deadline scoring
        if (!empty($deadline)) {
            $today = Carbon::now()->startOfDay();
            $deadlineDate = Carbon::parse($deadline)->startOfDay();

            $daysLeft = $today->diffInDays($deadlineDate, false);

            if ($daysLeft <= 3) {
                $score += 40;
            } elseif ($daysLeft <= 7) {
                $score += 25;
            } elseif ($daysLeft <= 14) {
                $score += 10;
            }
        }

        // Case type scoring
        $caseType = strtolower($caseType ?? '');

        if (
            str_contains($caseType, 'criminal') ||
            str_contains($caseType, 'domestic') ||
            str_contains($caseType, 'violence') ||
            str_contains($caseType, 'harassment') ||
            str_contains($caseType, 'family') ||
            str_contains($caseType, 'abuse') ||
            str_contains($caseType, 'rape') ||
            str_contains($caseType, 'assault')
        ) {
            $score += 30;
        }

        // Description scoring
        $description = strtolower($description ?? '');

        if (
            str_contains($description, 'urgent') ||
            str_contains($description, 'emergency') ||
            str_contains($description, 'threat') ||
            str_contains($description, 'violence') ||
            str_contains($description, 'arrest') ||
            str_contains($description, 'danger') ||
            str_contains($description, 'abuse') ||
            str_contains($description, 'rape') ||
            str_contains($description, 'assault') ||
            str_contains($description, 'eviction')
        ) {
            $score += 20;
        }

        // Newly opened case
        $score += 10;

        if ($score >= 60) {
            return 'high';
        } elseif ($score >= 30) {
            return 'medium';
        } else {
            return 'low';
        }
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
            'title' => 'required',
            'description' => 'required',
            'case_type' => 'required',
            'location' => 'required',
            'deadline' => 'required|date'
        ]);

        $priority = $this->calculatePriority(
            $request->case_type,
            $request->description,
            $request->deadline
        );

        DB::table('cases')->insert([
            'client_id' => $user->id,
            'lawyer_id' => null,
            'title' => $request->title,
            'description' => $request->description,
            'case_type' => $request->case_type,
            'status' => 'open',
            'priority' => $priority,
            'location' => $request->location,
            'deadline' => $request->deadline
        ]);

        return redirect('/client')->with('success', 'Case submitted successfully. Priority: ' . ucfirst($priority));
    }

    public function index()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role == 'admin') {
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
        } elseif ($user->role == 'lawyer') {
            $cases = DB::table('cases')
                ->where('lawyer_id', $user->id)
                ->latest('id')
                ->get();
        } else {
            $cases = DB::table('cases')
                ->where('client_id', $user->id)
                ->latest('id')
                ->get();
        }

        return view('cases', compact('user', 'cases'));
    }

    public function adminCases()
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

        $lawyers = DB::table('users')
            ->where('role', 'lawyer')
            ->orderBy('name')
            ->get();

        return view('admin_cases', compact('user', 'cases', 'lawyers'));
    }

    public function assignLawyer(Request $request, $id)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        $request->validate([
            'lawyer_id' => 'required|exists:users,id',
        ]);

        $lawyer = DB::table('users')
            ->where('id', $request->lawyer_id)
            ->where('role', 'lawyer')
            ->first();

        if (!$lawyer) {
            return back()->with('error', 'Selected user is not a lawyer.');
        }

        DB::table('cases')
            ->where('id', $id)
            ->update([
                'lawyer_id' => $request->lawyer_id,
                'status' => 'in_progress',
            ]);

        return back()->with('success', 'Lawyer assigned successfully.');
    }

    public function completeCase($id)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'lawyer') {
            return redirect('/login');
        }

        $case = DB::table('cases')
            ->where('id', $id)
            ->where('lawyer_id', $user->id)
            ->first();

        if (!$case) {
            return back()->with('error', 'Case not found or not assigned to you.');
        }

        DB::table('cases')
            ->where('id', $id)
            ->where('lawyer_id', $user->id)
            ->update([
                'status' => 'closed',
            ]);

        return back()->with('success', 'Case marked as completed successfully.');
    }
}