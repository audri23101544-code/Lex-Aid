<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminLawyerChatController extends Controller
{
    public function adminIndex()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        $lawyers = DB::table('users')
            ->where('role', 'lawyer')
            ->orderBy('name')
            ->get();

        return view('admin_lawyer_chat_list', compact('user', 'lawyers'));
    }

    public function adminChat($lawyerId)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'admin') {
            return redirect('/login');
        }

        $lawyer = DB::table('users')
            ->where('id', $lawyerId)
            ->where('role', 'lawyer')
            ->first();

        if (!$lawyer) {
            return redirect('/admin/lawyer-chat')->with('error', 'Lawyer not found.');
        }

        $messages = DB::table('admin_lawyer_messages')
            ->where('admin_id', $user->id)
            ->where('lawyer_id', $lawyerId)
            ->orderBy('created_at', 'asc')
            ->get();

        $adminId = $user->id;
        $lawyerId = $lawyer->id;

        return view('admin_lawyer_chat', compact(
            'user',
            'lawyer',
            'messages',
            'adminId',
            'lawyerId'
        ));
    }

    public function lawyerChat()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        if ($user->role != 'lawyer') {
            return redirect('/login');
        }

        $admin = DB::table('users')
            ->where('role', 'admin')
            ->orderBy('id')
            ->first();

        if (!$admin) {
            return redirect('/lawyer')->with('error', 'No admin account found.');
        }

        $messages = DB::table('admin_lawyer_messages')
            ->where('admin_id', $admin->id)
            ->where('lawyer_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $adminId = $admin->id;
        $lawyerId = $user->id;

        return view('lawyer_admin_chat', compact(
            'user',
            'admin',
            'messages',
            'adminId',
            'lawyerId'
        ));
    }
}