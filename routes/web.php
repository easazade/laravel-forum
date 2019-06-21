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

Route::resource('threads', 'ThreadsController');

//Route::get('/threads', 'ThreadsController@index')->name('threads.index');
//Route::post('/threads', 'ThreadsController@store')->name('threads.store');
//Route::get('/threads/{id}','ThreadsController@show')->name('threads.show');
//Route::get('/threads/create')->name('threads.create');

Route::post('/threads/{id}/replies', 'RepliesController@store')->name('replies.add');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

