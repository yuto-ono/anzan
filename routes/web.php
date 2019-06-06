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

Auth::routes();

Route::view('/', 'home');
Route::view('/result-test', 'result', [ 'score' => 300 ]);
Route::get('/play', 'PlayController@index')->name('play');
Route::post('/result', 'PlayController@result')->name('result');
