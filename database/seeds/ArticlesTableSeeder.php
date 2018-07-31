<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resets the User table
        DB::table('articles')->truncate();

        // Generate 10 Dummy posts data
        $articles = [];
        $date = Carbon::now();

        // About page
        $articles[] = [
            'author_id'     => 3,
            'game_id'       => 1,
            'title'         => 'Spin and burst',
            'slug'          => 'spin-and-burst',
            'excerpt'       => 'Mario can\'t stay still! The new DLC gives us an expansion of the darker side of the moon. Suprisingly called: Darkest side of the moon! We got to see a glimpse of this world, and the improved moveset that Mario has been given.',
            'body'          => 'Mario is a hero that truly likes to jump around. The red-colored friend is always on the move to get higher. Even the moon doesn\'t seem to be the highest wall to overcome! Nintendo provides a new adventure with the DLC \'darkest side of the moon\'. The amount of stars you can collect has been expanded to 210 stars. Also are there some extra bosses you can fight. 

But the most biggest item of the DLC is the new moveset of Mario! When you tried to jump in the original Mario Odyssey, you could fly to a certain height. To give players a more feeling of freedom, the jump has been increased in it\'s height. When you jump twice and hold the jump-button, you can "hover" in the air.',
            'source'        => 'https://nintendolife.com',
            'sidebar_title' => '',
            'sidebar_body'  => '',
            'image'         => '',
            'published_at'  => $date,
            'created_at'    => $date,
            'updated_at'    => $date,
            'deleted_at'    => null,
        ];

        DB::table('articles')->insert($articles);
    }
}
