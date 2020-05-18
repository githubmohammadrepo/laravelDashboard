<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAuthUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(in_array('admin', Auth::user()->roles()->pluck('name')->toArray()) == false){
            session()->flush();
            session()->flash('authError','your are not admin');
            return redirect(route('login'));
        }
        return $next($request);
    }
}
