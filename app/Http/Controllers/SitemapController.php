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
        $page = Page::orderBy('updated_at', 'desc')->first();
        $game = Game::orderBy('updated_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'page' => $page,
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

    public function pages()
    {
        $pages = Page::orderBy('updated_at', 'desc')->get();

        return response()->view('sitemap.pages', [
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }
}
