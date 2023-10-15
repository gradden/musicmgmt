<?php

namespace App\Livewire;

use App\Repository\ConcertRepository;
use Livewire\Component;
use Livewire\WithPagination;

class Concerts extends Component
{
    use WithPagination;

    public $concert;
    public $perPage;

    #[Url(as: 's')]
    public $search = '';

    public $from;
    public $to;

    protected $queryString = ['s'];

    private ConcertRepository $concertRepository;

    public function boot(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    public function paginationView()
    {
        return 'components.paginator';
    }

    public function render()
    {
        return view('livewire.concerts.concerts', [
            'concerts' => $this->getAll(
                $this->perPage ?? 10,
                $this->search,
                $this->from ?? null,
                $this->to ?? null
            )
        ]);
    }

    public function getAll(int $paginate, string $searchText, string|null $from, string|null $to)
    {
        return $this->concertRepository->getForLivewire($searchText, $paginate, $from, $to);
    }

    public function show()
    {
        return $this->concertRepository->find(1);
    }
}
