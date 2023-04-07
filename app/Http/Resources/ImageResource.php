<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="ImageResource",
 *      description="Image Resource",
 *      type="object",
 *      @OA\Property(
 *          property="fileName",
 *          type="string",
 *          example="example_image_title.jpg",
 *      ),
 *      @OA\Property(
 *          property="url",
 *          type="string",
 *          example="https://example.com/image",
 *      ),
 *      @OA\Property(
 *          property="uuid",
 *          type="string",
 *          example="5e2eca3b-c3a4-4b5d-aaba-f00b034126be",
 *      ),
 * )
 */
class ImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'fileName' => $this->resource->file_name,
            'url' => url('/api/image/concerts/' . $this->resource->uuid),
            'uuid' => $this->resource->uuid
        ];
    }
}
