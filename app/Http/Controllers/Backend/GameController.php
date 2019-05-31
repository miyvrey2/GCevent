<?php

namespace App\Http\Controllers\Backend;

use App\DeveloperGame;
use App\GamePublisher;
use App\Platform;
use App\GamePlatform;
use App\Developer;
use App\GameGenre;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Game;
use App\Publisher;
use App\RSSFeed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'title'         => 'required|string',
            'slug'          => 'required|string',
            'excerpt'       => 'nullable|string',
            'body'          => 'nullable|string',
            'aliases'       => 'nullable|string',
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

        // Sync the game and it's platforms
        $game->platforms()->sync($request['platforms']);

        // Sync the game and it's genres
        $game->genres()->sync($request['genres']);

        // Sync the game and it's publishers
        $game->publishers()->sync($request['publishers']);

        // Sync the game and it's publishers
        $game->developers()->sync($request['developers']);

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
        $publishers = $this->unset_arrayitem_from_array_all_if_already_used($game->publishers, $publishers);
        $developers = $this->unset_arrayitem_from_array_all_if_already_used($game->developers, $developers);

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

        // Sync the game and it's platforms
        $game->platforms()->sync($request['platforms']);

        // Sync the game and it's genres
        $game->genres()->sync($request['genres']);

        // Sync the game and it's publishers
        $game->publishers()->sync($request['publishers']);

        // Sync the game and it's publishers
        $game->developers()->sync($request['developers']);

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

    public function tryToGetThePublisher(Game $game)
    {
        // Get from google the knowledge search
        $json = $this->googleKnowledgeSearch($game->title);
        $json_decode = json_decode($json);

        // Get the title and description
        $title = $json_decode->itemListElement[0]->result->name;
        if(!isset($json_decode->itemListElement[0]->result->detailedDescription)) {
            return "No Knowledge found.";
        }
        $detailedDescription = $json_decode->itemListElement[0]->result->detailedDescription->articleBody;

        // If the title is not the same, return false
        if($game->title != $title) {
            return false;
        }

        // empty publisher
        $new_publisher = null;

        // Get all the publishers
        $publishers = Publisher::all();
        $publishers_array = [];
        $publishers_name = "";

        if(strpos($detailedDescription, 'published') > strpos($detailedDescription, 'developed')) {
            $description = explode("published", $detailedDescription, 2)[1];
        } else {
            $description = explode("published", $detailedDescription, 2)[0];
        }

        foreach($publishers as $publisher) {
            if (strpos(strtolower($description), strtolower($publisher->title)) !== false) {

                // Combine the old array and the newly information
                $publishers_array[] = $publisher->id;
                $publishers_name .= $publisher->title . ", ";
            }
        }

        // If we found publishers, sync them
        if($publishers_array != []) {

            $publishers_array = array_merge($game->publishers->pluck('id')->toArray(), $publishers_array);

            // Sync the game and it's publishers
            $game->publishers()->sync($publishers_array);

            return "synced " . $publishers_name . " to the array.";

        } else {
            if (strpos($detailedDescription, 'published by') !== false) {
                $first = explode("published by", $detailedDescription, 2)[1];
                $middle = explode(". ", $first, 2)[0];
                $middle = explode(" for", $middle, 2)[0];
                $new_publisher = $middle;
            } elseif (strpos($detailedDescription, 'developed and published by') !== false) {
                $first = explode("developed and published by", $detailedDescription, 2)[1];
                $middle = explode(". ", $first, 2)[0];
                $middle = explode(" for", $middle, 2)[0];
                $new_publisher = $middle;
            }

            return "No existing publisher found. Add <a href='" . url('/admin/publishers/create/'.$new_publisher) . "'>" . $new_publisher . "</a>. The full string was: " . $detailedDescription;
        }
    }

    public function findDeveloper(Game $game)
    {
        // Get from google the knowledge search
        $json = $this->googleKnowledgeSearch($game->title);
        $json_decode = json_decode($json);

        // Get the title and description
        $title = $json_decode->itemListElement[0]->result->name;
        if(!isset($json_decode->itemListElement[0]->result->detailedDescription)) {
            return "No Knowledge found.";
        }
        $detailedDescription = $json_decode->itemListElement[0]->result->detailedDescription->articleBody;

        // If the title is not the same, return false
        if($game->title != $title) {
            return false;
        }

        // empty developer
        $new_developer = null;

        // Get all the developers
        $developers = Developer::all();
        $developers_array = [];
        $developers_name = "";

        if(strpos($detailedDescription, 'developed') > strpos($detailedDescription, 'developed')) {
            $description = explode("developed", $detailedDescription, 2)[1];
        } else {
            $description = explode("developed", $detailedDescription, 2)[0];
        }

        foreach($developers as $developer) {
            if (strpos(strtolower($description), strtolower($developer->title)) !== false) {

                // Combine the old array and the newly information
                $developers_array[] = $developer->id;
                $developers_name .= $developer->title . ", ";
            }
        }

        // If we found developers, sync them
        if($developers_array != []) {

            $developers_array = array_merge($game->developers->pluck('id')->toArray(), $developers_array);

            // Sync the game and it's developers
            $game->developers()->sync($developers_array);

            return "synced " . $developers_name . " to the array.";

        } else {
            if (strpos($detailedDescription, 'developed by') !== false) {
                $first = explode("developed by", $detailedDescription, 2)[1];
                $middle = explode(". ", $first, 2)[0];
                $middle = explode(" for", $middle, 2)[0];
                $new_developer = $middle;
            } elseif (strpos($detailedDescription, 'developed and published by') !== false) {
                $first = explode("developed and published by", $detailedDescription, 2)[1];
                $middle = explode(". ", $first, 2)[0];
                $middle = explode(" for", $middle, 2)[0];
                $new_developer = $middle;
            }

            return "No existing developer found. Add <a href='" . url('/admin/developers/'.$new_developer) . "'>" . $new_developer . "</a>. The full string was: " . $detailedDescription;
        }
    }

    public function recentlyInRSS()
    {
        $games = Game::with(['RSSFeeds' => function($query) {
                         $query->where([['published_at', '>=', Carbon::now()->subHours(48)], ['game_id', '!=', null]]);
                     }])
                     ->get()
                     ->sortByDesc(function($games) {
                        return $games->RSSFeeds->count();
                     });

        return view('backend.game.recently', compact('games'));
    }

    public function recentlyInRSSCoupling()
    {
        $games = Game::with(['RSSFeeds' => function($query) {
            $query->where([['published_at', '>=', Carbon::now()->subHours(48)], ['game_id', '!=', null]]);
        }])
                     ->get()
                     ->sortByDesc(function($games) {
                         return $games->RSSFeeds->count();
                     });

        $rss_feeds_titles = [];

        foreach($games as $game) {

            // remove the gametitle or gamealias from the feedtitle
            if(count($game->RSSFeeds) > 1) {
                foreach($game->RSSFeeds as $feed) {
                    $feedTitle = $feed->title;
                    $feedTitle = str_replace($game->title, '', $feedTitle);

                    foreach(explode(',', $game->aliases) as $alias) {
                        $feedTitle = str_replace($alias, '', $feedTitle);
                    }

                    // Clean feed title
                    $feedTitle = $this->clean($feedTitle);

                    $rss_feeds_titles[$game->id][$feed->id] = $feedTitle;
                }
            }

        }

        $article_word_suggestion = [];

        // Loop trough the rss titles
        foreach ($rss_feeds_titles as $key => $game) {

            $article_word_suggestion[$key] = [];

            foreach($game as $feed_title) {

                // get each word out of the title
                $title_as_array = explode(' ', $feed_title);

                // loop trough each word and count
                foreach ($title_as_array as $word) {
                    if($word === "") {
                        continue;
                    }

                    $word = strtolower($word);
                    if (!array_key_exists($word, $article_word_suggestion[$key])) {
                        $article_word_suggestion[$key][$word] = 1;
                    } else {
                        $article_word_suggestion[$key][$word] += 1;
                    }
                }
            }

//            $article_word_suggestion[$key] = $this->unset_if_one($article_word_suggestion[$key]);

            // Sort on value amount
            arsort($article_word_suggestion[$key]);
        }

        dd($article_word_suggestion);

        return view('backend.game.recently', compact('games'));
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

    private function clean($string) {
        return preg_replace('/[^A-Za-z0-9\- ]/', '', $string); // Removes special chars.
    }

    private function unset_if_one($array) {

        foreach($array as $key => $value){

            if ($value === 1) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    private function googleKnowledgeSearch($term)
    {
        // https://developers.google.com/knowledge-graph/#knowledge_graph_entities
        // https://kgsearch.googleapis.com/v1/entities:search?query=death+stranding&key=env('GOOGLE_KNOWLEDGE_SEARCH_KEY')&limit=1

        $service_url = 'https://kgsearch.googleapis.com/v1/entities:search';
        $params = array(
            'query' => $term,
            'limit' => 1,
            'indent' => TRUE,
            'key' => env('GOOGLE_KNOWLEDGE_SEARCH_KEY'));
        $url = $service_url . '?' . http_build_query($params);

        $opts = array(
            'http' => array (
                'method' => 'GET',
                'header' => "
                    User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36; \r\n
			        "
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        // Open the stream
        $context = stream_context_create($opts);

        // Return the page
        return file_get_contents($url, false, $context);
    }
}
