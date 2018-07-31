<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;


class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the User table
        DB::table('games')->truncate();

        // Generate 10 Dummy posts data
        $games = [];
        $faker = Factory::create();
        $date = Carbon::now();

        // About page
        $games = [[
            'publisher_id'  => 2,
            'title'         => 'Mario Odyssey',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'mario-odyssey',
            'image'         => NULL,
            'line_up_year'  => "2017",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 2,
            'title'         => 'Legend of Zelda: Breath of the Wild',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'legend-of-zelda-breath-of-the-wild',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 3,
            'title'         => 'Forza Horizon 4',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'forza-horizon-4',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 3,
            'title'         => 'Ori and the Will of the Wisps',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'ori-and-the-will-of-the-wisps',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 3,
            'title'         => 'State of Decay 2',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'state-of-decay-2',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 3,
            'title'         => 'PlayerUnknown"s Battlegrounds',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'playerunknowns-battelgrounds',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 3,
            'title'         => 'The Dungeon of Naheulbeuk: The Amulet of Chaos',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'the-dungeon-of-naheulbeuk-the-amulet-of-chaos',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 4,
            'title'         => 'Edge of Eternity',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'edge-of-eternity',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 4,
            'title'         => 'Old School Musical',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'old-school-musical',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 4,
            'title'         => 'Away: Journey to the unexpected',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'away-journey-to-the-unexpected',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 4,
            'title'         => 'Hover',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'hover',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 4,
            'title'         => 'Chroniric',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'chroniric',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 4,
            'title'         => 'Spitkiss',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'spitkiss',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 4,
            'title'         => 'Stay',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'stay',
            'image'         => NULL,
            'line_up_year'  => "2018",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 4,
            'title'         => 'FIFA 19',
            'excerpt'       => $faker->text(rand(250, 300)),
            'body'          => '',
            'slug'          => 'fifa-19',
            'image'         => NULL,
            'line_up_year'  => "",
            'released_at'   => Carbon::create(2017,10,27),
            'created_at'    => $date,
            'updated_at'    => $date,
        ]];

        DB::table('games')->insert($games);
    }
}
