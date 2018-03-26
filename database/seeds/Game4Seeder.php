<?php

use Illuminate\Database\Seeder;

class Game4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'title' => "Test4",
            'description' => "test description",
            'points' => 1,
            'rating' => 1,
            'downloads' => 4,
            'created_at' => "2018-03-02 01:01:01"
           
        ]);
    }
}
