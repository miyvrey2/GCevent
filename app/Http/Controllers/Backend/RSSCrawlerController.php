<?php

namespace App\Http\Controllers\Backend;

use App\Console;
use App\ConsoleGame;
use App\Developer;
use App\Http\Controllers\Controller;
use App\Game;
use App\Publisher;
use App\RSSFeed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RSSCrawlerController extends Controller
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
        //
        ini_set("default_charset", 'utf-8');

        $feed_items = RSSFeed::where('published_at', '>=', Carbon::yesterday())->orderBy('published_at','desc')->get();

        return view('backend.feed.index', compact('feed_items'));
    }
}
