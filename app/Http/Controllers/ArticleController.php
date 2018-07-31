<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::published()->orderBy('published_at', 'desc')->get();

        return view('article.index', compact('articles'));
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Article $article)
    {
        $article->related = Article::where([['game_id', '=', $article->game_id], ['id', '!=', $article->id]])->published()->get();

        return view('article.show', compact('article'));
    }
}
