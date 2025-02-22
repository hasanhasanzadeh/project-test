<?php

use App\Helpers\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \RealRashid\SweetAlert\ToSweetAlert::class,
            App\Http\Middleware\LangLocale::class,
            \App\Http\Middleware\ConvertPersianNumbers::class,
        ]);
        $middleware->alias([
            'LangLocale' => App\Http\Middleware\LangLocale::class,
            'Alert' => RealRashid\SweetAlert\SweetAlertServiceProvider::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'ApiResponses' => App\Helpers\ApiResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error(message: 'Page Not Found', errors: $e->getMessage(), code: $e->getStatusCode());
            }
            return ApiResponse::success();
        });
        $exceptions->render(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error(message: 'UnAuthenticated', errors: $e->getMessage(), code: 403);
            }
            return ApiResponse::success();
        });
        $exceptions->render(function (HttpExceptionInterface $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error(message: 'Server Error', errors: $e->getMessage(), code: $e->getStatusCode());
            }
            return ApiResponse::success();
        });
    })->create();
