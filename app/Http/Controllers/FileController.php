<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConcertPhotoRequest;
use App\Services\ConcertService;
use App\Services\FileService;

class FileController extends Controller
{
    private FileService $fileService;
    private ConcertService $concertService;

    public function __construct(FileService $fileService, ConcertService $concertService)
    {
        $this->fileService = $fileService;
        $this->concertService = $concertService;
    }

    public function get(string $classType, string $uuid)
    {
        return $this->fileService->getImage($classType, $uuid);
    }

    public function uploadPhotos(ConcertPhotoRequest $request, int $id)
    {
        $photos = $request->file('photos');
        
        $this->concertService->uploadPhotos($photos, $id);
        return $this->ok();
    }

    public function deletePhoto(string $uuid)
    {
        $this->concertService->deletePhoto($uuid);
        return $this->noContent();
    }
}
