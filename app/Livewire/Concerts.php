<?php

namespace App\Livewire;

use App\Repository\ConcertRepository;
use Livewire\Component;

class Concerts extends Component
{
    public $concert;

    private ConcertRepository $concertRepository;

    public function boot(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    public function render()
    {
        return view('livewire.concerts.concerts', [
            'concerts' => $this->getAll()
        ]);
    }

    public function getAll()
    {
        return $this->concertRepository->getAll();
    }

    public function show()
    {

        return $this->concertRepository->find(1);
    }
}
