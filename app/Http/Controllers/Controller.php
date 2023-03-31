<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Info(
 *   title="Musicmgmt API", 
 *   version="1.0",
 * ),
 * @OA\Server(
 *   url="/api",
 *   description="API Server"
 * ),
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *   scheme="bearer"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function ok(): JsonResponse
    {
        return response()->json(['success' => 'ok'], Response::HTTP_OK);
    }

    public function json(mixed $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    public function noContent(): JsonResponse
    {
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
