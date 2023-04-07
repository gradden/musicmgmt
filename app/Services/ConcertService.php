<?php

namespace App\Services;

use App\Exceptions\ConcertAlreadyExistsException;
use App\Models\Concert;
use App\Repository\ConcertRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function indexByUserId(int $userId, array $data)
    {
        $isExpired = null;
        if ($data['eventType'] === Concert::PAST_EVENTS)
        {
            $isExpired = true;
        } elseif ($data['eventType'] === Concert::UPCOMING_EVENTS)
        {
            $isExpired = false;
        }
        
        return $this->concertRepository->getWhereUserId($userId, $isExpired);
    }

    public function checkOutdatedConcerts(): void
    {
        $this->concertRepository
            ->getOutdatedConcerts(Carbon::now()->toDateTimeString())
            ->update([
                'is_expired' => true
            ]);
    }

    public function uploadPhotos(array $photos, int $id): void
    {
        $concert = $this->concertRepository->find($id);
        foreach ($photos as $photo)
        {
            $filename = Str::slug($concert->event_name) . '_' . 
                $concert->id . '_' . 
                Carbon::now()->format('Ymdhis') . '_' . 
                Str::random(8);
            
            $filename .= '.' . $photo->extension();

            $concert
                ->addMedia($photo->getPathname())
                ->usingFileName($filename)
                ->toMediaCollection();
        }
    }

    public function deletePhoto(string $uuid): void
    {
        $file = Media::where('uuid', '=', $uuid)->firstOrFail();
        $this->concertRepository->find($file->model_id);
        $delete = Media::where('uuid', '=', $uuid)->delete();
        if ($delete)
        {
            File::delete(storage_path('/app/' . $file->disk . '/concerts/' . $file->model_id . '/' . $file->file_name));
        }
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
