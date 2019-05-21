<?php

use Illuminate\Database\Seeder;

class ConsoleGameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the User table
        DB::table('game_platform')->truncate();

        // Generate 10 Dummy posts data
        $articles = [];

        // About page
        $articles[] = [
            'platform_id'   => 3,
            'game_id'       => 1,
        ];

        DB::table('game_platform')->insert($articles);
    }
}
