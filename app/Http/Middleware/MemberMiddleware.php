<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;
//use \Response;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /*public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->type != ‘member’)
        {
            return new Response(view(‘unauthorized’)->with(‘role’, ‘MEMBER’));
        }
        return $next($request);
    }*/
    /*public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('/');
        }

        if(!Auth::user()->access){
            return redirect('dashboard');
        }
        $user = Auth::user();
        return $next($request)->with('user', $user);
    }*/
    /*public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/login');
        }
        return $next($request);
    }*/
    
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        return $next($request);
    }
}
