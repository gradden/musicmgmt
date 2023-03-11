<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
