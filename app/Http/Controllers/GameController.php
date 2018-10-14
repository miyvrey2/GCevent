<?php

namespace App\Http\Controllers;

use App\Game;
use App\Publisher;
use App\RSSFeed;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $games = Game::orderBy('title', 'asc')->get();
        foreach($games as $key => $game) {
            if ($game['title'] === '---') {
                unset($games[$key]);
            }
        }

        return view('game.index', compact('games'));
    }

    // Show all listed games for 2018
    public function listed()
    {
        $exhibitors = Publisher::with(['exhibitor_games' => function ($query) {
            $query->where([
                ['line_up_year', '=', '2018'],
                ['title', '!=', '---'],
            ]);
            $query->orderBy('title', 'ASC');
        }])->where('id', '!=', 1)->orderBy('title', 'ASC')->get();

        return view('game.listed', compact('exhibitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $data = $this->validate($request, [
            'publisher_id' => 'required|integer',
            'title'=> 'required',
            'slug'=> 'required',
        ]);

        // make that slug readable
        $data['slug'] = str_replace(" ", "-", $data['slug']);
        $data['slug'] = preg_replace("/[^a-zA-Z0-9-]+/", "", $data['slug']);

        // save
        Game::create($data);

        return redirect('/crawler/gametitles');
    }

    /**
     * Display the specified resource.
     *
     * @param Game $game
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {

        $game->rssFeeds = RSSFeed::where('game_id', '=', $game['id'])->get();

        return view('game.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
