<?php

namespace App\Http\Controllers\Backend;

use App\Game;
use App\Article;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdateArticle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all articles, ordered by the published date
        $articles = Article::orderBy('published_at', 'desc')->get();

        foreach($articles as $article) {

            // If the offline date has not been set, make a fake one for in the future so we can loop
            $article->offline_at = ($article->offline_at === null) ? Carbon::tomorrow() : $article->offline_at;

            if ($article->published_at == null) {
                $article->status = "Concept";
            } else if ($article->published_at > Carbon::now()) {
                $article->status = "Planned";
            } else if ($article->published_at < Carbon::now() && $article->offline_at > Carbon::now()) {
                $article->status = "Published";
            } else if ($article->offline_at < Carbon::now()) {
                $article->status = "Offline";
            } else {
                $article->status = "Status unkown";
            }
        }

        return view('backend.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create a new article
        $article = new Article();
        $article->published_at = null;
        $article->keywords = null;

        // Empty game when not having one
        $games = Game::orderBy('title')->get();
        $games->push(new Game());
        $games = $games->sortBy("title");

        return view('backend.article.create', compact('article', 'games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrUpdateArticle  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdateArticle $request)
    {
        // Get the validated data from request validator
        $data = $request->validated();

        // Make slug readable
        $data['slug'] = $this->slugify($data['slug']);

        // Change published_at date
        if($data['published_at'] != "") {
            $data['published_at'] = Carbon::parse($data['published_at'])->format("Y-m-d H:i:s");
        }

        // Change published_at date
        if($data['offline_at'] != "") {
            $data['offline_at'] = Carbon::parse($data['offline_at'])->format("Y-m-d H:i:s");
        }

        // Set author
        $data['author_id'] = Auth::user()->id;

        // Make from multiple keywords 1
        $data['keywords'] = @$this->implodeOrEmptyString($data['keywords']);

        // Save into another databse
        //        DB::purge('mysql');
        //        Config::set('database.connections.mysql.database', 'db_test');

        // save
        Article::create($data);

        return redirect('/admin/news');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // Get the developers, games and publishers
        $games = Game::orderBy('title')->get();
        $games->push(new Game());
        $games = $games->sortBy("title");

        if($article['keywords'] != "") {
            $article['keywords'] = explode(',', $article['keywords']);
        } else {
            $article->keywords = null;
        }

        return view('backend.article.edit', compact('article', 'games'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreOrUpdateArticle  $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdateArticle $request, Article $article)
    {
        // Get the validated data from request validator
        $data = $request->validated();

        // Make slug readable
        $data['slug'] = $this->slugify($data['slug']);

        // Change published_at date
        if($data['published_at'] != "") {
            $data['published_at'] = Carbon::parse($data['published_at'])->format("Y-m-d H:i:s");
        }

        // Change offline_at date
        if($data['offline_at'] != "") {
            $data['offline_at'] = Carbon::parse($data['offline_at'])->format("Y-m-d H:i:s");
        }

        // Make from multiple keywords 1
        $data['keywords'] = @$this->implodeOrEmptyString($data['keywords']);

        // Save the updates
        $article->update($data);

        return Redirect::to('/admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        // Delete the game
        $article->delete();

        return Redirect::to('/admin/news');

    }
}
