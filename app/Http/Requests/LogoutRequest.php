<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="LogoutRequest",
 *      description="Logout request",
 *      type="object",
 *      required={"accessToken"},
 *      @OA\Property(
 *          property="accessToken",
 *          type="string",
 *          description="Token",
 *          example="token",
 *      )
 * )
 */
class LogoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'accessToken' => 'required|string'
        ];
    }
}
