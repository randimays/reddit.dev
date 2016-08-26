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

Route::get('/', 'PostsController@index');
Route::get('/posts/newest', 'PostsController@newest');
Route::resource('posts', 'PostsController');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('users/{user}', 'UsersController@show');
Route::get('users/{user}/edit', 'UsersController@edit');
Route::put('users/{user}', 'UsersController@update');
Route::delete('users/{user}', 'UsersController@destroy');
Route::get('/voted_post/{post}/{vote}', 'PostsController@addVote');