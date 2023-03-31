<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="ConcertRequest",
 *      description="Full Concert object request",
 *      type="object",
 *      required={"eventName", "clubId", "createdBy", "eventStartDate", "eventEndDate"},
 *      @OA\Property(
 *          property="eventName",
 *          type="string",
 *          description="Event name",
 *          example="Nightlife Maximal",
 *      ),
 *      @OA\Property(
 *          property="clubId",
 *          type="integer",
 *          description="ID of the club",
 *          example="1",
 *      ),
 *      @OA\Property(
 *          property="createdBy",
 *          type="integer",
 *          description="ID of the event creator (User ID)",
 *          example="1",
 *      ),
 *      @OA\Property(
 *          property="eventStartDate",
 *          type="string",
 *          description="Event's starting date",
 *          example="2023-03-01 12:00:00",
 *      ),
 *      @OA\Property(
 *          property="eventEndDate",
 *          type="string",
 *          description="Event's ending date",
 *          example="2023-03-01 01:00:00",
 *      ),
 *      @OA\Property(
 *          property="description",
 *          type="string",
 *          description="A custom description",
 *          example="Example description",
 *      ),
 *      @OA\Property(
 *          property="income",
 *          type="integer",
 *          description="Income of the gig",
 *          example="90000",
 *      ),
 *      @OA\Property(
 *          property="facebookUrl",
 *          type="string",
 *          description="Facebook event URL",
 *          example="https://facebook.com/events/1234",
 *      ),
 *      @OA\Property(
 *          property="livesetUrl",
 *          type="string",
 *          description="Live Set URL",
 *          example="url",
 *      ),
 *      @OA\Property(
 *          property="isExpired",
 *          type="boolean",
 *          description="Is expired",
 *          example="false",
 *      ),
 * )
 */
class ConcertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'eventName' => 'required|string',
            'clubId' => 'required|integer|exists:clubs,id',
            'createdBy' => 'required|integer|exists:users,id',
            'description' => 'nullable|string',
            'eventStartDate' => 'required|date_format:Y-m-d H:i:s',
            'eventEndDate' => 'required|date_format:Y-m-d H:i:s|after:eventStartDate',
            'income' => 'nullable|integer',
            'facebookUrl' => 'nullable|string',
            'livesetUrl' => 'nullable|string',
            'isExpired' => 'required|boolean'
        ];
    }
}
