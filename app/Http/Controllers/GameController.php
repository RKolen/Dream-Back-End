<?php

namespace App\Http\Controllers;

use App\Game;
use Storage;
use Illuminate\Http\Request;
use App\User;
use DB;
use App\Category;

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

            if ($passwordcorrect == true) 
            {
                set_time_limit(0);
                $path = storage_path('app/private/games/' . $game . '/download.7z');
                Game::where('id', $game)->increment('downloads');
                return response()->download($path);

            } else 
            {
                echo 'test';
            }
        } else 
        {
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
        $category = $request->input('category_id');

        $id = DB::table('games')->insertGetId([
            'title' => $title,
            'description' => $description
        ]);
        $game = Game::find($id);

        $game->category()->attach(request('category_id'));

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
        if (isset($_GET['orderby']) && isset($_GET['category']))
        {
          //if all categories are searched for
            if ($_GET['category'] == "all")
            {
                $games = Game::orderBy('downloads', $_GET['orderby'])->get()->toArray();
            }
            //if certain categories are searched for
            else 
            {
                $games = [];
                $gamesforcategory = DB::table('category_game')->where( 'category_id', $_GET['category'])->get()->pluck(['game_id']);
                if (count($gamesforcategory) != 0)
                {
                    foreach ($gamesforcategory as $game)
                    {
                        $result = Game::where('id', $game)->get();
                        array_push($games, $result[0]);
                    }
                    //filters the categories in most popular order
                    if ($_GET['orderby'] == "desc")
                    {
                        foreach ($games as $key => $row)
                        {
                            $downloads[$key] = $row['downloads'];
                        }
                    array_multisort($downloads, SORT_DESC, $games);
                    }
                    //filters the categories in least popular order
                    elseif ($_GET['orderby'] == "asc")
                    {
                        foreach ($games as $key => $row)
                        {
                            $downloads[$key] = $row['downloads'];
                        }
                    array_multisort($downloads, SORT_ASC, $games);
                    }
                }
            }
        }
        //default case, return all games
        else
        {
          $games = Game::all();
        }
        return response($games)
            ->header('Access-Control-Allow-Origin', '*');
    }
}
