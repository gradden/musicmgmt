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
 *          property="id",
 *          type="integer",
 *          example="1",
 *      ),
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          example="Foo Bar",
 *      ),
 *      @OA\Property(
 *          property="email",
 *          type="string",
 *          example="example@asd.com",
 *      ),
 *      @OA\Property(
 *          property="createdAt",
 *          type="string",
 *          example="2023-01-01",
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
            'createdAt' => Carbon::createFromDate($this->resource->created_at)->toDateString(),
            'upcomingConcerts' => $this->resource->concertCount(),
            'pastConcerts' => $this->resource->concertExpiredCount()
        ];
    }
}
