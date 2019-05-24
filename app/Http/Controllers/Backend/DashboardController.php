<?php

namespace App\Http\Controllers\Backend;

use App\Game;
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
                 ->groupBy('rss_feeds.rss_website_id')
                 ->orderBy('count', 'DESC')
                 ->limit(5)
                 ->get();

        // Get count of all rss_articles with a game_id
        $count_rss_articles_with_game_id = DB::table('rss_feeds')
                 ->select(DB::raw("count(*) as count"))
                 ->where([['game_id', '!=', null],['published_at', '>=', Carbon::yesterday()]])
                 ->get();

        // Get count of all rss_articles without a game_id
        $count_rss_articles_without_game_id = DB::table('rss_feeds')
                 ->select(DB::raw("count(rss_feeds.id) as count"))
                 ->where([['game_id', '=', null],['published_at', '>=', Carbon::yesterday()]])
                 ->get();

        $count_rss_articles_with_film_in_title = DB::table('rss_feeds')
                ->select(DB::raw("count(rss_feeds.id) as count"))
                ->whereRaw('lower(rss_feeds.title) like (?)',["%film%"])
                ->where('published_at', '>=', Carbon::yesterday())
                ->get();

        $rss_top_5_games = Game::with(['RSSFeeds' => function($query) {
                        $query->where([['published_at', '>=', Carbon::yesterday()], ['game_id', '!=', null]]);
                     }])
                     ->get()
                     ->sortByDesc(function($games) {
                         return $games->RSSFeeds->count();
                     });

        // Reset keys for array
        $rss_top_5_games = $rss_top_5_games->values();


        return view('backend.dashboard', compact('rss_websites', 'count_rss_articles_with_game_id', 'count_rss_articles_without_game_id', 'rss_top_5_games', 'count_rss_articles_with_film_in_title'));
    }
}
