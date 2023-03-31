<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="ClubResource",
 *      description="Full resource of Club object",
 *      type="object",
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="ID of club",
 *          example="1",
 *      ),
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          description="Club name",
 *          example="Liget Budapest",
 *      ),
 *      @OA\Property(
 *          property="location",
 *          type="string",
 *          description="The location of the club",
 *          example="Budapest (Example street)",
 *      ),
 *      @OA\Property(
 *          property="facebookUrl",
 *          type="string",
 *          description="Facebook page of the club",
 *          example="https://facebook.com/club",
 *      ),
 *      @OA\Property(
 *          property="instagramTag",
 *          type="string",
 *          description="Instagram tag",
 *          example="@clubbudapest",
 *      ),
 *      @OA\Property(
 *          property="instagramUrl",
 *          type="string",
 *          description="Instagram url",
 *          example="https://instagram.com/clubbudapest",
 *      ),
 *      @OA\Property(
 *          property="description",
 *          type="string",
 *          description="A custom description",
 *          example="This place is very solid. Might be coming back here idk..",
 *      ),
 * )
 */
class ClubResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'location' => $this->resource->location,
            'facebookUrl' => $this->resource->facebook_url,
            'instagramUrl' => $this->resource->instagram_url,
            'instagramTag' => $this->resource->instagram_tag,
            'description' => $this->resource->description
        ];
    }
}
