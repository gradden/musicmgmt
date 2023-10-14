<?php

namespace App\Livewire;

use App\Repository\ConcertRepository;
use LivewireUI\Modal\ModalComponent;

class ShowConcert extends ModalComponent
{
    public $id;

    private ConcertRepository $concertRepository;

    public function boot(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    public function render()
    {
        return view('livewire.concerts.show-concert', [
            'concert' => $this->concertRepository->find($this->id)
        ]);
    }
}
