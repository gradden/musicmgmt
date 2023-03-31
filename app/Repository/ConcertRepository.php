<?php

namespace App\Repository;

use App\Models\Concert;

class ConcertRepository
{
    public function getAll() 
    {
        return Concert::all();
    }

    public function create(array $data)
    {
        return Concert::create([
            'event_name' => $data['eventName'],
            'club_id' => $data['clubId'],
            'added_by_user_id' => $data['createdBy'],
            'description' => $data['description'],
            'event_start_date' => $data['eventStartDate'],
            'event_end_date' => $data['eventEndDate'],
            'income' => $data['income'],
            'facebook_event_url' => $data['facebookUrl'],
            'liveset_url' => $data['livesetUrl'],
            'is_expired' => $data['isExpired']
        ]);
    }

    public function getBy(string $column, mixed $value)
    {
        return Concert::where($column, '=', $value)->firstOrFail();
    }

    public function update(int $id, array $data)
    {
        $concert = Concert::where('id', '=', $id);
        $concert->update([
            'event_name' => $data['eventName'],
            'club_id' => $data['clubId'],
            'added_by_user_id' => $data['createdBy'],
            'description' => $data['description'],
            'event_start_date' => $data['eventStartDate'],
            'event_end_date' => $data['eventEndDate'],
            'income' => $data['income'],
            'facebook_event_url' => $data['facebookUrl'],
            'liveset_url' => $data['livesetUrl'],
            'is_expired' => $data['isExpired']
        ]);
        return $concert->firstOrFail();
    }

    public function destroy(int $id)
    {
        Concert::destroy($id);
    }

    public function haveConcertsInDateRange(string $startDate, string $endDate): bool
    {
        return Concert::where('event_start_date', '<=', $startDate)
            ->where('event_end_date', '>', $startDate)
            ->exists();
    }

    public function haveConcertsBefore(string $startDate, string $endDate)
    {
        return Concert::where('event_start_date', '<', $endDate)
            ->where('event_start_date', '>', $startDate)
            ->exists();
    }
}
