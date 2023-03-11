<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getMe()
    {
        return $this->ok();
    }

    public function login(LoginRequest $credentials)
    {
        $data = $credentials->only(['email', 'password']);

        return $this->json(AuthResource::make($this->authService->auth($data)));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $this->authService->register($data);

        return $this->ok();
    }
}
