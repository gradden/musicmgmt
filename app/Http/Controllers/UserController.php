<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

    public function getProfilePicture()
    {
        return $this->userService->getProfilePicture();
    }
}
