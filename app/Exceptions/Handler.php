<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e) {
            if($e instanceof NotFoundHttpException)
            {
                throw new NotFoundException(
                    __('errors.not_found'),
                    Response::HTTP_NOT_FOUND,
                    $e
                );
            }

            if($e instanceof AuthenticationException) 
            {
                throw new AuthorizationException(
                    message: __('errors.unauthenticated'),
                    code: Response::HTTP_UNAUTHORIZED
                );
            }
        });
    }
}
