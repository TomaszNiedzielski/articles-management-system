<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use App\Article;
use Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('load', 'loadSpecified', 'showBestAuthors');
    }

    public function create()
    {
        return view('pages.createArticle');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string']
        ]);

        $article = new Article;
        $article->user_id = Auth::user()->id;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();

        return redirect('/');
    }
    
    public function load()
    {
        $articles = DB::table('articles')
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->select('articles.id', 'articles.title', 'articles.body', 'articles.created_at', 'users.name as user_name', 'users.id as user_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.index', ['articles' => $articles]);
    }

    public function loadForSpecificUser($user_id)
    {
        $articles = DB::table('articles')
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->select('articles.id', 'articles.title', 'articles.body', 'articles.created_at', 'users.name as user_name', 'users.id as user_id')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);            

        return view('pages.user', ['articles' => $articles]);
    }

    public function getArticleById($id)
    {
        $articles = DB::table('articles')
                ->join('users', 'users.id', '=', 'articles.user_id')
                ->select('articles.id', 'articles.title', 'articles.body', 'articles.created_at', 'users.name as user_name', 'users.id as user_id')
                ->where('articles.id', $id)
                ->get();

        return view('pages.article', ['articles' => $articles]);
    }

    public function showBestAuthors()
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        $best_authors = DB::table('articles')
                        ->join('users', 'users.id', '=', 'articles.user_id')
                        ->where('articles.created_at','>=',$date)
                        ->select(DB::raw('count(articles.user_id) as articles_number'), 'users.id as user_id', 'users.name as user_name')
                        ->groupBy('users.id', 'users.name')
                        ->orderBy('articles_number', 'desc')
                        ->take(3)
                        ->get();

        return view('pages.bestAuthors', ['authors' => $best_authors]);
    }

    public function edit($id)
    {
        $article = DB::table('articles')
                ->where('id', $id)
                ->get();

        return view('pages.editArticle', ['article' => $article]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string']
        ]);
        
        DB::table('articles')
            ->where([
                ['user_id', '=', Auth::user()->id],
                ['id', '=', $id]
            ])
            ->update([
                'title' => $request->title,
                'body' => $request->body
            ]);

        return redirect('/');        
            
    }
}
