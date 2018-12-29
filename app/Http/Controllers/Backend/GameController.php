<?php

namespace App\Http\Controllers\Backend;

use App\Platform;
use App\GamePlatform;
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

        // Get the developers, games, publishers, platforms and genres
        $developers = Developer::orderBy('title')->get();
        $publishers = Publisher::orderBy('title')->get();
        $platforms = Platform::orderBy('released_at')->get();
        $genres = Genre::orderBy('title')->get();
        $games = Game::all(); // Doesn't have to be ordered since it is for auto-completion

        // Initiate a new game with some defined values
        $game = new Game();
        $game->released_at = date("Y") . "-00-00";
        $game->aliases = null;

        return view('backend.game.create', compact('developers', 'games','publishers', 'game', 'platforms', 'genres'));
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

        // Remove and save the connection between the game and it's platforms
        $this->remove_and_save_platforms_to_GamePlatform_with_game_id($game->id, $request['platforms']);

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
        // Get the developers, games, publishers, platforms and genres
        $developers = Developer::orderBy('title')->get();
        $publishers = Publisher::orderBy('title')->get();
        $platforms = Platform::orderBy('released_at')->get();
        $genres = Genre::orderBy('title')->get();
        $games = Game::all(); // Doesn't have to be ordered since it is for auto-completion

        if($game['aliases'] != "") {
            $game['aliases'] = explode(',', $game['aliases']);
        } else {
            $game->keywords = null;
        }

        // Get the platforms and genres that are not already listed
        $platforms = $this->unset_arrayitem_from_array_all_if_already_used($game->platforms, $platforms);
        $genres = $this->unset_arrayitem_from_array_all_if_already_used($game->genres, $genres);

        return view('backend.game.edit', compact('developers', 'games','publishers', 'game', 'platforms', 'genres'));
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

        // Remove and save the connection between the game and it's platforms
        $this->remove_and_save_platforms_to_GamePlatform_with_game_id($game->id, $request['platforms']);

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
        // Remove and save the connection between the game and it's platforms
        $this->remove_and_save_platforms_to_GamePlatform_with_game_id($game->id, array());

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
     * Save the Game and it's platforms it belongs to in the GamePlatform table
     *
     * @param $game_id
     * @param $platforms
     */
    private function remove_and_save_platforms_to_GamePlatform_with_game_id($game_id, $platforms) {

        // Remove the old connections
        GamePlatform::where('game_id', '=', $game_id)->delete();

        // foreach platform, create a new connection
        foreach($platforms as $platform) {

            // save a platform and Game combination
            $gamePlatform = new GamePlatform();
            $gamePlatform['game_id'] = $game_id;
            $gamePlatform['platform_id'] = $platform;
            $gamePlatform->save();
        }
    }

    /**
     * Save the Game and it's genres it belongs to in the GameGenre table
     *
     * @param $game_id
     * @param $platforms
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
