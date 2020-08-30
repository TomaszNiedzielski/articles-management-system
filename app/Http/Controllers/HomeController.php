<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = DB::table('articles')
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->select('articles.id', 'articles.title', 'articles.body', 'articles.created_at', 'users.name as user_name', 'users.id as user_id')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);            

        return view('home', ['articles' => $articles]);
    }
}
