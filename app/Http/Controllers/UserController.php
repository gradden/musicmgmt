<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\Services\CookieService;

class UserController extends Controller
{
    private AuthService $authService;
    private CookieService $cookieService;

    public function __construct(AuthService $authService, CookieService $cookieService)
    {
        $this->authService = $authService;
        $this->cookieService = $cookieService;

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
        return UserResource::make(auth()->user());
    }

    /**
     * @OA\Post(
     *   tags={"Auth"},
     *   path="/auth/login",
     *   summary="Login",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/AuthResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function login(LoginRequest $credentials)
    {
        $data = $credentials->only(['email', 'password']);
        $response = $this->authService->auth($data);

        return $this->json(AuthResource::make($response))
            ->withCookie($this->cookieService->addToken($response['access_token']));
    }

    /**
     * @OA\Post(
     *   tags={"Auth"},
     *   path="/auth/register",
     *   summary="Registration",
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=422, description="Unprocessable entity"),
     * )
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $this->authService->register($data);

        return $this->ok();
    }
}
