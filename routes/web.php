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
    redirect(route('keep'));
    return redirect(route('home'));

})->name('add');

Route::get('keepSession',function(){
    session()->get('add');
    return redirect(route('home'));

})->name('keep');


Route::get('use',function(){
    session()->get('add');
    return redirect(route('home'));
})->name('use');


Route::get('remove',function(){
    session()->forget('add');
    return redirect(route('home'));


})->name('remove');

Route::get('removeAll',function(){
    session()->flush();
    return redirect(route('home'));


})->name('removeAll');

Route::get('finish',function(){
    session()->get('add');
    return redirect(route('home'));

})->name('finish');

Route::get('all',function(){
    return $allSession =session()->all();
    return view('home',compact('allSession'));

})->name('all');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
