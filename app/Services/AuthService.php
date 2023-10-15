<?php

namespace App\Services;

use App\Exceptions\AuthorizationException;
use App\Exceptions\EmailVerificationException;
use App\Exceptions\UserExistsException;
use App\Models\User;
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

    /**
     * @throws AuthorizationException
     * @throws EmailVerificationException
     */
    public function auth(array $credentials): array
    {
        $user = User::query()->where(['email' => $credentials['email']])->first();

        if (empty($user) || !auth()->validate($credentials)) {
            throw new AuthorizationException(
                message: __('errors.wrong_credentials'),
                code: Response::HTTP_UNAUTHORIZED
            );
        }

        if (empty($user->email_verified_at)) {
            throw new EmailVerificationException(
                message: __('errors.must_verify_email'),
                code: Response::HTTP_UNAUTHORIZED
            );
        }

        if (!$token = auth()->attempt($credentials)) {
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
        if ($this->userRepository->isExists($data['email'])) {
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
