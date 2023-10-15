<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConcertPhotoRequest;
use App\Http\Requests\UserImageRequest;
use App\Models\User;
use App\Services\ConcertService;
use App\Services\FileService;
use App\Services\UserService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private FileService $fileService;
    private ConcertService $concertService;
    private UserService $userService;

    public function __construct(
        FileService $fileService,
        ConcertService $concertService,
        UserService $userService
    ) {
        $this->fileService = $fileService;
        $this->concertService = $concertService;
        $this->userService = $userService;
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

    public function uploadUserCoverImage(UserImageRequest $request)
    {
        $photos = $request->file('photo');

        $this->userService->uploadPhoto(User::USER_COVER_IMAGE, $photos);
        return $request->wantsJson() ? $this->ok() : null;
    }

    public function deletePhoto(string $uuid)
    {
        $this->concertService->deletePhoto($uuid);
        return $this->noContent();
    }
}
