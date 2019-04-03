<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;
//use \Response;

class MemberMiddleware
{
    public function handle($request, Closure $next)
    {
        /*if(!Auth::check()){
            return redirect('/login');
        }*/
        return $next($request);
    }
}
