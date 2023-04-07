<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConcertDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $photo = [];
        foreach ($this->resource->getMedia() as $media) 
        {
            $photo[$media->id] = [
                'url' => url('/api/image/concerts/' . $media->uuid),
                'uuid' => $media->uuid,
                'fileName' => $media->file_name
            ];
        } 

        return [
            'id' => $this->resource->id,
            'eventName' => $this->resource->event_name,
            'club' => $this->resource->club,
            'createdBy' => $this->resource->author,
            'description' => $this->resource->description,
            'eventStartDate' => $this->resource->event_start_date,
            'eventEndDate' => $this->resource->event_end_date,
            'income' => $this->resource->income,
            'facebookEvent' => $this->resource->facebook_event_url,
            'liveSet' => $this->resource->liveset_url,
            'isExpired' => $this->resource->is_expired,
            'photos' => $photo
        ];
    }
}
