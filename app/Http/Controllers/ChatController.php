<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function index($caseId)
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        $user = Session::get('user');

        $case = DB::table('cases')
            ->leftJoin('users as clients', 'cases.client_id', '=', 'clients.id')
            ->leftJoin('users as lawyers', 'cases.lawyer_id', '=', 'lawyers.id')
            ->where('cases.id', $caseId)
            ->select(
                'cases.*',
                'clients.name as client_name',
                'lawyers.name as lawyer_name'
            )
            ->first();

        if (!$case) {
            return redirect('/dashboard')->with('error', 'Case not found.');
        }

        $isClient = $user->role === 'client' && $case->client_id == $user->id;
        $isLawyer = $user->role === 'lawyer' && $case->lawyer_id == $user->id;

        if (!$isClient && !$isLawyer) {
            return redirect('/dashboard')->with('error', 'You are not allowed to access this chat.');
        }

        $receiverId = $isClient ? $case->lawyer_id : $case->client_id;
        $receiverName = $isClient ? $case->lawyer_name : $case->client_name;

        if (!$receiverId) {
            return redirect('/dashboard')->with('error', 'This case does not have an assigned lawyer yet.');
        }

        $messages = DB::table('chat_messages')
            ->where('case_id', $caseId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat', compact(
            'user',
            'case',
            'messages',
            'receiverId',
            'receiverName'
        ));
    }
}