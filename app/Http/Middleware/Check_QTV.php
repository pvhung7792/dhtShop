<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Http\Request;
use Closure;

class Check_QTV
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
       
        if(Auth::guard('user')->user()->role==2){
             return $next($request);
        }else{
            return back()->with('error','Bạn không đủ quyền xóa sản phẩm này');
        }
        
    }
}
