<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdminMiddleware
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
        if ($request->user() && $request->user()->type != ‘super_admin’)
        {
            return new Response(view(‘unauthorized’)->with(‘role’, ‘SUPER ADMIN’));
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
        return $next($request);
    }
}
