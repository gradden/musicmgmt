<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="ClubRequest",
 *      description="Full Club object request",
 *      type="object",
 *      required={"name", "location"},
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
class ClubRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'location' => 'required|string',
            'facebookUrl' => 'nullable|string',
            'instagramTag' => 'nullable|string',
            'instagramUrl' => 'nullable|string',
            'description' => 'nullable|string'
        ];
    }
}
