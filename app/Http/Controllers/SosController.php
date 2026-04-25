<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SosController extends Controller
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

        return view('sos_create', compact('user'));
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
            'emergency_type' => 'required',
            'description' => 'required',
            'location' => 'required',
            'phone' => 'required'
        ]);

        DB::table('sos_requests')->insert([
            'client_id' => $user->id,
            'client_name' => $user->name,
            'client_email' => $user->email,
            'emergency_type' => $request->emergency_type,
            'description' => $request->description,
            'location' => $request->location,
            'phone' => $request->phone,
            'status' => 'pending'
        ]);

        return redirect('/client/sos')->with('success', 'Emergency SOS request submitted successfully.');
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

        $sosRequests = DB::table('sos_requests')
            ->latest('id')
            ->get();

        return view('admin_sos', compact('user', 'sosRequests'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        DB::table('sos_requests')
            ->where('id', $id)
            ->update([
                'status' => $request->status
            ]);

        return redirect('/admin/sos')->with('success', 'SOS request status updated.');
    }
}
