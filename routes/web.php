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













//original class step-1
class fish {
    public function swin($time){
        if(gettype($time[0])=='integer'){

            echo 'swiming  time: '.$time[0];
        }else{
            echo 'please, insert integer parameter';
        }
    }

    public function eat(){
        echo 'eating';
    }
}

//binding fish class step-2
app()->bind('fish',function(){
    return new fish();
});

//parent facade step-3
class facade {
    public static function __callStatic($name, $arguments)
    {
        app()->make('fish')->$name($arguments);
    }

    protected static function getAccessor(){

    }
}


//create fish facade stemp-4
class fishFacade extends facade {

    protected static function getAccessor(){
        return 'fish';
    }
}

    dd( fishFacade::swin('12'));
    dd( fishFacade::swin(12));
















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


//return or show php info
Route::get('showInfo',function(){
    return phpinfo();
});







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
