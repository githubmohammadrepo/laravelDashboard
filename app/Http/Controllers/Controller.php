<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //general method for all controller
    public function redirect_session($status,$title,$type){
        if($status==true){
            session('success','your '.$title.' successfully '.$type.'');
        }else{
            session('error','your '.$title.' does not '.$type.'');

        }
    }
}
