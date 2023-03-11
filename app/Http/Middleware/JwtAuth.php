<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
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

        $token = request()->cookie('access_token');
        $jwt = FacadesJWTAuth::getFacadeRoot();

        if(!$jwt->parseToken($token)){
            var_dump("can't..");
        }

        return $response;
    }
}
