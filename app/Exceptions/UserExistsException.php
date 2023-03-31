<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use App\Exceptions\ExceptionTrait;

class UserExistsException extends Exception
{
    use ExceptionTrait;

    public function __construct(string $message, int $code, Throwable $e = null)
    {
        parent::__construct($message, $code, $e);
    }

    public function render()
    {
        return $this->custom($this->message, $this->code, $this);
    }
}
