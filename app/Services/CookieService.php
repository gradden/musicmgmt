<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;

class CookieService
{
    public function addToken(string $accessToken, string $ttl): void
    {
        Cookie::queue('accessToken', $accessToken, $ttl, '/', env('COOKIE_DOMAIN'));
    }
}