<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;
use Throwable;

trait ExceptionTrait {
    public function custom(string $message, int $statusCode, Throwable $prev = null)
    {
        $response = [
            'errorMsg' => $message,
            'responseCode' => $statusCode
        ];

        if (config('app.debug')) {
            $response['trace'] = $prev->getTrace();
        }

        $this->logException($message, $prev->getTraceAsString());

        return $response;
    }

    private function logException(string $exceptionMessage, string $trace)
    {
        Log::info($exceptionMessage, [
            'trace' => $trace
        ]);
    }
}