<?php

namespace App\Services;

use App\Exceptions\AuthorizationException;
use App\Repository\UserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function auth(array $credentials): array
    {
        if (! $token = auth()->attempt($credentials)) {
            throw new AuthorizationException(
                message: __('errors.wrong_credentials'),
                code: Response::HTTP_FORBIDDEN
            );
        }

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('auth.jwt_ttl') * 60
        ];
    }

    public function register(array $data): void
    {
        if($this->userRepository->isExists($data['email']))
        {
            throw new Exception('User is exists');
        }

        $this->userRepository->create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
