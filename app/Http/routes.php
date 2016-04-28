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
Route::get('/edit-profile', ['uses'=>'AuthorController@editProfile', 'middleware'=>'auth']);
Route::post('/edit-profile', ['uses'=>'AuthorController@postEditProfile', 'middleware'=>'auth']);
Route::get('/logout', ['uses'=>'AuthorController@logout', 'middleware'=>'auth']);

Route::get('/my-articles', ['uses'=>'ArticleController@myArticles', 'middleware'=>'auth']);
Route::get('/create-article/{code?}', ['uses'=>'ArticleController@createArticle', 'middleware'=>'auth']);
Route::post('/create-article', ['uses'=>'ArticleController@postCreateArticle', 'middleware'=>'auth']);
Route::post('/edit-article', ['uses'=>'ArticleController@postEditArticle', 'middleware'=>'auth']);

Route::get('/{code}/{title}', 'ArticleController@viewArticle');

Route::get('images/profile/{filename}', [function ($filename)
{
    $path = storage_path() . '/images/profile/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
}]);