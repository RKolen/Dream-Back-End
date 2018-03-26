<?php

use Illuminate\Database\Seeder;

class Game1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'title' => "Test",
            'description' => "Game Test beste game ever",
            'points' => 1,
            'rating' => 1,
            'downloads' => 1,
            'created_at' => "2018-01-01 01:01:01"
           
        ]);
    }
}
