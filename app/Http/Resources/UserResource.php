<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="UserResource",
 *      description="User Resource",
 *      type="object",
 *      @OA\Property(
 *          property="accessToken",
 *          type="string",
 *          example="jwt_token",
 *      ),
 * )
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'createdAt' => Carbon::createFromDate($this->resource->created_at)->toDateString()
        ];
    }
}
