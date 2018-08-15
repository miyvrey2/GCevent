<?php

namespace App\Http\Controllers;

use App\Article;
use App\Console;
use App\Game;
use App\Page;

class SitemapController extends Controller
{
    //
    public function index()
    {
        $page = Page::orderBy('updated_at', 'desc')->first();
        $article = Article::orderBy('published_at', 'desc')->first();
        $console = Console::orderBy('created_at', 'desc')->first();
        $game = Game::orderBy('updated_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'page' => $page,
            'article' => $article,
            'console' => $console,
            'game' => $game,
        ])->header('Content-Type', 'text/xml');
    }

    public function articles()
    {
        $articles = Article::orderBy('published_at', 'desc')->get();

        return response()->view('sitemap.googlenews', [
            'articles' => $articles,
        ])->header('Content-Type', 'text/xml');
    }

    public function consoles()
    {
        $consoles = Console::orderBy('created_at', 'desc')->get();

        return response()->view('sitemap.consoles', [
            'consoles' => $consoles,
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
