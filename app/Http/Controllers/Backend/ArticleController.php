<?php

namespace App\Http\Controllers\Backend;

use App\Article;
use App\Game;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create a new article
        $article = new Article();
        $article->published_at = null;

        // Empty game when not having one
        $games = Game::orderBy('title')->get();
        $games->push(new Game());
        $games = $games->sortBy("title");

        return view('backend.article.create', compact('article', 'games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Change published_at date
        if($request['published_at'] != "") {
            $request['published_at'] = Carbon::parse($request['published_at'])->format("Y-m-d H:i:s");
        }
        // make that slug readable
        $request['slug'] = str_replace(" ", "-", $request['slug']);
        $request['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $request['slug']);

        // Written by
        $request['author_id'] = Auth::user()->id;

        // Validate
        $data = $this->validate($request, [
            'title'         => 'required',
            'slug'          => 'required',
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
            'published_at'  => 'nullable|date_format:"Y-m-d H:i:s"',
            'game_id'       => 'nullable|integer',
            'keywords'      => 'nullable|string',
        ]);

        // Save into another databse
        //        DB::purge('mysql');
        //        Config::set('database.connections.mysql.database', 'db_test');

        // save
        Article::create($request->all());

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
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // Get the developers, games and publishers
        $games = Game::orderBy('title')->get();
        $games[] = new Game();

        return view('backend.article.edit', compact('article', 'games'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        // Change published_at date
        if($request['published_at'] != "") {
            $request['published_at'] = Carbon::parse($request['published_at'])->format("Y-m-d H:i:s");
        }

        // make that slug readable
        $request['slug'] = str_replace(" ", "-", $request['slug']);
        $request['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $request['slug']);

        // Validate
        $this->validate($request, [
            'title'         => 'required',
            'slug'          => 'required',
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
            'published_at'  => 'nullable|date_format:"Y-m-d H:i:s"',
            'game_id'       => 'nullable|integer',
            'keywords'      => 'nullable|string',
        ]);

        // Save the updates
        $article->update($request->all());

        return Redirect::to('/admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // Delete the game
        $article->delete();

        return Redirect::to('/admin/news');

    }
}
