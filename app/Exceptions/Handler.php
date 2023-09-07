<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function register(): void
    {
        $this->reportable(function (InvalidOrderException $e) {
            Log::error('Invalid order', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
        });
    }
}
