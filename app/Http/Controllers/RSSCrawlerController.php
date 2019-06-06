<?php

namespace App\Http\Controllers;

use App\Platform;
use App\Game;
use App\RSSItem;
use App\GamePlatform;
use App\RSSWebsite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RSSCrawlerController extends Controller
{
    public $keywordWithPrevWord = array();
    public $keywordWithTwoPrevWord = array();
    public $keywordWithNextWord = array();
    public $keywordWithTwoNextWord = array();
    public $keywordWithPrevNextWord = array();
    public $expire_in_days = 10;



    //
    public function crawl()
    {

        ini_set("default_charset", 'utf-8');
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes


        // Setup for saving our crawlings
        $date_of_expire = Carbon::now()->subDays($this->expire_in_days);
        $platforms = Platform::all();

        $rss_websites = RSSWebsite::all();

        foreach($rss_websites as $site) {

            // Setup which site to crawl
            $url = $site->rss_url;
            $xml = simplexml_load_string($this->getHTMLPage($url));

            // Process the crawled XML data to CSV
            foreach($xml->channel->item as $item) {

                $title 		= htmlspecialchars_decode($this->decodeXML($item->title->__toString(), $site->title));
                if($site->article_format == "guid") {
                    $url 	= htmlspecialchars(utf8_decode($item->guid->__toString()));
                } else {
                    $url 	= htmlspecialchars(utf8_decode($item->link->__toString()));
                }
                $datetime	= $item->pubDate->__toString();

                // reformat date
                $datetime = Carbon::createFromFormat($site->date_format, $datetime);
                if(isset($site->date_reformat) && $site->date_reformat == true) {
                    $datetime->addHours(2);
                }
                $datetime = $datetime->format("Y-m-d H:i:s");

                // Categories
                $categories = "";
                if(isset($item->category)) {
                    foreach($item->category as $category) {
                        $categories .= $category . ", ";
                    }
                }

                // Game title
                $game_id = $this->findGameidByNewsTitle($title);

                if($datetime > $date_of_expire) {

                    // Save the item to the CSV array
                    RSSItem::updateOrCreate(
                        [
                            'title' => $title,
                            'url'   => $url,
                        ],
                        [
                            'site'  => $site->title,
                            'rss_website_id'  => $site->id,
                            'published_at' => $datetime,
                            'categories' => $categories,
                            'game_id' => $game_id
                        ]
                    );

                    // Add the platforms to the game if added
                    if($game_id != null && $categories != "") {

                        foreach($platforms as $platform) {
                            if(strpos(strtolower($categories), strtolower($platform['title']))) {

                                GamePlatform::updateOrCreate([
                                    'game_id' => $game_id,
                                    'platform_id' => $platform['id']
                                ]);
                            }
                        }
                    }

                } else {

                    // If we reach the expire date, kill the foreach so we prevent long loaders
                    break;
                }
            }
        }

        $setGameTitlesToRRSFeed = $this->setGametitleToRSSFeed();
        $removeDuplicates = $this->removeDuplicates(false);
        $removeOldNews = $this->removeOldNews();

        return [
            'fetchRSSItems' => true,
            'saveRSSItems' => true,
            'setGameTitlesToRSSItems' => $setGameTitlesToRRSFeed,
            'removeDuplicates' => $removeDuplicates,
            'removeOldNews' => $removeOldNews,
        ];
    }

    private function setGametitleToRSSFeed()
    {

        $rss_items = RSSItem::whereNull('game_id')->get();

        foreach($rss_items as $rss_item) {

            // Find the game title by the RSSItem news_item
            $rss_item['game_id'] = $this->findGameidByNewsTitle($rss_item['title']);

            // Update the item
            $rss_item->update(array('game_id' => $rss_item['game_id']));
        }

        return true;
    }

    private function removeDuplicates($view = true)
    {
        $rss_items = RSSItem::select('*')
                             ->selectRaw(' COUNT(`title`) as `occurrences`')
                             ->from('rss_feeds')
                             ->where([
                ['title', '!=', ''],
            ])
                             ->groupBy('title')
                             ->having('occurrences', '>', '1')
                             ->get();

        foreach($rss_items as $record) {
            $record->forceDelete();
        }

        if($view) {
            return "removed the duplicaties";
        }
        return true;
    }

    private function removeOldNews() {

        $file = 'data/' .Carbon::now()->format("Y-m") . '.json';

        // Get all the old rss_items
        $db_items = RSSItem::where('published_at', '<', Carbon::now()->subDay($this->expire_in_days))->get();

        if(Storage::disk('local')->exists($file)) {
            // get the current rss_items in the json file
            $file_items = json_decode(Storage::disk('local')->get($file));

            // foreach item still in the DB
            foreach($db_items as $db_item) {

                $in_file = false;

                // And foreach item in the JSON file
                foreach($file_items as $file_item) {

                    if($file_item->title == $db_item->title) {
                        $in_file = true;
                    }
                }

                // If there was no occurrence, we place t he item in the JSON file
                if ($in_file == false) {

                    // Delete in DTB
                    $db_item->delete();

                    // Now put it into the file
                    unset($db_item['id']);
                    $file_items[] = $db_item;
                }
            }
        } else {

            $file_items = array();

            foreach($db_items as $db_item) {
                // Delete in DTB
                $db_item->delete();

                // Now put it into the file
                unset($db_item['id']);
                $file_items[] = $db_item;
            }
        }

        // Save the json_items
        Storage::disk('local')->put($file, json_encode($file_items));

        // Return if wanted
        return true;
    }

    /**
     * getHTMLPage($url) - Get the html from the requested page
     * @param $url
     *
     * @return bool|string
     */
    private function getHTMLPage($url)
    {
        $opts = array(
            'http' => array (
                'method' => 'GET',
                'header' => "
                    User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36; \r\n
			        "
            ),
            // TODO fix the verification of openSSL
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        // Open the stream
        $context = stream_context_create($opts);

        // Get the page
        $page = file_get_contents($url, false, $context);

        // Return the value
        return $page;
    }

    /**
     * decodeXML($string, $bool) - If bool is true, return the utf8_decoded string
     * @param $string
     * @param $bool
     *
     * @return string
     */
    private function decodeXML($string, $bool)
    {

        $string = str_replace('ï¿½','é', $string);

        if($bool === true) {
            return utf8_decode($string);
        }

        return $string;
    }

    private function findGameidByNewsTitle($newstitle = '')
    {

        // get game list
        $game_titles = Game::all();

        foreach ($game_titles as $game) {

            // Remove some special characters
            $newstitle = $this->removeSpecialCharacters($newstitle);
            $game['title'] = $this->removeSpecialCharacters($game['title']);

            if (strpos(strtolower($newstitle), strtolower($game['title'])) !== false) {
                return $game['id'];
            }

            // Aliases for games
            if(isset($game['aliases']) && $game['aliases'] != null) {

                $aliases = rtrim($game['aliases'], ',');
                $aliases = explode(',', $aliases);

                foreach($aliases as $alias) {

                    if (strpos(strtolower($newstitle), strtolower($alias)) !== false) {
                        return $game['id'];
                    }
                }
            }
        }

        return null;
    }

    public function suggestGameTitle()
    {
        $rss_items = RSSItem::where([
            ['published_at', '>=', Carbon::now()->subHours(48)],
            ['game_id', '=', null]
        ])->get();

        // Get the keywords
        $file = 'data/RSSitems/keywords.json';
        if (Storage::disk('local')->exists($file)) {
            $file_items = json_decode(Storage::disk('local')->get($file), true);
        }

        $suggestions = [];

        // Loop trough the rss_items
        foreach($rss_items as $item){

            // get each word out of the title
            $title_as_array = explode(' ', $this->removeSpecialCharacters($item->title));

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
                $suggestions[$item->id]["title"] = $item->title;
                $suggestions[$item->id]["words"] = $title_as_array;
            }
        }

        return view('backend.rssitem.suggest', compact('suggestions'));
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
}
