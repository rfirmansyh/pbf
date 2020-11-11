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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'ArticleController@index')->name('index');
Route::get('/create', 'ArticleController@create')->name('articles.create');
Route::post('/store', 'ArticleController@store')->name('articles.store');
Route::post('/{article}/update', 'ArticleController@update')->name('articles.update');
Route::get('/{article}/edit', 'ArticleController@edit')->name('articles.edit');
Route::get('/{article}', 'ArticleController@show')->name('articles.show');
Route::get('/{article}/destroy', 'ArticleController@destroy')->name('articles.destroy');

