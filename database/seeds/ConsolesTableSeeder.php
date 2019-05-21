<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ConsolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the Platforms table
        DB::table('platforms')->truncate();

        // Generate newest platforms
        $date = Carbon::now();

        $platforms = [
            [
                'title'         => 'PlayStation 4',
                'slug'          => 'playstation-4',
                'excerpt'       => '',
                'body'          => '',
                'image'         => '',
                'aliases'       => 'ps4,playstation 4 pro',
                'released_at'   => $date,
                'created_at'    => $date,
                'updated_at'    => $date,
            ],
            [
                'title'         => 'Xbox one',
                'slug'          => 'xbox-one',
                'excerpt'       => '',
                'body'          => '',
                'image'         => '',
                'aliases'       => 'xbox one x',
                'released_at'   => $date,
                'created_at'    => $date,
                'updated_at'    => $date,
            ],
            [
                'title'         => 'Switch',
                'slug'          => 'switch',
                'excerpt'       => '',
                'body'          => '',
                'image'         => '',
                'aliases'       => 'nintendo switch',
                'released_at'   => $date,
                'created_at'    => $date,
                'updated_at'    => $date,
            ]
        ];

        DB::table('platforms')->insert($platforms);
    }
}
