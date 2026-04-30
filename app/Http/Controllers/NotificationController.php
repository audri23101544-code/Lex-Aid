<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
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

        $notifications = DB::table('bulk_notifications')
            ->latest('id')
            ->get();

        return view('bulk_notifications', compact('user', 'notifications'));
    }

    public function send(Request $request)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $admin = Session::get('user');

        if ($admin->role != 'admin') {
            return redirect('/login');
        }

        $request->validate([
            'target_group' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if ($request->target_group == 'all') {
            $users = DB::table('users')->get();
        } else {
            $users = DB::table('users')
                ->where('role', $request->target_group)
                ->get();
        }

        DB::table('bulk_notifications')->insert([
            'target_group' => $request->target_group,
            'subject' => $request->subject,
            'message' => $request->message,
            'total_recipients' => $users->count()
        ]);

        foreach ($users as $user) {
            DB::table('user_notifications')->insert([
                'user_id' => $user->id,
                'subject' => $request->subject,
                'message' => $request->message
            ]);
        }

        return redirect('/admin/notifications')
            ->with('success', 'Notification sent to ' . $users->count() . ' users.');
    }
}