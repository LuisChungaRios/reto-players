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


Route::resource('players','PlayerController');
Route::put('players/{player}/goals/{operation}','PlayerController@changeGoalsValue')->name('players.goals.change_value');
Route::get('/', function () {
    return view('welcome');
});
