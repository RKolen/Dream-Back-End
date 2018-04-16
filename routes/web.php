<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () 
{
    return view('welcome');
});

//authentications//
Route::get('/test', 'AuthenticationController@test');

Route::post('/login', 'AuthenticationController@login');

Route::get('/checklogin', 'AuthenticationController@checklogin');

Route::get('/logout', 'AuthenticationController@logout');

Route::post('/store', 'AuthenticationController@store');

//home//

Route::get('/home', 'HomeController@index')->name('home');


//GameController//

Route::get('/games', 'GameController@index');

Route::get('/games/{game}', 'GameController@show');

Route::get('/games/{game}/image', 'GameController@image');

Route::get('/games/{game}/edit', 'GameController@edit');

Route::post('/games/{game}/update', 'GameController@update');

//downloads//

Route::get('/games/{game}/download', 'GameController@download');

Route::get('downloads/app', function()
{
  return response()->download("/var/www/html/Dream-Back-End/storage/app/private/app/Dream Desktop Client.exe");
});

//uploads//

Route::post('upload', 'GameController@upload');

//search options//

Route::get('/search', 'GameController@search');


//CategoryController//


//ProfileController//
// Route::get('/profile/{profileId}/follow', 'ProfileController@followUser');

// Route::get('/profile/{profileId}/unfollow', 'ProfileController@unFollowUser');

 Route::get('/profile/{profileId}', 'ProfileController@read');


//FeedbackController//

//Route::post('/games/{game}/feedback', 'FeedbackController@store');
