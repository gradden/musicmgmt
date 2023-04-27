<?php

namespace App\Services;

use App\Exceptions\AuthorizationException;
use App\Exceptions\UserExistsException;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository, CookieService $cookieService)
    {
        $this->userRepository = $userRepository;
    }

    public function auth(array $credentials): array
    {
        if (! $token = auth()->attempt($credentials)) {
            throw new AuthorizationException(
                message: __('errors.wrong_credentials'),
                code: Response::HTTP_UNAUTHORIZED
            );
        }
        
        $ttlMinute = config('auth.jwt_ttl') * 60;

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Carbon::now('Europe/Budapest')->addSeconds($ttlMinute)->toDateTimeString()
        ];
    }

    public function register(array $data): void
    {
        if($this->userRepository->isExists($data['email']))
        {
            throw new UserExistsException(
                message: __('errors.user_exists'),
                code: Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $this->userRepository->create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
