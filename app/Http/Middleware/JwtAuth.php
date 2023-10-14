<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthorizationException;
use App\Models\User;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use PHPOpenSourceSaver\JWTAuth\Token;
use Symfony\Component\HttpFoundation\Response;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $jwt = FacadesJWTAuth::getFacadeRoot();
        try{
            $token = new Token(request()->cookie('accessToken'));
            $decodedToken = $jwt->decode($token);
            $userId = $decodedToken->get('sub');
            $user = User::where('id', '=', $userId)->first();
            if($decodedToken) {
                auth()->login($user, true);
            }

            return $response;
        } catch (Exception $e) {
            throw new AuthorizationException(__('errors.unauthenticated'), Response::HTTP_UNAUTHORIZED);
        }
    }
}
