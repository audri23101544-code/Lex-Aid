<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PerformanceController extends Controller
{
    public function index()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        // Case stats
        $totalCases = DB::table('cases')->count();
        $openCases = DB::table('cases')->where('status', 'open')->count();
        $inProgressCases = DB::table('cases')->where('status', 'in_progress')->count();
        $closedCases = DB::table('cases')->where('status', 'closed')->count();

        // User stats
        $totalClients = DB::table('users')->where('role', 'client')->count();
        $totalLawyers = DB::table('users')->where('role', 'lawyer')->count();

        // SOS stats
        $totalSos = DB::table('sos_requests')->count();
        $pendingSos = DB::table('sos_requests')->where('status', 'pending')->count();

        // Lawyer workload
        $lawyerWorkload = DB::table('users')
            ->where('role', 'lawyer')
            ->leftJoin('cases', 'users.id', '=', 'cases.lawyer_id')
            ->select(
                'users.name',
                DB::raw('COUNT(cases.id) as total_cases')
            )
            ->groupBy('users.id', 'users.name')
            ->get();

        return view('performance_dashboard', compact(
            'user',
            'totalCases',
            'openCases',
            'inProgressCases',
            'closedCases',
            'totalClients',
            'totalLawyers',
            'totalSos',
            'pendingSos',
            'lawyerWorkload'
        ));
    }
}
