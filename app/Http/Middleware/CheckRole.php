<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if(! request()->user()->roles->whereIn('name',$role)->first())
        {
            return redirect()->route('home')->with('status','Admin access restriction for the user');
        }
        return $next($request);
    }
}
