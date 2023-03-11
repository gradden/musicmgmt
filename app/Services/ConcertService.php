<?php

namespace App\Services;

use App\Repository\ConcertRepository;

class ConcertService
{
    private ConcertRepository $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    public function getAll()
    {

    }
}
