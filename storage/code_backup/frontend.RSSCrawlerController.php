
// Old. The crawlercontrller (frontend) had fetched all the articles. This code needed to get the game titles out of those articles. The game titles were combined groups of words that would suggest where occurences are more than once. Depricated since the new fetcher.

public function getGameTitles()
{

    // First, be sure we have all the games (we saved) added to the RSS_Feed newsitems
    $this->setGametitleToRSSFeed();

    // Now, fetch all the newsitems so we can get the single keywords out of it
    $feed_items = RSSItem::whereNull('game_id')->orderBy('published_at','desc')->get();
    $keywords = $this->getSingleKeywordsFromRSSFeeds($feed_items);
    $probable_game_titles = [];

    // loop trough each key (like, "2018") and get all the titles regarding it
    foreach($keywords as $keyword => $value){

        // Empty arrays
        $keywordWithTwoPrevWord = [];
        $keywordWithTwoNextWord = [];
        $keywordWithPrevNextWord = [];

        // Retrieve all newsitems with the keyword in the title
        $news_items = RSSItem::whereNull('game_id')->whereRaw('(LOWER (title) LIKE "% '.strtolower($keyword).' %" OR LOWER (title) LIKE "'.strtolower($keyword).' %")')->get();

        // retrieve previous word
        $keywordWithPrevWord = $this->getPreviousWord($keyword, $news_items);

        // Loop trough the 'last-word + key' options
        foreach($keywordWithPrevWord as $keywithprev) {

            // retrieve previous word (3 words in total)
            $tmp_result = $this->getPreviousWord($keywithprev['snippet'], $news_items);

            // Make key_values easier to read.
            foreach($tmp_result as $key => $result) {
                $keywordWithTwoPrevWord[$key] = $tmp_result[$key];
            }
        }

        // retrieve next word
        $keywordWithNextWord = $this->getNextWord($keyword, $news_items);

        // Loop trough the 'key + next-word' options
        foreach($keywordWithNextWord as $keywithnext) {

            // retrieve previous word (3 words in total)
            $tmp_result = $this->getNextWord($keywithnext['snippet'], $news_items);

            // Make key_values easier to read.
            foreach($tmp_result as $key => $result) {
                $keywordWithTwoNextWord[$key] = $tmp_result[$key];
            }
        }

        // Loop trough the 'prev-word + key + next-word' options
        foreach($keywordWithPrevWord as $keywithprev) {

            // retrieve previous word (3 words in total)
            $tmp_result = $this->getNextWord($keywithprev['snippet'], $news_items);

            // Make key_values easier to read.
            foreach($tmp_result as $key => $result) {
                $keywordWithPrevNextWord[$key] = $tmp_result[$key];
            }
        }


        $probable_game_titles[] = $this->stripKeywordIfOneOccurrence($keywordWithPrevWord);
        $probable_game_titles[] = $this->stripKeywordIfOneOccurrence($keywordWithTwoPrevWord);
        $probable_game_titles[] = $this->stripKeywordIfOneOccurrence($keywordWithNextWord);
        $probable_game_titles[] = $this->stripKeywordIfOneOccurrence($keywordWithTwoNextWord);
        $probable_game_titles[] = $this->stripKeywordIfOneOccurrence($keywordWithPrevNextWord);
    }

    $resetKeywords = [];
    foreach($keywords as $key => $value) {
        $resetKeywords[$key] = [
            'snippet' => $key,
            'occurrences' => $value
        ];
    }

    $probable_game_titles[] = $this->stripKeywordIfOneOccurrence($resetKeywords);

    // Loop so we can undo depth-1 of array
    $game_titles = [];
    foreach($probable_game_titles as $game) {
        foreach($game as $key => $value) {
            $game_titles[$key] = $value;
        }
    }

    //        dd($game_titles);

    return view('feed.gametitles', compact('game_titles'));
}

function getPreviousWord($keyword, $news_items)
{
    $tmp = [];

    foreach($news_items as $news_item) {

        if(empty($news_item['title']) || empty($keyword)) {
            break;
        }

        // forget camel casing
        $news_item['title'] = strtolower($news_item['title']);
        $keyword = strtolower($keyword);

        // If the keyword is in the newsitem, continue
        if (strpos( $news_item['title'], $keyword) !== false) {

            // Split by keyword and space before
            $titles_snippet_by_keyword = explode(' ' . $keyword, $news_item['title']);

            // If the explode returns the whole title, the keyword is at the beginning of the string
            if($titles_snippet_by_keyword[0] == $news_item['title']) {// Maak een key
                $tmp_key = str_replace(' ', '_', $keyword);

                $tmp[$tmp_key] = [
                    'snippet' => $keyword,
                    'occurrences' => 99,
                ];
            }

            $i = 0;

            // omdat er meerdere keren een keyword in 1 titel kan voorkomen, doen we een foreach erop
            foreach ($titles_snippet_by_keyword as $title_snippet) {

                // Zolang we de laatste niet gebruiken zijn we goed
                if ($i < count($titles_snippet_by_keyword) - 1) {

                    // vind het laatste woord in de snippet, zodat we "thelast word" hebben
                    $word_before = explode(' ', $title_snippet);
                    $word_before = $word_before[ count($word_before) - 1 ];

                    // Make snippet and key
                    $snippet = $word_before . ' ' . $keyword;
                    $key = str_replace(' ', '_', $snippet);

                    if ( ! in_array($snippet, array_column($tmp, 'snippet'))) { // search value in the array
                        $tmp[$key] = [
                            'snippet' => $snippet,
                            'occurrences' => 1,
                        ];
                    }
                    else {
                        $tmp[$key]['occurrences'] += 1;
                    }
                }
                $i++;
            }
        }

    }

    return $tmp;
}

