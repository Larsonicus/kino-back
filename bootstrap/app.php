<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use App\Http\Middleware\Authenticate;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Exceptions\UnauthorizedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => Authenticate::class,
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return true;
        });

        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            return response()->json(['message' => 'Not Found!'], 404);
        });

        $exceptions->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Method not allowed',
                'allowedMethods' => $e->getHeaders()['Allow'] ?? 'Unknown'
            ], 405);
        });

        $exceptions->renderable(function (UnauthorizedException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        });
    })->create();




