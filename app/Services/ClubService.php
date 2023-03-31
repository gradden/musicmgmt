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
        return $this->clubRepository->updateOrCreate($inputData, 'name');
    }

    public function getAll()
    {
        return $this->clubRepository->index();
    }

    public function showBy(string $column, mixed $value)
    {
        return $this->clubRepository->getBy($column, $value);
    }

    public function edit(int $id, array $updateData) 
    {
        $updateData['id'] = $id;
        return $this->clubRepository->updateOrCreate($updateData, 'id');
    }

    public function delete(int $id)
    {
        $this->clubRepository->delete($id);
    }
}
