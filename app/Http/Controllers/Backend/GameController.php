<?php

namespace App\Http\Controllers\Backend;

use App\Console;
use App\ConsoleGame;
use App\Developer;
use App\GameGenre;
use App\Genre;
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

        // Get the developers, games, publishers, consoles and genres
        $developers = Developer::orderBy('title')->get();
        $publishers = Publisher::orderBy('title')->get();
        $consoles = Console::orderBy('released_at')->get();
        $genres = Genre::orderBy('title')->get();
        $games = Game::all(); // Doesn't have to be ordered since it is for auto-completion

        // Initiate a new game with some defined values
        $game = new Game();
        $game->released_at = date("Y") . "-00-00";
        $game->aliases = null;

        return view('backend.game.create', compact('developers', 'games','publishers', 'game', 'consoles', 'genres'));
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
            'publisher_id'  => 'required|integer',
            'title'         => 'required|string',
            'slug'          => 'required|string',
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
            'aliases'       => 'nullable|string',
            'developer_id'  => 'nullable|integer',
            'released_at'   => 'nullable|string',
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

        // Save
        $game = Game::create($data);

        // Remove and save the connection between the game and it's consoles
        $this->remove_and_save_consoles_to_ConsoleGame_with_game_id($game->id, $request['consoles']);

        // Remove and save the connection between the game and it's genres
        $this->remove_and_save_genres_to_GameGenre_with_game_id($game->id, $request['genres']);

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
        // Get the developers, games, publishers, consoles and genres
        $developers = Developer::orderBy('title')->get();
        $publishers = Publisher::orderBy('title')->get();
        $consoles = Console::orderBy('released_at')->get();
        $genres = Genre::orderBy('title')->get();
        $games = Game::all(); // Doesn't have to be ordered since it is for auto-completion

        if($game['aliases'] != "") {
            $game['aliases'] = explode(',', $game['aliases']);
        } else {
            $game->keywords = null;
        }

        // Get the consoles and genres that are not already listed
        $consoles = $this->unset_arrayitem_from_array_all_if_already_used($game->consoles, $consoles);
        $genres = $this->unset_arrayitem_from_array_all_if_already_used($game->genres, $genres);

        return view('backend.game.edit', compact('developers', 'games','publishers', 'game', 'consoles', 'genres'));
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

        // Remove and save the connection between the game and it's consoles
        $this->remove_and_save_consoles_to_ConsoleGame_with_game_id($game->id, $request['consoles']);

        // Remove and save the connection between the game and it's genres
        $this->remove_and_save_genres_to_GameGenre_with_game_id($game->id, $request['genres']);

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
        // Remove and save the connection between the game and it's consoles
        $this->remove_and_save_consoles_to_ConsoleGame_with_game_id($game->id, array());

        // Remove and save the connection between the game and it's genres
        $this->remove_and_save_genres_to_GameGenre_with_game_id($game->id, array());

        // Delete the game
        $game->delete();

        return Redirect::to('/admin/games');

    }

    /**
     * Remove arrayitem from the "all"-array out of the database if the arrayitem is already selected for this game
     *
     * @param $already_in_use_array
     * @param $full_array
     *
     * @return mixed
     */
    private function unset_arrayitem_from_array_all_if_already_used($already_in_use_array, $full_array) {
        foreach($already_in_use_array as $already_in_use_array_item) {
            foreach($full_array as $key => $value) {
                if($already_in_use_array_item->id == $value->id) {
                    $full_array->forget($key);
                }
            }
        }

        return $full_array;
    }

    /**
     * Save the Game and it's consoles it belongs to in the ConsoleGame table
     *
     * @param $game_id
     * @param $consoles
     */
    private function remove_and_save_consoles_to_ConsoleGame_with_game_id($game_id, $consoles) {

        // Remove the old connections
        ConsoleGame::where('game_id', '=', $game_id)->delete();

        // foreach console, create a new connection
        foreach($consoles as $console) {

            // save a Console and Game combination
            $consoleGame = new ConsoleGame();
            $consoleGame['game_id'] = $game_id;
            $consoleGame['console_id'] = $console;
            $consoleGame->save();
        }
    }

    /**
     * Save the Game and it's genres it belongs to in the GameGenre table
     *
     * @param $game_id
     * @param $consoles
     */
    private function remove_and_save_genres_to_GameGenre_with_game_id($game_id, $genres) {

        GameGenre::where('game_id', '=', $game_id)->delete();

        if($genres != null) {
            // foreach genre, create a new connection
            foreach($genres as $genre) {

                // save a Game and Genre combination
                $GameGenre = new GameGenre();
                $GameGenre['game_id'] = $game_id;
                $GameGenre['genre_id'] = $genre;
                $GameGenre->save();
            }
        }

    }
}
