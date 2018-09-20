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

Route::get('/films', "FilmController@getFilm");

Route::get('/films/create', function () {
    return view('createfilm');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
	return view('login');
});

Route::get('/logout', function () {
	return view('logout');
});

Route::get('/register', function() {
	return view('register');
});

Route::post('/logoutme', "UserController@logoutUser"); 

Route::post('/loginme', "UserController@loginUser");

Route::post('/registerUser', "UserController@registerUser");

Route::post('/createFilm', "FilmController@createFilm");

Route::post('/postComment', "CommentController@postComment");
