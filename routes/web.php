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

Route::get('/', 'HomeController@index');

Auth::routes(['verify' => true]);

Route::get('/home/{page?}', 'HomeController@index')->name("home");

Route::put('/home','HomeController@addToFavorites')->name('addToFavorites');

Route::get('/favorites/{page?}', 'FavoritesController@index')->name("favorites");

Route::delete('/favorites/{id}', 'FavoritesController@delete')->name("deleteFromFavorites");

Route::put('/mail', 'FavoritesController@send')->name('sendMailWithFavorites');
