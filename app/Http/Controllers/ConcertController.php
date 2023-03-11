<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConcertResource;
use App\Services\ConcertService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConcertController extends Controller
{
    private ConcertService $concertService;

    public function __construct(ConcertService $concertService)
    {
        $this->concertService = $concertService;
    }

    public function index()
    {
        return $this->json(ConcertResource::collection($this->concertService->getAll()));
    }
}
