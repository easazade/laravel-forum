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

use App\Http\Controllers\ThreadsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/threads/{channel_slug}/{id}','ThreadsController@show')->name('threads.show');

//Route::resource('threads', 'ThreadsController');


Route::get('/threads', 'ThreadsController@index')->name('threads.index');
Route::get('/threads/create', 'ThreadsController@create')->name('threads.create');
Route::get('/threads/{channel_slug}/{id}', 'ThreadsController@show')->name('threads.show');
Route::post('/threads', 'ThreadsController@store')->name('threads.store');
Route::get('/threads/{channel_slug}','ThreadsController@index')->name('threads.index.filter');

Route::post('/threads/{channel_slug}/{id}/replies', 'RepliesController@store')->name('replies.add');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

