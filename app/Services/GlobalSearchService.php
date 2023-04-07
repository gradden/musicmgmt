<?php

namespace App\Services;

use App\Repository\ClubRepository;
use App\Repository\ConcertRepository;
use App\Repository\MediaRepository;
use App\Repository\UserRepository;

class GlobalSearchService
{
    private ClubRepository $clubRepository;
    private ConcertRepository $concertRepository;
    private UserRepository $userRepository;
    private MediaRepository $mediaRepository;


    public function __construct(
        ClubRepository $clubRepository,
        ConcertRepository $concertRepository,
        UserRepository $userRepository,
        MediaRepository $mediaRepository
    ) {
        $this->clubRepository = $clubRepository;
        $this->concertRepository = $concertRepository;
        $this->userRepository = $userRepository;
        $this->mediaRepository = $mediaRepository;
    }

    public function search(string $input)
    {
        return [
            'clubs' => $this->clubSearch($input),
            'concerts' => $this->concertSearch($input),
            'users' => $this->userSearch($input),
            'images' => $this->imageSearch($input)
        ];
    }

    private function clubSearch(string $input)
    {
        return $this->clubRepository->search($input);
    }

    private function concertSearch(string $input)
    {
        return $this->concertRepository->search($input);
    }

    private function imageSearch(string $input)
    {
        return $this->mediaRepository->searchWithConcerts($input);
    }

    private function userSearch(string $input)
    {
        return $this->userRepository->search($input);
    }
}