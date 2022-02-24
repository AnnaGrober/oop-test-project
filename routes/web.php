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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->prefix('cabinet')->namespace('\App\Http\Controllers\Cabinet')->group(function () {
    Route::get('/user', 'UserController@getUser')->name('user');
});

Route::middleware(['admin:organizer'])->prefix('admin')->namespace('\App\Http\Controllers\Admin')->group(function () {
    Route::get('/',  'OrganizerController@getUsers')->name('admin');
    Route::post('/user/block',  'OrganizerController@userBlock');
});

Route::middleware(['admin:admin'])->prefix('admin')->namespace('\App\Http\Controllers\Admin')->group(function () {
    Route::get('/',  'AdminController@getUsers')->name('admin');
    Route::get('/user/create',  'AdminController@getCreateUserForm')->name('user_create');
    Route::post('/user/create',  'AdminController@userCreate');
    Route::post('/user/delete',  'AdminController@userDelete');
});

