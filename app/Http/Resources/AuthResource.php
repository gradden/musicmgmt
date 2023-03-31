<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="AuthResource",
 *      description="Token resource",
 *      type="object",
 *      @OA\Property(
 *          property="accessToken",
 *          type="string",
 *          example="jwt_token",
 *      ),
 *      @OA\Property(
 *          property="tokenType",
 *          type="string",
 *          example="Bearer",
 *      ),
 *      @OA\Property(
 *          property="expiration",
 *          type="integer",
 *          example="36000",
 *      ),
 * )
 */
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
