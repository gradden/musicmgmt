<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
