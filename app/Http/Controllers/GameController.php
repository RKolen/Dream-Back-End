<?php

namespace App\Http\Controllers;

use App\Game;
use Storage;
use Illuminate\Http\Request;
use App\User;
use DB;

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


        if (isset($_COOKIE['email']) && isset($_COOKIE['notpassword']))
        {
            $password = $_COOKIE['notpassword'];
            $email = $_COOKIE['email'];


            $email2 = User::where('email', $email)->first();

            $passwordcorrect = password_verify ($password, $email2->password);

            if ($passwordcorrect == true) {

            set_time_limit(0);
            $path = storage_path('app/private/games/' . $game . '/download.7z');

            return response()->download($path);
            Game::where('id', $game)->increment('downloads');


            } else {
                echo 'test';
            }
        } else {
             echo "test 2";
        }
    }


    public function image($game)
    {
        $path = storage_path('app/private/games/' . $game . '/pictures/download.jpg');
        return response()->file($path);

     }

    public function upload(Request $request)
    {   
        $file = $request->file('file');
        $title = $request->input('title');
        $description = $request->input('description');
        $picture = $request->picture;

        $id = DB::table('games')->insertGetId([
            'title' => $title,
            'description' => $description 
        ]);
        Storage::disk('local')->makeDirectory('/' . $id . '/pictures');
        $path = $picture->storeAs('/' . $id . '/pictures', 'download.jpg' ,['disk' => 'local']); 
        $pathfile = $file->storeAs('/' . $id , 'download.7z' ,['disk' => 'local']);
        
        return \Response::json(array('success' => true, 'id' => $id))->header('Access-Control-Allow-Origin', '*');

    }

    public function edit(Game $game)
    {

        return view('/games.edit', compact('game'));
    }


    public function update() 
    {   
        $game->description = $_POST['description'];
    
        $game->save();
        Game::where('id', $game)->increment('updates');

        return redirect('/games/' . $id .'/edit');
    }

    public function search()
    {   
        if (isset($_GET['orderby']))
        {
            if($_GET['orderby'] == "downloads")
            {
                $games = Game::orderBy('downloads', 'desc')->get()->toArray();
            }
            elseif ($_GET['orderby'] == "least")
            {
                $games = Game::orderBy('downloads', 'asc')->get()->toArray();
            }
             else
            {
                $games = Game::all();
            }
        }
       else
       {
            $games = Game::all();
        }
       return response($games)
           ->header('Access-Control-Allow-Origin', '*');
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

    public function test(){
        $game = 11;
        Storage::disk('local')->makeDirectory('/' . $game . '/pictures');
    }
}
