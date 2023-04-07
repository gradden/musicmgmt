<?php

namespace App\Repository;

use App\Models\Concert;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ConcertRepository
{
    public function getAll() 
    {
        return $this->loadAuthBuilder()->orderBy('event_start_date', 'DESC')->get();
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
        return $this->loadAuthBuilder()
            ->where($column, '=', $value)
            ->firstOrFail();
    }

    public function find(int $concertId)
    {
        return $this->loadAuthBuilder()
            ->findOrFail($concertId);
    }

    public function update(int $id, array $data)
    {
        $concert = $this->loadAuthBuilder()->where('id', '=', $id);
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
        $this->loadAuthBuilder()->where('id', '=', $id)->delete($id);
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
        return $this->loadAuthBuilder()
            ->where('event_start_date', '<=', $startDate)
            ->where('event_end_date', '>', $startDate)
            ->exists();
    }

    public function haveConcertsBefore(string $startDate, string $endDate)
    {
        return $this->loadAuthBuilder()
            ->where('event_start_date', '<', $endDate)
            ->where('event_start_date', '>', $startDate)
            ->exists();
    }

    public function getOutdatedConcerts(string $date): Builder
    {
        return Concert::where('event_end_date', '<', $date);
    }

    public function search(string $input)
    {
        return $this->loadAuthBuilder()
            ->where(function ($query) use ($input) {
                $query->where('event_name', 'LIKE', '%' . $input . '%')
                    ->orWhere('description', 'LIKE', '%' . $input . '%');
            })->get();
    }

    private function loadAuthBuilder(): Builder
    {
        return Concert::where('added_by_user_id', '=', auth()->id());
    }
}
