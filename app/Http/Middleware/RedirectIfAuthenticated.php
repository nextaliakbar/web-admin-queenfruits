<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        switch($guard) {
            case 'admin':
                if(Auth::guard($guard)->check()) {
                    return redirect()->route('admin.category.index');
                }
            break;

            default:
                if(Auth::guard($guard)->check()) {
                    return response()->json([], 404);
                }
                
        }
        return $next($request);
    }
}
