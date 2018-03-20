<?php

namespace App\Http\Controllers;

use App\Game;
use Storage;
use Illuminate\Http\Request;
use App\User;

class GameController extends Controller
{
    
    public function index()
    {
        $discover = Game::orderBy('downloads', 'asc')->take(4)->get()->toArray();
        $spotlight = Game::orderBy('downloads', 'desc')->take(1)->get()->toArray();
      
        $games = new \stdClass();
        $games->discover = $discover;
        $games->spotlight = $spotlight;
        
        $json = json_encode($games);

        return $json;
    }

    public function show(Game $game)
    {
         $json = json_encode($game);

         return $json;
    }

    public function download($game)
    {
        
        $password = $_COOKIE['notpassword'];
        $email = $_COOKIE['email'];

        $email2 = User::where('email', $email)->first();

        $passwordcorrect = password_verify ($password, $email2->password);

        if ($passwordcorrect == true) {

        $path = storage_path('app/private/games/' . $game . '/download.jpg');

        return response()->download($path);
        Game::where('id', $game)->increment('downloads');

        } else {
            abort(404);
        }
    }




    public function image($game)
    {   
        $path = storage_path('app/private/games/' . $game . '/pictures/download.jpg');
        return response()->file($path);
        
     }

    public function upload(Request $request)
    {
       $files = $request->file('file');

       if(!empty($files)):

            foreach($files as $file):
                Storage::put($file->getClientOriginalName(), file_get_contents($file));
            endforeach;

            endif;

       return \Response::json(array('success' => true));

    }

    public function edit(Game $game) 
    {

        return view('/games.edit', compact('game'));
    }

    public function update($id) 
    {

        $game = Game::find($id);
        $game->title = request()->title;
        $game->description = request()->description;

        $game->save();
        Game::where('id', $game)->increment('updates');

        return redirect('/games/' . $id .'/edit');
    }

    public function search(Request $request) 
    {

        $search = $request->search;

        $games = Game::where('body','LIKE','%' . $search . '%')->Latest()->get();
        return view('index', compact('games'));

    }
    public function findDownloads(Request $request)
    {   
        $games = Game::orderBy('downloads', 'desc')->get()->toArray();  

        $json = json_encode($games);
    
        return $json;
    }
    public function findName()
    {   
        $games = Game::orderBy('title', 'asc')->get()->toArray();  

        $json = json_encode($games);
    
        return $json;
    }

}
