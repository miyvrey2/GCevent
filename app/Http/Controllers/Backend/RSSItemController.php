<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Game;
use App\RSSItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class RSSItemController extends Controller
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

        $feed_items = RSSItem::where('published_at', '>=', Carbon::now()->subHours(48))
                             ->orderBy('published_at', 'desc')
                             ->get();

        return view('backend.feed.index', compact('feed_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RSSItem $feed
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(RSSItem $feed)
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
     * @param  \Illuminate\Http\Request $request
     * @param  RSSItem $feed
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RSSItem $feed)
    {
        // Validate
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
            'site' => 'required|string',
            'game_id' => 'nullable|integer',
        ]);

        // Save the updates
        $feed->update($request->all());

        return Redirect::to('/admin/news/incoming');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RSSItem $feed
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(RSSItem $feed)
    {
        // Delete the game
        $feed->delete();

        return Redirect::to('/admin/news/incoming');

    }

    public function findKeywords()
    {
        // Get the file
        $file = 'data/RSSitems/keywords.json';

        if (Storage::disk('local')->exists($file)) {

            $file_items = json_decode(Storage::disk('local')->get($file), true);
            $wordlist = $file_items['items'];
            $last_item = $file_items['last_item'];

            // Get the rss items that are new
            $rss_items = RSSItem::where([
                ['id', '>', $last_item],
                ['game_id', '!=', null]
            ])->orderBy('id')
                                ->get();

            if(!$rss_items->isEmpty()) {

                $last_item = $rss_items->max('id');

                // Loop trough the items
                foreach($rss_items as $item) {

                    // Strip the title
//                    $item->title = $this->removeTitleFromRSSItem($item);
                    $item->title = $this->removeSpecialCharacters($item->title);
                    // get each word out of the title
                    $title_as_array = explode(' ', $item->title);

                    // loop trough each word and count
                    foreach ($title_as_array as $word) {

                        $word = strtolower($word);

                        if($word === "") {
                            continue;
                        }

                        if(is_numeric($word) && $word != date('Y') && $word != date('Y') + 1){
                            continue;
                        }

                        // Else, save the words
                        if (!array_key_exists($word, $wordlist)) {

                            // Initialize the options
                            if (strpos(strtolower($item->game->title), $word) !== false) {
                                $wordlist[ $word ]['in_game'] = 1;
                                $wordlist[ $word ]['other'] = 0;
                            } else {
                                $wordlist[ $word ]['in_game'] = 0;
                                $wordlist[ $word ]['other'] = 1;
                            }

                        } else {
                            // If the word is in the title of the game, save it!
                            if (strpos(strtolower($item->game->title), $word) !== false) {
                                $wordlist[$word]['in_game'] += 1;
                            } else {
                                $wordlist[$word]['other'] += 1;
                            }
                        }
                    }
                }
            }
        }

        $file_items = ['last_item' => $last_item, 'items' => $wordlist];

        Storage::disk('local')->put($file, json_encode($file_items));

        return $file_items;

    }

    private function removeSpecialCharacters($string)
    {
        $string = preg_replace("/&#?[a-z0-9]{2,8};/i","",$string);
        $string = str_replace(':', '', $string);
        $string = str_replace(';', '', $string);
        $string = str_replace('[', '', $string);
        $string = str_replace(']', '', $string);
        $string = str_replace('-', '', $string);
        $string = str_replace('!', '', $string);
        $string = str_replace('?', '', $string);
        $string = str_replace('  ', ' ', $string);
        $string = str_replace('   ', ' ', $string);

        return $string;
    }

    private function removeTitleFromRSSItem($rss_item)
    {
        $game = $rss_item->game;

        // If the game-title is exactly in the rss_item, remove it
        if (strpos(strtolower($rss_item->title), strtolower($game->title)) !== false) {
            return str_replace(strtolower($game->title), '', strtolower($rss_item->title));
        }

        // Aliases for games
        if(isset($game->aliases) && $game->aliases != null) {

            $aliases = rtrim($game->aliases, ',');
            $aliases = explode(',', $aliases);

            foreach($aliases as $alias) {

                if (strpos(strtolower($rss_item->title), strtolower($alias)) !== false) {
                    return str_replace(strtolower($game->title), '', strtolower($rss_item->title));
                }
            }
        }

        return strtolower($rss_item->title);
    }
}