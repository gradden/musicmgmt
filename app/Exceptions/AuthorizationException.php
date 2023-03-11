<?php

namespace App\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    public function render()
    {
        return response()->json(
            ['message' => $this->getMessage()]
        );
    }
}
