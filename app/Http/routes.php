<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'ArticleController@index');

Route::get('/sign-up', 'AuthorController@signUp');
Route::post('/sign-up', 'AuthorController@postSignUp');
Route::get('/login/{error?}', 'AuthorController@login');
Route::post('/login', 'AuthorController@postLogin');
Route::get('/edit-profile', 'AuthorController@editProfile');
Route::post('/edit-profile', 'AuthorController@postEditProfile');
Route::get('/logout', 'AuthorController@logout');


Route::get('images/profile/{filename}', function ($filename)
{
    $path = storage_path() . '/images/profile/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});