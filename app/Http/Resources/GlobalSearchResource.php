<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="GlobalSearchResource",
 *      description="Global search",
 *      type="object",
 *      @OA\Property(
 *          property="clubs",
 *          type="object",
 *          description="Club objects",
 *          ref="#/components/schemas/ClubResource"
 *      ),
 *      @OA\Property(
 *          property="concerts",
 *          type="object",
 *          description="Concert objects",
 *          ref="#/components/schemas/ConcertResource"
 *      ),
 *      @OA\Property(
 *          property="users",
 *          type="object",
 *          description="User objects",
 *          ref="#/components/schemas/UserResource"
 *      ),
 *      @OA\Property(
 *          property="images",
 *          type="object",
 *          description="User objects",
 *          ref="#/components/schemas/ImageResource"
 *      ),
 * )
 */
class GlobalSearchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'clubs' => ClubResource::collection($this->resource['clubs']),
            'concerts' => ConcertResource::collection($this->resource['concerts']),
            'users' => UserResource::collection($this->resource['users']),
            'images' => ImageResource::collection($this->resource['images'])
        ];
    }
}
