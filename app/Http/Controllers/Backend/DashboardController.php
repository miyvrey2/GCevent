<?php

namespace App\Http\Controllers\Backend;

use App\RSSFeed;
use App\RSSWebsite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get top 5 rss website feeds
        $rss_websites = DB::table('rss_websites')
                 ->join('rss_feeds', 'rss_websites.id', '=', 'rss_feeds.rss_website_id')
                 ->select('rss_websites.title as title', DB::raw("count(rss_feeds.id) as count"))
                 ->where('published_at', '>=', Carbon::yesterday())
                 ->groupBy('rss_feeds.rss_website_id')
                 ->orderBy('count', 'DESC')
                 ->limit(5)
                 ->get();

        // Get count of all rss_articles with a game_id
        $count_rss_articles_with_game_id = DB::table('rss_feeds')
                 ->select(DB::raw("count(*) as count"))
                 ->where('game_id', '!=', null)
                 ->get();

        // Get count of all rss_articles without a game_id
        $count_rss_articles_without_game_id = DB::table('rss_feeds')
                 ->select(DB::raw("count(rss_feeds.id) as count"))
                 ->where('game_id', '=', null)
                 ->get();

        // Get top 5 games in news
        $rss_top_5_games = DB::table('rss_feeds')
                  ->join('games', 'rss_feeds.game_id', '=', 'games.id')
                  ->select('games.title as title', DB::raw("count(rss_feeds.game_id) as count"))
                  ->where('published_at', '>=', Carbon::yesterday())
                  ->groupBy('rss_feeds.game_id')
                  ->orderBy('count', 'DESC')
                  ->limit(5)
                  ->get();

        return view('backend.dashboard', compact('rss_websites', 'count_rss_articles_with_game_id', 'count_rss_articles_without_game_id', 'rss_top_5_games'));
    }
}
