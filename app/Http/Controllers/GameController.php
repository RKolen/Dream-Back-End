<?php

namespace App\Http\Controllers;

use App\Game;
use Storage;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
        $path = storage_path('app/private/games/' . $game . '/download.jpg');
        return response()->download($path);
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

    public function update($id) {

        

        $game = Game::find($id);
        $game->title = request()->title;
        $game->description = request()->description;

        $game->save();

        return redirect('/games/' . $id .'/edit');
    }

}
