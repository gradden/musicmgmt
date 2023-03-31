<?php

namespace App\Services;

use App\Exceptions\ConcertAlreadyExistsException;
use App\Repository\ConcertRepository;
use Symfony\Component\HttpFoundation\Response;

class ConcertService
{
    private ConcertRepository $concertRepository;

    public function __construct(ConcertRepository $concertRepository)
    {
        $this->concertRepository = $concertRepository;
    }

    public function getAll()
    {
        return $this->concertRepository->getAll();
    }

    public function create(array $data)
    {
        $this->checkDate($data['eventStartDate'], $data['eventEndDate']);
        return $this->concertRepository->create($data);
    }

    public function show(int $id)
    {
        return $this->concertRepository->getBy('id', $id);
    }

    public function update(int $id, array $data)
    {
        $this->checkDate($data['eventStartDate'], $data['eventEndDate']);
        return $this->concertRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        $this->concertRepository->destroy($id);
    }

    private function checkDate(string $startDate, string $endDate)
    {
        if ($this->concertRepository->haveConcertsInDateRange($startDate, $endDate) ||
            $this->concertRepository->haveConcertsBefore($startDate, $endDate))
        {
            throw new ConcertAlreadyExistsException(
                message: __('errors.concert_already_exists_date'),
                code: Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
