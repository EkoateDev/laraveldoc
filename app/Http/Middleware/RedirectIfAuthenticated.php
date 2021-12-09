<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $roles = Auth::user()->roles->pluck('name');

            switch ($roles[0]) {
                case 'Admin':
                    return redirect()->route('admindashboard');
                    break;
                case 'Regular':
                    return redirect()->route('regulardashboard');
                    break;

                default:
                    return redirect()->route('login');
                    break;
            }
        }
        return $next($request);
    }
}
