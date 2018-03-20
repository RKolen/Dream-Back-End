<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Game;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
   
     public function store(Game $game)
    {       
            $this->validate(request(), [ 
                'description' => 'required|min:2',
                'user_id' => 'required'
            ]);
            
            $feedback = new Feedback;

            $feedback->game_id = $game->id;
            $feedback->user_id = request()->user_id;
            $feedback->description = request()->description;

            $feedback->save();

            

           // \Mail::to($game->user->email)->send( new Feedbackreceived($game));

            return back();
        

    }

}
