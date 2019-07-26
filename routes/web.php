<?php

/*
|--------------------------------------------------------------------------
| Web Routes - Ponishweb.ir - Pedram
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','SubtitleController@index');
Route::post('/search','SubtitleController@search')->name('search');
Route::get('/subtitles/{name}','SubtitleController@list')->name('list');
Route::get('/subtitles/{name}/{lang}/{id}','SubtitleController@download')->name('download');