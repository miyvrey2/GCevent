<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the User table
        DB::table('pages')->truncate();

        // Generate 10 Dummy posts data
        $pages = [];
        $date = Carbon::now();

        // About page
        $pages[] = [
            'author_id'     => 1,
            'title'         => 'Gamescom 2018',
            'excerpt'       => 'This year it will be the tenth time Gamescom will be held. since 2008 opens the Koelnmesse her doors for all the gamers and fans to fall in love with the works of the exhibitors such as Microsoft studios, Nintendo and Sony. With more than 355,000 visitors in 2017, is it the largest game-event in Europe.',
            'body'          => 'Gamescom is a convention where the gamers among us feel completely at home. Once a year the Koelnmesse exhibition halls are filled with the latest (and retro!) games, consoles and all what not to play is dedicated. Companies (both large and small) in the game industry here show their latest work and offer the chance to see some games even play, for they are in the store. </p>
<br />
<p>The stock market has a total of 201,000 m2 where to find everything. This space is spread over several halls. So, there are halls for the latest games and consoles. This is the biggest part. There is also a (part of) a hall reserved for merchandise. There are also areas classified for promotion of hardware, studies, retro games, sports and dining. There are also two separate halls for the so-called "trade visitors" and the press. These halls are also called the " business area " called. Here are separate tickets for, and the stock market is also a day earlier open to this kind of visitors. </p>
<br />
<p>Along with 345,000 other visitors, is the 9th anniversary celebration of Gamescom last year. The highlights of this party were the One Xbox and PlayStation 4 that were playable. There were also events such as League of Legends tournaments. </p>
<br />
<p style="font-size:10px;">this part of the site has been translated by google translate. Don\'t worry, we will "re"-translate this in a few days. </p>',
            'sidebar_title' => '',
            'sidebar_body'  => '',
            'slug'          => 'gamescom-2018',
            'image'         => '',
            'created_at'    => $date,
            'updated_at'    => $date,
            'published_at'  => $date,
        ];

        // About page
        $pages[] = [
            'author_id'     => 1,
            'title'         => 'Tickets',
            'excerpt'       => 'Want to join in the Gamescom festivities? For getting access to the fairgrounds you need to have a ticket. In general, there are 4 types of tickets you can choose from. The difference lies by what you are. Are you ready to look up which tickets suits you most?',
            'body'          => 'First, we have a <strong>day ticket</strong>. This is the regular ticket that anyone can buy to entrance the fair grounds. The ticket is only valid for one person. If you would like to keep it simple you can go and buy this ticket. If you are a senior, school going child (above the age of 12), a student, a senior of the age of 65 (or older) or a severely disabled person you can go for the <strong>reduced day ticket</strong> This ticket is especially for the given groups, if they can provide a identification so they can verify that they belong to this group.<br /> <br />
If you are a parent or guardian and want to visit the halls, you can also get a <strong> children\'s day ticket</strong> for your 7 to 11 years old child. The child may only enter when he/she is accompanied by an adult. <br />
Afternoon Ticket <br />
Family day ticket <br />',
            'sidebar_title' => 'Ticket Types',
            'sidebar_body'  => '<ul><li>Day ticket</li><li>Reduced day ticket</li><li>Childrens day ticket</li><li>Afternoon ticket</li><li>Family day ticket</li></ul>',
            'slug'          => 'tickets',
            'image'         => '',
            'created_at'    => $date,
            'updated_at'    => $date,
            'published_at'  => $date,
        ];

        DB::table('pages')->insert($pages);
    }
}
