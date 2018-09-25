<?php

namespace App\Http\Controllers\Backend;

use App\Developer;
use App\Http\Controllers\Controller;
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
        $games = Game::all();


        return view('backend.game.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Get the developers, games and publishers
        $developers = Developer::all();
        $games = Game::all();
        $publishers = Publisher::all();
        $game = new Game();
        $game->released_at = date("Y") . "-00-00";

        return view('backend.game.create', compact('developers', 'games','publishers', 'game'));
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

        // Save into another databse
//        DB::purge('mysql');
//        Config::set('database.connections.mysql.database', 'db_test');

        // save
        Game::create($data);

        return redirect('/admin/games');
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
    public function edit(Game $game)
    {
        // Get the developers, games and publishers
        $developers = Developer::all();
        $games = Game::all();
        $publishers = Publisher::all();

        return view('backend.game.edit', compact('developers', 'games','publishers', 'game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
        echo "Whoops, we didn't save your request because I was a dipshit and not wrote a update function";
        dd($game);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
        //
        echo "Whoops, we didn't save your request because I was a dipshit and not wrote a destry function";
        dd($game);
    }
}
