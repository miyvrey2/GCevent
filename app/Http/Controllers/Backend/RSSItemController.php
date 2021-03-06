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

        $rss_items = RSSItem::where('published_at', '>=', Carbon::now()->subHours(48))
                             ->orderBy('published_at', 'desc')
                             ->get();

        return view('backend.rssitem.index', compact('rss_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RSSItem $rss_item
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(RSSItem $rss_item)
    {
        // Get all the games
        $games = Game::all(); // Doesn't have to be ordered since it is for auto-completion
        $games->push(new Game());
        $games = $games->sortBy("title");

        return view('backend.rssitem.edit', compact('rss_item', 'games'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RSSItem $rss_item
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RSSItem $rss_item)
    {
        // Validate
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
            'site' => 'required|string',
            'game_id' => 'nullable|integer',
        ]);

        // Save the updates
        $rss_item->update($request->all());

        return Redirect::to('/admin/rssitems');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RSSItem $rss_item
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(RSSItem $rss_item)
    {
        // Delete the game
        $rss_item->delete();

        return Redirect::to('/admin/rssitems');

    }

    public function import()
    {

        // Get the file
        $file = 'data/2019-05.json';

        if (Storage::disk('local')->exists($file)) {

            $file_items = json_decode(Storage::disk('local')->get($file), true);

//            foreach($file_items as $key => $file_item) {
//
//                if($key <= 100) {
//
//                    RSSItem::updateOrCreate(
//                        [
//                            'title' => $file_item['title'],
//                            'url'   => $file_item['url'],
//                        ],
//                        [
//                            'site'  => $file_item['site'],
//                            'published_at' => $file_item['published_at'],
//                            'categories' => $file_item['categories'],
//                            'game_id' => $file_item['game_id']
//                        ]
//                    );
//                }
//            }

            return $file_items;
        }
    }

    /**
     * Display a listing of the archived resource.
     *
     * @param $dateFrom
     * @param null $dateTo
     *
     * @return \Illuminate\Http\Response
     */
    public function archive($dateFrom, $dateTo = null)
    {
        //
        ini_set("default_charset", 'utf-8');

        if($dateTo != null) {
            $rss_items = RSSItem::where([
                ['published_at', '>=', Carbon::parse($dateFrom)->format('Y-m-d H:i:s')],
                ['published_at', '<=', Carbon::parse($dateTo)->format('Y-m-d H:i:s')]
            ])
            ->withTrashed()
            ->orderBy('published_at', 'desc')
            ->get();
        } else {
            $rss_items = RSSItem::where([
                ['published_at', '>=', Carbon::parse($dateFrom)],
                ['published_at', '<=', Carbon::parse($dateFrom)->addMonth()]
            ])
            ->withTrashed()
            ->orderBy('published_at', 'desc')
            ->get();
        }

        // Get the keywords
        $file = 'data/RSSitems/keywords.json';
        if (Storage::disk('local')->exists($file)) {
            $file_items = json_decode(Storage::disk('local')->get($file), true);
        }

        foreach($rss_items as $rss_item) {

            // get each word out of the title
            $title_as_array = explode(' ', $this->removeSpecialCharacters($rss_item->title));

            // loop trough each word
            foreach ($title_as_array as $key => $word) {

                $word = strtolower($word);

                if ($word === "") {
                    continue;
                }

                if(array_key_exists($word, $file_items['items'])) {
                    if ($file_items['items'][ $word ]['in_game'] == 0 && $file_items['items'][ $word ]['other'] > 0) {
                        unset($title_as_array[ $key ]);
                    }
                }
            }

            if($title_as_array != [0 => ""]) {
                $rss_item['suggestions'] = $title_as_array;
            }
        }

        return view('backend.rssitem.index', compact('rss_items'));
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