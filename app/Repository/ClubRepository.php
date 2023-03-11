<?php

namespace App\Repository;

use App\Models\Club;
use Illuminate\Database\Eloquent\Collection;

class ClubRepository
{
    public function updateOrCreate(array $data): Club
    {
        return Club::updateOrCreate(
            [
                'name' => $data['name']
            ],
            [
                'location' => $data['location'],
                'facebook_url' => $data['facebookUrl'],
                'instagram_url' => $data['instagramUrl'],
                'instagram_tag' => $data['instagramTag'],
                'description' => $data['description']
            ]
        );
    }

    public function index(): Collection
    {
        return Club::all();
    }

    public function getBy(string $column, mixed $value): Club
    {
        return Club::where($column, '=', $value)->firstOrFail();
    }
}
