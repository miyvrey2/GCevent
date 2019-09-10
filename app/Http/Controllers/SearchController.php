<?php

namespace App\Http\Controllers;

use App\Article;
use App\Platform;
use App\Game;
use App\Page;

class SearchController extends Controller
{
    //
    public function index()
    {

        return redirect(url('/search/' . request('search')), 301);
    }

    public function results($search_query)
    {
        $games = Game::search($search_query)->get();

        return view('search.results', compact('games', 'search_query'));

    }
}
