<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Not sure I want this, but disable the check for foreign keys
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Resets the User table
        DB::table('users')->truncate();

        // Generate 3 users/authors
        DB::table('users')->insert([
            [
                'username'  => 'gamescomevent redaction',
                'email'     => 'redaction@gamescomevent.com',
                'password'  => bcrypt('secret'),
            ],
            [
                'username'  => 'Jane Doe',
                'email'     => 'janedoe@test.com',
                'password'  => bcrypt('secret'),
            ],
            [
                'username'  => 'Jeffrey Sloof',
                'email'     => 'jeffrey_wii@hotmail.com',
                'password'  => bcrypt('secret'),
            ],
        ]);
    }
}
