<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class StandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the User table
        DB::table('stands')->truncate();

        // Generate 10 Dummy publishers data
        $publishers = [];
        $faker = Factory::create();
        $date = Carbon::now();

        // About page
        $stands = [[
            'publisher_id'  => 1,
            'hall'          => "9.1",
            'stand'         => 'A011',
            'line_up_year'  => '2018',
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 1,
            'hall'          => "9.1",
            'stand'         => 'B010',
            'line_up_year'  => '2018',
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 1,
            'hall'          => "9.1",
            'stand'         => 'A021',
            'line_up_year'  => '2018',
            'created_at'    => $date,
            'updated_at'    => $date,
        ], [
            'publisher_id'  => 1,
            'hall'          => "9.1",
            'stand'         => 'B020',
            'line_up_year'  => '2018',
            'created_at'    => $date,
            'updated_at'    => $date,
        ]];

        DB::table('stands')->insert($stands);
    }
}
