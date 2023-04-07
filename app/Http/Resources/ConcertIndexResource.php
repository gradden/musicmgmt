<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="ConcertIndexResource",
 *      description="Collection of Concerts",
 *      type="object",
 *      @OA\Property(
 *          property="data",
 *          description="Concert object collection",
 *          type="object",
 *          ref="#/components/schemas/ConcertResource"
 *      )
 * )
 */
class ConcertIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'data' => ConcertResource::collection($this->resource)
        ];
    }
}
