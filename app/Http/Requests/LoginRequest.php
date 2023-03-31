<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="LoginRequest",
 *      description="Login credentials",
 *      type="object",
 *      required={"email", "password"},
 *      @OA\Property(
 *          property="email",
 *          type="string",
 *          description="Email",
 *          example="example@asd.com",
 *      ),
 *      @OA\Property(
 *          property="password",
 *          type="string",
 *          description="Password",
 *          example="Teszt1234",
 *      ),
 * )
 */
class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string'
        ];
    }
}