function getNextWord($keyword, $news_items)
{
    $tmp = [];

    foreach($news_items as $news_item) {

        if(empty($news_item['title']) || empty($keyword)) {
            break;
        }

        // forget camel casing
        $news_item['title'] = strtolower($news_item['title']);
        $keyword = strtolower($keyword);

        // If the keyword is in the newsitem, continue
        if (strpos( $news_item['title'], $keyword) !== false) {
            // Split by the keyword
            $titles_snippet_by_keyword = explode($keyword . ' ', $news_item['title']);

            unset($titles_snippet_by_keyword[0]);

            // omdat er meerdere keren een keyword in 1 titel kan voorkomen, doen we een foreach erop
            foreach ($titles_snippet_by_keyword as $title_snippet) {

                // Vind het eerste woord na de explode op een spatie
                // Keyword is buitengesloten van de explode dus is op positie 0 het woord dat volgt op t keyword
                $word_after = explode(' ', $title_snippet)[0];

                // Make snippet and key
                $snippet = $keyword . ' ' . $word_after;
                $key = str_replace(' ', '_', $snippet);

                // Add or count up to array
                $tmp[$key] = [
                    'snippet' => $snippet,
                    'occurrences' => (isset($tmp[$key]['occurrences'])) ? $tmp[$key]['occurrences'] + 1 : 1,
                ];
            }
        }
    }

    return $tmp;
}

function stripKeywordIfOneOccurrence($array)
{
    foreach($array as $key => $item) {
        if ($item['occurrences'] == 1 or $item['occurrences'] == 99) {
            unset($array[$key]);
        }
    }

    return $array;
}

function stripIfEmptyArray($array)
{
    foreach($array as $key => $value){
        if(empty($value)) {
            unset($array[$key]);
        }
    }

    $array = array_map('array_values', $array);

    return $array;
}

function getSingleKeywordsFromRSSFeeds($data)
{

    // Get all the keywords that we already have, so we remove it from here
    $wordlist = [];
    $removeWords1 = array_map('strtolower', Publisher::pluck('title')->toArray() );
    $removeWords2 = array_map('strtolower', Game::pluck('title')->toArray() );
    $removeWords3 = array_map('strtolower', Platform::pluck('title')->toArray() );
    $removeWords4 = ['de', 'het', 'een', 'van', 'naar', 'voor', 'achter', 'op', 'onder', 'in', 'uit', 'met', 'zonder', 'nu', 'later', 'is', 'en', 'of', '-'];
    $removeWords5 = ['trailer', 'nieuwe', 'nieuw', 'jaar', 'maand', 'week'];
    $removeWords6 = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];

    $removeWordsRaw = array_merge($removeWords1, $removeWords2, $removeWords3, $removeWords4, $removeWords5, $removeWords6);

    foreach($removeWordsRaw as $removable) {

        if (strpos($removable, " ") !== false) {
            $b = explode(" ", $removable);

            foreach($b as $c) {
                $removeWords[] = strtolower($c);
            }
        }
        $removeWords[] = strtolower($removable);
    }

    // Now show me some magic. Run trough each word and count!
    foreach ($data as $row) {

        // Remove some special characters
        $row['title'] = $this->removeSpecialCharacters($row['title']);

        // get each word out of the title
        $title_as_array = explode(' ', $row['title']);

        // loop trough each word and count
        foreach ($title_as_array as $word) {
            $word = strtolower($word);
            if (!array_key_exists($word, $wordlist)) {
                $wordlist[$word] = 1;
            } else {
                $wordlist[$word] += 1;
            }
        }
    }

    arsort($wordlist);

    foreach($wordlist as $key => $value) {
        if ($value == 1) {
            unset($wordlist[$key]);
            continue;
        }

        if (in_array($key, $removeWords, true)) {
            unset($wordlist[$key]);
            continue;
        }
    }

    return $wordlist;
}