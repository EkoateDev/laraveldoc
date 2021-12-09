<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = Auth::user()->roles->pluck('name');

        if (!Auth::check()) {
            return redirect('login');
        }

        if ($roles[0] == 'Admin') {
            return $next($request);
        }
    }
}
