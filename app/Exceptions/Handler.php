<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (AuthenticationException $e,$request){
            return response()->json(['message' =>'Unauthorized'], 401);
        });
        $this->renderable(function(ValidationException $e,$request){
            return response()->json(['errors' => $e->errors()], 422);
        });
        $this->renderable(function(ModelNotFoundException $e,$request){
            return response()->json(['message' =>'Record not found'], 404);
        });
        $this->renderable(function(NotFoundHttpException $e,$request){
            return response()->json(['message' =>'Route not found'], 404);
        });
        $this->renderable(function(QueryException $e,$request){
            if($e->getCode()==23000){
                return response()->json(['message' =>'A unique constraint violation occured'], 422);
            }
            return response()->json(['message' =>'Query error'], 500);

        });


    }
}
