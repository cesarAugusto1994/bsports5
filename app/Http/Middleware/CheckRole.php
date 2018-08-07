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
    public function handle($request, Closure $next)
    {

/*
        if($request->user()->isAdmin()) {
            return redirect()->route('admin_dashboard');
        }

        dd($request->user());
*/
        return $next($request);
    }
}
