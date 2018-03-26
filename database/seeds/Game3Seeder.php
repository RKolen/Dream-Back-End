<?php

use Illuminate\Database\Seeder;

class Game3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('games')->insert([
            'title' => "Test3",
            'description' => "Super awesome game awesome super",
            'points' => 1,
            'rating' => 1,
            'downloads' => 14,
            'created_at' => "2018-03-02 01:01:01"
           
        ]);
    }
}
