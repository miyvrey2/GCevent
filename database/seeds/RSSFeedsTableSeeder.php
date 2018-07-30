<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RSSFeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the User table
        DB::table('rss_feeds')->truncate();

        // Generate 10 Dummy posts data
        $RSS_feeds = [];
        $faker = Factory::create();
        $date = Carbon::now();

        // About page
        $RSS_feeds = [
            'site'          => '_game_site_',
            'title'         => 'NES is coming up to your home!',
            'url'           => 'https://nintendo.com/nes/',
            'categories'    => 'console',
            'game_id'    => 1,
            'published_at'  => $date,
        ];


        DB::table('rss_feeds')->insert($RSS_feeds);
    }
}
