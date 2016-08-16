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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sayhello/{name}', function($name) {
    return "Hello, $name!";
});

Route::get('/uppercase/{word}', function($word) {
	return strtoupper($word);
});

Route::get('/increment/{number}', function($number) {
	return $number + 1;
});

Route::get('/add/{num1}/{num2}', function($num1, $num2) {
	return $num1 + $num2;
});
