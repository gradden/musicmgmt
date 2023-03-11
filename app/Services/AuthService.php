<?php

namespace App\Services;

use App\Exceptions\AuthorizationException;
use App\Repository\UserRepository;
use Exception;
use Illuminate\Support\Facades\Hash;

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
            throw new AuthorizationException('Wrong credentials');
        }

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
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
