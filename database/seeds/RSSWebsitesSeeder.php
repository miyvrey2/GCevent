<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RSSWebsitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the RSS Website table
        DB::table('rss_websites')->truncate();

        // About page
        $rss_websites = [
            [
                'title'             => '4gamers',
                'url'               => 'http://www.4gamers.be',
                'rss_url'           => 'http://www.4gamers.be/rss',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'dailynintendo',
                'url'               => 'https://www.dailynintendo.nl',
                'rss_url'           => 'https://www.dailynintendo.nl/feed/',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 1, // +2 uur rekenen
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'evilgamerz',
                'url'               => 'https://www.evilgamerz.com',
                'rss_url'           => 'https://www.evilgamerz.com/nieuws/evilgamerz.xml',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'gamed',
                'url'               => 'https://www.gamed.nl',
                'rss_url'           => 'https://www.gamed.nl/rss',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'gameliner',
                'url'               => 'https://www.gameliner.nl',
                'rss_url'           => 'https://feeds.feedburner.com/gameliner/SuOy',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 1,
                'active'            => 1
            ], [
                'title'             => 'gameparty',
                'url'               => 'https://www.gameparty.net',
                'rss_url'           => 'https://www.gameparty.net/feed/',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'gamequarter',
                'url'               => 'http://www.gamequarter.be',
                'rss_url'           => 'http://www.gamequarter.be/rss/nieuws.xml',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 1,
                'active'            => 1
            ], [
                'title'             => 'gamereactor',
                'url'               => 'https://www.gamereactor.nl',
                'rss_url'           => 'https://www.gamereactor.nl/rss/rss.php?texttype=4',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'gamesnetnl',
                'url'               => 'https://gamersnet.nl',
                'rss_url'           => 'https://gamersnet.nl/feed/',
                'article_format'    => 'guid',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'gamingnation',
                'url'               => 'https://www.gamingnation.nl',
                'rss_url'           => 'https://www.gamingnation.nl/feed/',
                'article_format'    => 'guid',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 1,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'igamernl',
                'url'               => 'https://www.insidegamer.nl',
                'rss_url'           => 'https://api.reshift.nl/feeds/16/RSS/',
                'article_format'    => 'link',
                'date_format'       => 'Y-m-d\TH:i:sZ',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'ignnl',
                'url'               => 'https://nl.ign.com',
                'rss_url'           => 'https://nl.ign.com/feed.xml',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'powerunlimited',
                'url'               => 'https://www.pu.nl',
                'rss_url'           => 'https://www.pu.nl/feeds/all/',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'thatsgaming',
                'url'               => 'https://thatsgaming.nl',
                'rss_url'           => 'https://thatsgaming.nl/feed/',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'xboxworldnl',
                'url'               => 'https://www.xboxworld.nl',
                'rss_url'           => 'https://www.xboxworld.nl/artikelen/rss/',
                'article_format'    => 'link',
                'date_format'       => 'D, d M Y H:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ], [
                'title'             => 'xgn',
                'url'               => 'https://www.xgn.nl',
                'rss_url'           => 'https://www.xgn.nl/rss',
                'article_format'    => 'link',
                'date_format'       => 'Y-m-d\TH:i:s O',
                'date_reformat'     => 0,
                'decode_utf8_title' => 0,
                'active'            => 1
            ]
        ];

        DB::table('rss_websites')->insert($rss_websites);
    }
}
