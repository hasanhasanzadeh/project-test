<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->is('api/*')) {
            if (!($response instanceof JsonResponse)) {
                return $response;
            }

            return response()->json([
                'success' => $response->status() < 400,
                'message' => Response::$statusTexts[$response->status()] ?? 'Response',
                'data' => $response->getData(),
            ], $response->status());
        }

        return $next($request);

    }
}
