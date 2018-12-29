<?php

namespace App\Http\Controllers\Backend;

use App\Platform;
use App\GamePlatform;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RSSFeed $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(RSSFeed $feed)
    {
        // Get all the games
        $games = Game::all(); // Doesn't have to be ordered since it is for auto-completion
        $games->push(new Game());
        $games = $games->sortBy("title");

        return view('backend.feed.edit', compact('feed', 'games'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RSSFeed $feed)
    {
        // Validate
        $this->validate($request, [
            'title'         => 'required',
            'url'           => 'required',
            'site'          => 'required|string',
            'game_id'       => 'nullable|integer',
        ]);

        // Save the updates
        $feed->update($request->all());

        return Redirect::to('/admin/news/incoming');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(RSSFeed $feed)
    {
        // Delete the game
        $feed->delete();

        return Redirect::to('/admin/news/incoming');

    }
}
