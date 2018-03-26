<?php

use Illuminate\Database\Seeder;

class Game5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'title' => "Test5",
            'description' => "awesome game ",
            'points' => 1,
            'rating' => 1,
            'downloads' => 1,
            'created_at' => "2018-03-02 01:01:01"
           
        ]);
    }
}
