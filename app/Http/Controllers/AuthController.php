<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function adminDashboard()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        $totalCases = DB::table('cases')->count();
        $totalUsers = DB::table('users')->count();
        $totalLawyers = DB::table('users')->where('role', 'lawyer')->count();
        $recentCases = DB::table('cases')->latest('id')->take(5)->get();
        $allCases = DB::table('cases')->latest('id')->get();

        $sosRequests = DB::table('sos_requests')->latest('id')->take(5)->get();
        $totalSos = DB::table('sos_requests')->count();
        $pendingSos = DB::table('sos_requests')->where('status', 'pending')->count();

        return view('admin_dashboard', compact(
            'user',
            'totalCases',
            'totalUsers',
            'totalLawyers',
            'recentCases',
            'allCases',
            'sosRequests',
            'totalSos',
            'pendingSos'
        ));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('user', $user);

            if ($user->role == 'admin') {
                return redirect('/admin');
            } elseif ($user->role == 'lawyer') {
                return redirect('/lawyer');
            } else {
                return redirect('/client');
            }
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

public function clientDashboard()
{
    if (!Session::has('user')) {
        return redirect('/login');
    }

    $user = Session::get('user');

    if ($user->role != 'client') {
        return redirect('/login');
    }

    $yourCases = DB::table('cases')
        ->where('client_id', $user->id)
        ->latest('id')
        ->get();

    $notifications = DB::table('user_notifications')
        ->where('user_id', $user->id)
        ->latest('id')
        ->get();

    return view('client_dashboard', compact(
        'user',
        'yourCases',
        'notifications'
    ));
}

    public function lawyerDashboard()
{
    if (!Session::has('user')) {
        return redirect('/login');
    }

    $user = Session::get('user');

    if ($user->role != 'lawyer') {
        return redirect('/login');
    }
    $notifications = DB::table('user_notifications')
        ->where('user_id', $user->id)
        ->latest('id')
        ->get();
    $allCases = DB::table('cases')
        ->where('lawyer_id', $user->id)
        ->latest('id')
        ->get();

    $totalCases = $allCases->count();

    $openCases = DB::table('cases')
        ->where('lawyer_id', $user->id)
        ->where('status', 'open')
        ->count();

    $inProgressCases = DB::table('cases')
        ->where('lawyer_id', $user->id)
        ->where('status', 'in_progress')
        ->count();

    $closedCases = DB::table('cases')
        ->where('lawyer_id', $user->id)
        ->where('status', 'closed')
        ->count();

    $sosRequests = DB::table('sos_requests')
        ->whereIn('status', ['pending', 'reviewing'])
        ->latest('id')
        ->take(5)
        ->get();

    $totalSos = DB::table('sos_requests')
        ->whereIn('status', ['pending', 'reviewing'])
        ->count();

    return view('lawyer_dashboard', compact(
    'user',
    'allCases',
    'totalCases',
    'openCases',
    'inProgressCases',
    'closedCases',
    'sosRequests',
    'totalSos',
    'notifications'
    ));
}

    public function dashboard()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');
        return view('dashboard', compact('user'));
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }
}