<?php

use Illuminate\Database\Seeder;

class Game7Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'title' => "Adam",
            'description' => "Adam is a Webby Award winning short film created with the Unity game engine and rendered in real time. 
            				It’s built to showcase and test out the graphical quality achievable with Unity in 2016. The Unity Demo Team built Adam with beta versions of Unity 5.4 and our upcoming cinematic sequencer tool. Adam also utilizes an experimental implementation of real-time area lights and makes extensive use of high fidelity physics simulation tool CaronteFX, which you can get from  the Unity Asset Store right now. 
            				To make Adam, the Demo Team developed custom tools and features on top of Unity including volumetric fog, a transparency shader and motion blur to cover specific production needs. We’ll make these freely available soon! Adam runs at 1440p on a GeForce GTX980. Attendees at Unite Europe were able to play with it in real time, and we’ll make a playable available soon so everyone can check it out. A short version of Adam was also shown at GDC in March 2016",
            'points' => 9,
            'rating' => 1,
            'downloads' => 2500,
            'created_at' => "2018-03-02 01:01:01"
           
        ]);
    }
}
