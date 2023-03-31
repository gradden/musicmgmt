<?php

namespace App\Services;

use Cookie;
use Illuminate\Support\Facades\Response;

class CookieService 
{
    public function addToken(string $accessToken) {
        return cookie('accessToken', $accessToken);
    }
}