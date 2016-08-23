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
Route::resource('posts', 'PostsController');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// tie a redirect to a controller function so when the URL is updated it will be updated in the Router as well
// return redirect()->action('HomeController@rollDice', 2);


// function (Request $request) to pass a Request class type object into a file that doesn't use the 'use' clause at the top.
    // return view('my-first-view', $data);
    // return view('my-first-view')->with($data);
    // return view('my-first-view')->with('firstName', $foo);

// This is what Laravel uses for the view function
// function view($relativePath) {
// 	require '/resources/views/' . $relativePath;
// }
