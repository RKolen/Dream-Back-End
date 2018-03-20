<?php

namespace App\Http\Controllers;


use App\User;
use App\Game;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function followUser(int $profileId)
	{
	  	$user = User::find($profileId);

	  	if(! $user) {

	     	return redirect()->back()->with('error', 'User does not exist.');

		}

		$user->followers()->attach(auth()->user()->id);

		return redirect()->back()->with('success', 'Successfully followed the user.');
	}

	public function unFollowUser(int $profileId)
	{
	  	$user = User::find($profileId);
	  	if(! $user) {

	     	return redirect()->back()->with('error', 'User does not exist.');
	 	}

	$user->followers()->detach(auth()->user()->id);


	return redirect()->back()->with('success', 'Successfully unfollowed the user.');

	}

	public function read() {

		if (Auth::check()) {

			$user = Auth::user();

			return view('profile.page', compact('user'));

		} else {

			return redirect('/login');

		}

	}
}
