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


Route::get('addSession',function(){
    session()->put('add','session added');
    return redirect(route('keep'));
})->name('add');

Route::get('keepSession',function(){
    return session()->get('add');
})->name('keep');


Route::get('use',function(){
    return session()->get('add');
})->name('use');


Route::get('remove',function(){
    return session()->flush();


})->name('remove');


Route::get('finish',function(){
    return session()->get('add');
})->name('finish');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
