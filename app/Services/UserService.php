<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserService
{
    private UserRepository $userRepository;
    private FileService $fileService;

    public function __construct(UserRepository $userRepository, FileService $fileService)
    {
        $this->userRepository = $userRepository;
        $this->fileService = $fileService;
    }

    public function uploadPhoto(string $type, array $photos): void
    {
        $user = auth()->user();

        foreach ($photos as $photo)
        {
            $filename = $type . '_' .
                $user->id . '_' .
                Carbon::now()->format('Ymdhis') . '_' .
                Str::random(8);

            $filename .= '.' . $photo->extension();

            $user
                ->addMedia($photo->getPathname())
                ->usingFileName($filename)
                ->toMediaCollection();
        }
    }

    public function getProfilePicture()
    {
        $media = Media::query()
            ->where('model_type', User::class)
            ->where('model_id', auth()->id())
            ->whereJsonContains('custom_properties', ['profilePicture' => true])
            ->first();

        return $this->fileService->getImage('user_profile_pic', $media->uuid);
    }

}