<?php
namespace App\Http\Middleware;
use Auth;
use Closure;
class UserMiddleware{
	public function handle($repuest, Closure $next){
		return redirect()->route('user.login');
	}
}