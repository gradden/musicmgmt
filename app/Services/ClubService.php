<?php

namespace App\Services;

use App\Repository\ClubRepository;

class ClubService
{
    private ClubRepository $clubRepository;

    public function __construct(ClubRepository $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    public function createClub(array $inputData)
    {
        return $this->clubRepository->updateOrCreate($inputData);
    }

    public function getAll()
    {
        return $this->clubRepository->index();
    }

    public function showBy(string $column, mixed $value)
    {
        return $this->clubRepository->getBy($column, $value);
    }
}
