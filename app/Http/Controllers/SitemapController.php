<?php

namespace App\Http\Controllers;

use App\Game;
use App\Page;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    //
    public function index()
    {
        $pages = Page::orderBy('updated_at', 'desc')->get();
        $game = Game::orderBy('updated_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'pages' => $pages,
            'game' => $game,
        ])->header('Content-Type', 'text/xml');
    }

    public function games()
    {
        $games = Game::orderBy('updated_at', 'desc')->get();

        return response()->view('sitemap.games', [
            'games' => $games,
        ])->header('Content-Type', 'text/xml');
    }
}
