<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the User table
        DB::table('publishers')->truncate();

        // Generate 10 Dummy publishers data
        $publishers = [];
        $faker = Factory::create();
        $date = Carbon::now();

        // About page
        $publishers[] = [
            'title'         => '---',
            'excerpt'       => '---',
            'body'          => '---',
            'slug'          => 'aUndoableStringThatEnyoneCanForget4132',
            'image'         => null,
            'created_at'    => $date,
            'updated_at'    => $date,
            'found'         => null
        ];

        // About page
        $publishers[] = [
            'title'         => 'Nintendo',
            'excerpt'       => 'Nintendo is well known in the game industry. Alongside with the famous mascot Mario is the company known for over 30 years. The focus for Nintendo is, rather than to focus on high-quality graphics, mainly on the gameplay. It is also not surprising that fans are, among other things, Mario, Luigi, Link, Samus, Kirby and many others.',
            'body'          => $faker->paragraphs(rand(10, 15), true),
            'slug'          => 'nintendo',
            'image'         => 'https://www.gamescomevent.com/gfx/slider_image_01_mini.jpg',
            'created_at'    => $date,
            'updated_at'    => $date,
            'found'         => Carbon::createFromDate(1889,9, 23)
        ];

        $publishers[] = [
            'title'         => 'Microsoft',
            'excerpt'       => '',
            'body'          => '',
            'slug'          => 'microsoft',
            'image'         => null,
            'created_at'    => $date,
            'updated_at'    => $date,
            'found'         => Carbon::createFromDate(1975,4, 1)
        ];

        $publishers[] = [
            'title'         => 'Playdius',
            'excerpt'       => 'Playdius started in 2015 as publisher for talented indie games. Since that time they released all sorts of games for PC, PS4, XBOX one, Switch and mobile platforms. With their motto "Play outside the box" they produce creative and different games.',
            'body'          => 'This year they will surprise us with some new titles on the market.',
            'slug'          => 'playdius',
            'image'         => 'https://www.gamescomevent.com/gfx/slider_image_01_mini.jpg',
            'created_at'    => $date,
            'updated_at'    => $date,
            'found'         => Carbon::createFromDate(2015,1, 1)
        ];

        $publishers[] = [
            'title'         => 'Bandai Namco',
            'excerpt'       => '',
            'body'          => 'Jump Force, Soul Calibur VI, Dragon Ball Fighter op Nintendo Switch, One Pice World Seeker, Code Vein, Ace Combat 7: Skies Unknown, My Hero One\'s Justice, Naruto to Boruto: Shinobi Striker',
            'slug'          => 'bandai-namco',
            'image'         => 'https://www.gamescomevent.com/gfx/slider_image_01_mini.jpg',
            'created_at'    => $date,
            'updated_at'    => $date,
            'found'         => Carbon::createFromDate(1955,6, 1)
        ];

        $publishers[] = [
            'title'         => 'THQ Nordic',
            'excerpt'       => '',
            'body'          => 'Darksiders III, Biomutant, Wreckfest',
            'slug'          => 'thq-nordic',
            'image'         => 'https://www.gamescomevent.com/gfx/slider_image_01_mini.jpg',
            'created_at'    => $date,
            'updated_at'    => $date,
            'found'         => Carbon::createFromDate(2011,6, 23)
        ];

        $publishers[] = [
            'title'         => 'E-line Media',
            'excerpt'       => '',
            'body'          => 'Beyond Blue, Endless Mission',
            'slug'          => 'e-line-media',
            'image'         => null,
            'created_at'    => $date,
            'updated_at'    => $date,
            'found'         => Carbon::createFromDate(2007,1, 1)
        ];

        DB::table('publishers')->insert($publishers);
    }
}
