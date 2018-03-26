<?php

use Illuminate\Database\Seeder;

class Game2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'title' => "Test2",
            'description' => "Super awesome game",
            'points' => 1,
            'rating' => 1,
            'downloads' => 2,
            'created_at' => "2018-02-02 01:01:01"
           
        ]);
    }
}
