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

    return view('admin_dashboard', compact('user', 'totalCases', 'totalUsers', 'totalLawyers', 'recentCases'));
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