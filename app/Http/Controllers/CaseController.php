<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CaseController extends Controller
{
    public function create()
    {
        return view('create_case');
    }

    public function store(Request $request)
    {
        $user = Session::get('user');

        DB::table('cases')->insert([
            'client_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'case_type' => $request->case_type,
            'location' => $request->location,
            'deadline' => $request->deadline
        ]);

        return "Case submitted successfully";
    }

    public function index()
    {
        $user = Session::get('user');

        $cases = DB::table('cases')
            ->where('client_id', $user->id)
            ->get();

        return view('cases', compact('cases'));
    }
}