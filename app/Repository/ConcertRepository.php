<?php

namespace App\Repository;

use App\Models\Concert;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ConcertRepository
{
    public function getAll() 
    {
        return $this->loadAuthBuilder()->orderBy('event_start_date', 'DESC')->get();
    }

    public function paginate(int $perPage = 10)
    {
        return $this->loadAuthBuilder()->orderBy('event_start_date', 'DESC')->paginate($perPage);
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

    public function search(string $input, bool $enablePagination = false, int $perPage = 10)
    {
        $builder = $this->loadAuthBuilder()
            ->leftJoin('clubs', 'clubs.id', '=', 'concerts.club_id')
            ->where(function ($query) use ($input) {
                $query->where('concerts.event_name', 'LIKE', '%' . $input . '%')
                    ->orWhere('clubs.name', 'LIKE', '%' . $input . '%')
                    ->orWhere('concerts.description', 'LIKE', '%' . $input . '%');
            });

        return $enablePagination ? $builder->paginate($perPage) : $builder->get();
    }

    private function loadAuthBuilder(): Builder
    {
        return Concert::query()
            ->where('concerts.added_by_user_id', '=', auth()->id())
            ->orderByDesc('concerts.event_start_date');
    }

    public function getForLivewire(string $search, int $perPage, string|null $from, string|null $to): LengthAwarePaginator
    {
        $builder = $this->loadAuthBuilder()
            ->select(
                'clubs.description as clubDescription',
                'concerts.description as concertDescription',
                'clubs.id as clubId',
                'concerts.id as concertId',
                'concerts.*',
                'clubs.*'
            )
            ->leftJoin('clubs', 'clubs.id', '=', 'concerts.club_id')
            ->where(function ($query) use ($search) {
                $query->where('concerts.event_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('concerts.description', 'LIKE', '%' . $search . '%')
                    ->orWhere('clubs.name', 'LIKE', '%' . $search . '%');
            });

        return (empty($from) || empty($to)) ?
            $builder->paginate($perPage) :
            $builder
                ->where('concerts.event_start_date', '>=', $from)
                ->where('concerts.event_end_date', '<=', $to)
                ->orderBy('concerts.event_start_date')
                ->paginate($perPage);

    }
}
