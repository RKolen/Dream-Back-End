<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Raymond";
        $user->email = "test@hotmail.com";
        $user->password = bcrypt(env('STANDARD_PASSWORD'));
        $user->save();

        $user = new User();
        $user->name = "Riccardo";
        $user->email = "riccard.io@outlook.com";
        $user->password = bcrypt(env('STANDARD_PASSWORD'));
        $user->save();

        $user = new User();
        $user->name = "Jeroen";
        $user->email = "test@gmail.com";
        $user->password = bcrypt(env('STANDARD_PASSWORD'));
        $user->save();
    }
}
