<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PanelAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! auth()->check()) {
            return redirect(route('login'));
        }
        if (auth()->user()->roles->isEmpty()) {
            return redirect(route('dashboard.user'));
        }
        return $next($request);
    }
}
