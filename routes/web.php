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



Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('users', 'UserController');
    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::get('trashed', 'BookController@trashed')->name('book.trashed');
    Route::get('newBook', 'BookController@newBook')->name('book.newBook');
    Route::resource('book', 'BookController');
    Route::resource('author', 'AuthorController');

    Route::resource('dashboard', 'DashboardController');
    Route::get('dashboardExit', 'DashboardController@exit')->name('dashboard.exit');
    Route::resource('profile', 'ProfileController');
});











Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
