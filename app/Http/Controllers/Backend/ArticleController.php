<?php

namespace App\Http\Controllers\Backend;

use App\Article;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $articles = Article::orderBy('published_at', 'desc')->get();

        foreach($articles as $article) {
            if ($article->published_at == null) {
                $article->status = "Concept";
            } else if ($article->published_at > Carbon::now()) {
                $article->status = "Planned";
            } else {
                $article->status = "Published";
            }
        }

        return view('backend.article.index', compact('articles'));
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
