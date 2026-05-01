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

        $user = Session::get('user');

        $questions = DB::table('forum_questions')
            ->leftJoin('users', 'forum_questions.user_id', '=', 'users.id')
            ->select(
                'forum_questions.*',
                'users.name as user_name',
                'users.role as user_role'
            )
            ->orderBy('forum_questions.created_at', 'desc')
            ->get();

        $replies = DB::table('forum_replies')
            ->leftJoin('users as lawyers', 'forum_replies.lawyer_id', '=', 'lawyers.id')
            ->select(
                'forum_replies.*',
                'lawyers.name as lawyer_name'
            )
            ->orderBy('forum_replies.created_at', 'asc')
            ->get()
            ->groupBy('question_id');

        return view('forum', compact('questions', 'replies', 'user'));
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

    public function reply(Request $request, $questionId)
    {
        if (!Session::has('user')) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $user = Session::get('user');

        if ($user->role !== 'lawyer' && $user->role !== 'admin') {
            return redirect('/forum')->with('error', 'Only lawyers or admins can reply to forum questions.');
        }

        $request->validate([
            'reply' => 'required|string',
        ]);

        $question = DB::table('forum_questions')->where('id', $questionId)->first();

        if (!$question) {
            return redirect('/forum')->with('error', 'Question not found.');
        }

        DB::table('forum_replies')->insert([
            'question_id' => $questionId,
            'lawyer_id' => $user->id,
            'reply' => $request->reply,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/forum')->with('success', 'Reply posted successfully.');
    }
}