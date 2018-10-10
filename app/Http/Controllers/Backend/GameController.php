<?php

namespace App\Http\Controllers\Backend;

use App\Console;
use App\ConsoleGame;
use App\Developer;
use App\Http\Controllers\Controller;
use App\Game;
use App\Publisher;
use App\RSSFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
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
        $developers = Developer::orderBy('title')->get();
        $games = Game::all();
        $publishers = Publisher::orderBy('title')->get();
        $game = new Game();
        $game->released_at = date("Y") . "-00-00";
        $game->aliases = null;

        // get consoles that are not listed
        $consoles = Console::all();

        foreach($game->consoles as $consoleItem) {
            foreach($consoles as $key => $value) {
                if($consoleItem->id == $value->id) {
                    $consoles->forget($key);
                }
            }
        }

        return view('backend.game.create', compact('developers', 'games','publishers', 'game', 'consoles'));
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

        // Make from multiple aliases 1
        if($request['aliases'] != null) {
            $request['aliases'] = implode(",", $request['aliases']);
        } else {
            $request['aliases'] = '';
        }

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
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        // Get the developers, games and publishers
        $developers = Developer::orderBy('title')->get();
        $games = Game::all();
        $publishers = Publisher::orderBy('title')->get();

        // get consoles that are not listed
        $consoles = Console::all();

        if($game['aliases'] != "") {
            $game['aliases'] = explode(',', $game['aliases']);
        } else {
            $game->keywords = null;
        }

        foreach($game->consoles as $consoleItem) {
            foreach($consoles as $key => $value) {
                if($consoleItem->id == $value->id) {
                    $consoles->forget($key);
                }
            }
        }

        return view('backend.game.edit', compact('developers', 'games','publishers', 'game', 'consoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        // Make from multiple aliases 1
        if($request['aliases'] != null) {
            $request['aliases'] = implode(",", $request['aliases']);
        } else {
            $request['aliases'] = '';
        }

        // Save the updates
        $game->update($request->all());

        // Save the connection between the game and it's consoles
        ConsoleGame::where('game_id', '=', $game->id)->delete();

        foreach($request['consoles'] as $console) {

            // save a Console
            $consoleGame = new ConsoleGame();
            $consoleGame['game_id'] = $game->id;
            $consoleGame['console_id'] = $console;
            $consoleGame->save();
        }

        return Redirect::to('/admin/games');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        // Delete the game
        $game->delete();

        return Redirect::to('/admin/games');

    }
}
