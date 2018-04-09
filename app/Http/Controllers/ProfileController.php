<?php

namespace App\Http\Controllers;


use App\User;
use App\Game;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function read($profileId) 
	{
      	$user = User::find($profileId);
     	if(! $user) {
        return "User doesn't exist";
    	}
    return $user;
	}
}
