<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function ok(): JsonResponse
    {
        return response()->json(['success' => 'ok'], 200);
    }

    public function json(mixed $data, int $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}
