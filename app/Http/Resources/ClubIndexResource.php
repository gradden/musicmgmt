<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="ClubIndexResource",
 *      description="Collection of Clubs",
 *      type="object",
 *      @OA\Property(
 *          property="data",
 *          description="Club object collection",
 *          ref="#/components/schemas/ClubResource"
 *      )
 * )
 */
class ClubIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'data' => ClubResource::collection($this->resource)
        ];
    }
}
