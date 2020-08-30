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

Route::get('/', 'ArticleController@load');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users/{id}', 'ArticleController@loadForSpecificUser');
Route::get('/article/create', 'ArticleController@create');
Route::post('/article/store', 'ArticleController@store');
Route::get('/article/{id}/edit', 'ArticleController@edit');
Route::get('article/{id}', 'ArticleController@getArticleById');
Route::post('/article/{id}/update', 'ArticleController@update');
Route::get('/best-authors', 'ArticleController@showBestAuthors');