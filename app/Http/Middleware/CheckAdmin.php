<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Http\Request;
use Closure;

class CheckAdmin
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
       
        if(Auth::guard('user')->user()->role==2 || Auth::guard('user')->user()->role==1){
             return $next($request);
        }else{
            return redirect('/');
        }
        
    }
}
