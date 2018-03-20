<?php

use Illuminate\Database\Seeder;

class Category1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_title' => "MMO"  
        ]);


        DB::table('categories')->insert([
            'category_title' => "Simulations"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "Adventure"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "RTS"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "Puzzle"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "Action"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "Stealth Shooter"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "Combat"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "FPS"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "Sports"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "RPG"  
        ]);

        DB::table('categories')->insert([
            'category_title' => "Educational" 
        ]);
    }
}

