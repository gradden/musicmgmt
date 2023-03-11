<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'accessToken' => $this->resource['access_token'],
            'tokenType' => $this->resource['token_type'],
            'expiration' => $this->resource['expires_in']
        ];
    }
}
