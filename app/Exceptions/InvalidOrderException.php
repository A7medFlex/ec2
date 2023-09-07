<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;

class InvalidOrderException extends Exception implements Responsable
{
    public function toResponse($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ], 400);
    }
}
