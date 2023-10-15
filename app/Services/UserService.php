<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

}