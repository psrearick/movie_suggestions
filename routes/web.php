<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profiles/change-profile', 'ProfileController@index');
    Route::get('profiles/create', 'ProfileController@create');
    Route::get('/profiles/{profile}', 'ProfileController@show');
    Route::post('/profiles', 'ProfileController@store');

    Route::post('/profiles/{profile}/movies', 'MovieProfilesController@store');

    Route::get('/home', 'HomeController@index')->name('home');
});


Route::get('/movies', 'MoviesController@index');
Route::get('/movies/{movie}', 'MoviesController@show');
Route::post('/movies', 'MoviesController@store');

Auth::routes();
