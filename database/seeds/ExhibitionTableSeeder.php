<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ExhibitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the User table
        DB::table('exhibitions')->truncate();

        // Add a seed
        $exhibitions = [];
        $date = Carbon::now();

        // About page
        $exhibitions[] = [
            'title'         => 'Gamescom 2019',
            'excerpt'       => 'This year it will be the eleventh time Gamescom will be held. since 2008 opens the Koelnmesse her doors for all the gamers and fans to fall in love with the works of the exhibitors such as Microsoft studios, Nintendo and Sony. With more than 355,000 visitors in 2017, is it the largest game-event in Europe.',
            'body'          => 'Gamescom is a convention where the gamers among us feel completely at home. Once a year the Koelnmesse exhibition halls are filled with the latest (and retro!) games, consoles and all what not to play is dedicated. Companies (both large and small) in the game industry here show their latest work and offer the chance to see some games even play, for they are in the store. </p>
<br />
<p>The stock market has a total of 201,000 m2 where to find everything. This space is spread over several halls. So, there are halls for the latest games and consoles. This is the biggest part. There is also a (part of) a hall reserved for merchandise. There are also areas classified for promotion of hardware, studies, retro games, sports and dining. There are also two separate halls for the so-called "trade visitors" and the press. These halls are also called the " business area " called. Here are separate tickets for, and the stock market is also a day earlier open to this kind of visitors. </p>
<br />
<p>Along with 345,000 other visitors, is the 9th anniversary celebration of Gamescom last year. The highlights of this party were the One Xbox and PlayStation 4 that were playable. There were also events such as League of Legends tournaments. </p>
<br />
<p style="font-size:10px;">this part of the site has been translated by google translate. Don\'t worry, we will "re"-translate this in a few days. </p>',
            'address'       => 'Messepl. 1, 50679 Köln',
            'country'       => 'Germany',
            'latitude'      => '50.945271',
            'longitude'     => '6.979328',
            'slug'          => 'gamescom-2019',
            'created_at'    => $date,
            'updated_at'    => $date,
            'starts_at'     => $date,
            'ends_at'       => $date,
        ];

        DB::table('exhibitions')->insert($exhibitions);
    }
}
