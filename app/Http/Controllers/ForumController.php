<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ForumController extends Controller
{
    public function index()
    {
        if (!Session::has('user')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $questions = DB::table('forum_questions')
            ->leftJoin('users', 'forum_questions.user_id', '=', 'users.id')
            ->select(
                'forum_questions.*',
                'users.name as user_name',
                'users.role as user_role'
            )
            ->orderBy('forum_questions.created_at', 'desc')
            ->get();

        return view('forum', compact('questions'));
    }

    public function store(Request $request)
    {
        if (!Session::has('user')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $user = Session::get('user');

        $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'category' => 'nullable|string|max:255',
        ]);

        DB::table('forum_questions')->insert([
            'user_id' => $user->id,
            'title' => $request->title,
            'question' => $request->question,
            'category' => $request->category,
            'is_anonymous' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/forum')->with('success', 'Your anonymous legal question has been posted.');
    }
}