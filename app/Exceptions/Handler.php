<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $exception->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json([
                    'error' => 'Unauthenticated',
                ], Response::HTTP_UNAUTHORIZED);
            }
        }

        return parent::render($request, $exception);
    }
}
