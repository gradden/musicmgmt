<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="RegisterRequest",
 *      description="Registration credentials",
 *      type="object",
 *      required={"name", "email", "password"},
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          description="Full name",
 *          example="Foo Bar",
 *      ),
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
class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:40',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
    }
}
