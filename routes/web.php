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
    Route::post('/profiles/change-profile', 'ProfileController@change');
    Route::get('profiles/create', 'ProfileController@create');
    Route::get('/profiles', 'ProfileController@show');
    Route::post('/profiles', 'ProfileController@store');

    Route::post('/profiles/{profile}/movies', 'MovieProfilesController@store');
    Route::post('/movies/{movie}/profiles/{profile}', 'MovieProfilesController@store');
    Route::patch('/movies/{movie}/profiles/{profile}', 'MovieProfilesController@update');

    Route::get('/home', 'HomeController@index')->name('home');
});


Route::get('/movies', 'MoviesController@index');
Route::get('/movies/{movie}', 'MoviesController@show');
Route::post('/movies', 'MoviesController@store');

Auth::routes();
