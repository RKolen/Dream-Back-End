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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//GameController//

Route::get('/games', 'GameController@index');

Route::get('/games/{game}', 'GameController@show');

Route::get('/games/{game}/image', 'GameController@image');




//downloads//

Route::get('/games/{game}/download', 'GameController@download');




