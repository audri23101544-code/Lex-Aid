<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= REGISTER =================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nid' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed',
            'role' => 'required|in:client,lawyer,admin'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'nid' => $request->nid,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect('/login')->with('success', 'Registration Successful! Please login.');
    }

    // ================= LOGIN =================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = DB::table('users')
            ->where('email', $request->email)
            ->where('role', $request->role)
            ->first();

        // ❌ User not found
        if (!$user) {
            return back()->with('error', 'User not found');
        }

        // ❌ Wrong password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Wrong password');
        }

        // ✅ SESSION (VERY IMPORTANT)
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role
        ]);

        // ✅ ROLE BASED REDIRECT
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'lawyer') {
            return redirect('/lawyer/dashboard');
        } else {
            return redirect('/client/dashboard');
        }
    }

    // ================= LOGOUT =================
    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}