<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *   tags={"User"},
     *   path="/users/me",
     *   summary="Get current user",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/UserResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function getMe()
    {
        return $this->json(UserResource::make(auth()->user()));
    }
}
