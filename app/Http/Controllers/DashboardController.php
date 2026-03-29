<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function clientDashboard()
    {
        if (session('user_role') !== 'client') {
            return redirect('/login')->with('error', 'Access denied');
        }

        $yourCases = DB::table('cases')
            ->where('client_id', session('user_id'))
            ->orderByDesc('created_at')
            ->get();

        return view('client_dashboard', compact('yourCases'));
    }

    public function lawyerDashboard()
    {
        if (session('user_role') !== 'lawyer') {
            return redirect('/login')->with('error', 'Access denied');
        }

        $yourCases = DB::table('cases')
            ->where('lawyer_id', session('user_id'))
            ->orderByDesc('created_at')
            ->get();

        $allCases = DB::table('cases')
            ->orderByDesc('created_at')
            ->get();

        return view('lawyer_dashboard', compact('yourCases', 'allCases'));
    }

    public function adminDashboard()
    {
        if (session('user_role') !== 'admin') {
            return redirect('/login')->with('error', 'Access denied');
        }

        $allCases = DB::table('cases')
            ->orderByDesc('created_at')
            ->get();

        return view('admin_dashboard', compact('allCases'));
    }
}