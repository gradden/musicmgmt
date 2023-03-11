<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequest;
use App\Http\Resources\ClubResource;
use App\Services\ClubService;
use Illuminate\Http\JsonResponse;

class ClubController extends Controller
{
    private ClubService $clubService;

    public function __construct(ClubService $clubService)
    {
        $this->clubService = $clubService;
    }

    public function store(ClubRequest $request): JsonResponse
    {
        $inputData = $request->only(['name', 'location', 'facebookUrl', 'instagramTag', 'instagramUrl', 'description']);

        return $this->json(ClubResource::make($this->clubService->createClub($inputData)), 201);
    }

    public function index(): JsonResponse
    {
        return $this->json(ClubResource::collection($this->clubService->getAll()));
    }

    public function show(int $id): JsonResponse
    {
        return $this->json(ClubResource::make($this->clubService->showBy('id', $id)));
    }

}

