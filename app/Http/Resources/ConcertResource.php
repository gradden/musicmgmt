<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="ConcertResource",
 *      description="Full resource of Club object",
 *      type="object",
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *          description="ID of concert",
 *          example="1",
 *      ),
 *      @OA\Property(
 *          property="eventName",
 *          type="string",
 *          description="Name of the event",
 *          example="Nightlife Maximal",
 *      ),
 *      @OA\Property(
 *          property="club",
 *          type="object",
 *          description="Club object of the concert",
 *          ref="#/components/schemas/ClubResource"
 *      ),
 *      @OA\Property(
 *          property="description",
 *          type="string",
 *          description="Custom description about the event",
 *          example="This will be good.",
 *      ),
 *      @OA\Property(
 *          property="eventStartDate",
 *          type="string",
 *          description="When will the event starting",
 *          example="2023-03-01 12:00:00",
 *      ),
 *      @OA\Property(
 *          property="eventEndDate",
 *          type="string",
 *          description="When will the event ending",
 *          example="2023-03-01 01:00:00",
 *      ),
 *      @OA\Property(
 *          property="facebookEvent",
 *          type="string",
 *          description="URL of Facebook event",
 *          example="url",
 *      ),
 *      @OA\Property(
 *          property="liveSet",
 *          type="string",
 *          description="URL of the Live Set mix",
 *          example="url",
 *      ),
 *      @OA\Property(
 *          property="isExpired",
 *          type="boolean",
 *          description="Is this event happened?",
 *          example="false",
 *      ),
 * )
 */
class ConcertResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'eventName' => $this->resource->event_name,
            'club' => $this->resource->club,
            'description' => $this->resource->description,
            'eventStartDate' => $this->resource->event_start_date,
            'eventEndDate' => $this->resource->event_end_date,
            'facebookEvent' => $this->resource->facebook_event_url,
            'liveSet' => $this->resource->liveset_url,
            'isExpired' => $this->resource->is_expired
        ];
    }
}
