<?php

namespace App\Repository;

use App\Models\Concert;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ConcertRepository
{
    public function getAll() 
    {
        return Concert::where('added_by_user_id', '=', auth()->id())->get();
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
        return Concert::where('added_by_user_id', '=', auth()->id())
            ->where($column, '=', $value)
            ->firstOrFail();
    }

    public function update(int $id, array $data)
    {
        $concert = Concert::where('added_by_user_id', '=', auth()->id())->where('id', '=', $id);
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

    public function getWhereUserId(int $userId, bool $isExpired = null)
    {
        $concerts = Concert::where('added_by_user_id', '=', $userId);
        if ($isExpired !== null) 
        {
            $concerts->where('is_expired', '=', $isExpired);
        }

        return $concerts->get();
    }

    public function haveConcertsInDateRange(string $startDate, string $endDate): bool
    {
        return Concert::where('added_by_user_id', '=', auth()->id())
            ->where('event_start_date', '<=', $startDate)
            ->where('event_end_date', '>', $startDate)
            ->exists();
    }

    public function haveConcertsBefore(string $startDate, string $endDate)
    {
        return Concert::where('added_by_user_id', '=', auth()->id())
            ->where('event_start_date', '<', $endDate)
            ->where('event_start_date', '>', $startDate)
            ->exists();
    }

    public function getOutdatedConcerts(string $date): Builder
    {
        return Concert::where('event_end_date', '<', $date);
    }
}
