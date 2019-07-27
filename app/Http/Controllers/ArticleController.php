<?php

namespace App\Http\Controllers;

use App\Article;

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

        if(($article->status == $article->enumStatuses['pu']) || ($article->status == $article->enumStatuses['dr'] && Auth::check())) {

            $article->related = Article::where([['game_id', '=', $article->game_id], ['id', '!=', $article->id]])->published()->limit(2)->get();

            if($article['keywords'] != "") {
                $article['keywords'] = explode(',', $article['keywords']);
            } else {
                $article->keywords = null;
            }

            return view('article.show', compact('article'));
        } else {
            abort(404);
        }
    }
}
