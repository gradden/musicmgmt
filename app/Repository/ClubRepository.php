<?php

namespace App\Repository;

use App\Models\Club;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ClubRepository
{
    public function updateOrCreate(array $data, mixed $identifyBy): Club
    {
        return Club::updateOrCreate(
            [
                $identifyBy => $data[$identifyBy]
            ],
            [
                'name' => $data['name'],
                'location' => $data['location'],
                'facebook_url' => $data['facebookUrl'] ?? null,
                'instagram_url' => $data['instagramUrl'] ?? null,
                'instagram_tag' => $data['instagramTag'] ?? null,
                'description' => $data['description'] ?? null
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

    public function delete(int $id): void
    {
        Club::destroy($id);
    }

    public function searchBy(Builder $query, string $column, string $searchParam) : Builder
    {
        return $query->where($column, 'LIKE', '%' . $searchParam . '%', 'AND');
    }

    public function getQueryBuilder()
    {
        return Club::query();
    }

    public function search(string $input)
    {
        return Club::where('name', 'LIKE', '%' . $input . '%')
            ->orWhere('location', 'LIKE', '%' . $input . '%')
            ->orWhere('description', 'LIKE', '%' . $input . '%')
            ->get();
    }
}
