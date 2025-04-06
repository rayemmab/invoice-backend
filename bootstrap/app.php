<?php

declare(strict_types=1);

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/',
    )
    ->withMiddleware(function (Middleware $middleware): void {})
    ->withExceptions(function (Exceptions $exceptions): void {
        // Integration::handles($exceptions);

        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {

                $status = match (true) {
                    $e instanceof NotFoundHttpException => 404,
                    $e instanceof ModelNotFoundException => 404,
                    $e instanceof AuthenticationException => 401,
                    $e instanceof AccessDeniedHttpException => 403,
                    $e instanceof MethodNotAllowedHttpException => 402,
                    $e instanceof UnauthorizedException => 403,
                    $e instanceof MethodNotAllowedException => 405,
                    $e instanceof ValidationException => 422,
                    default => 500,
                };

                $message = match (true) {
                    $e instanceof NotFoundHttpException => "Cette ressource n'existe pas",
                    $e instanceof ModelNotFoundException => "Cette ressource n'existe pas",
                    $e instanceof AuthenticationException => 'Votre session a expiré. Veuillez vous reconnecter.',
                    $e instanceof AccessDeniedHttpException => 'Cette action n\'est pas autorisée',
                    $e instanceof MethodNotAllowedHttpException => 'Cette route n\'est pas supporté par cette méthode HTTP',
                    $e instanceof UnauthorizedException => "Vous n'êtes pas habilité à accéder à cette ressource (" . $e->getMessage() . ')',
                    $e instanceof MethodNotAllowedException => "Cette méthode HTTP n'est pas supportée pour cette route",
                    $e instanceof ValidationException => 'Les données envoyées ne sont pas valides',
                    default => "Une erreur inattendue s'est produite",
                };

                if ($e instanceof ValidationException) {
                    $errors = $e->validator->getMessageBag()->toArray();

                    $display_errors = [];

                    foreach ($errors as $value) {
                        $display_errors[] = $value[0];
                    }

                    return response()->json([
                        'status' => false,
                        'message' => $message,
                        'errors' => $display_errors,
                    ], $status);
                }

                $response = [
                    'status' => false,
                    'message' => $message,
                    'error' => $e->getMessage(),
                ];

                if (config('app.debug')) {
                    $response['debug'] = [
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => $e->getTraceAsString(),
                    ];
                }

                return response()->json($response, $status);
            }
        });
    })->create();