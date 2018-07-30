<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(PagesTableSeeder::class);
         $this->call(PublisherSeeder::class);
         $this->call(GamesSeeder::class);
         $this->call(StandsTableSeeder::class);
         $this->call(RSSFeedsTableSeeder::class);
    }
}
