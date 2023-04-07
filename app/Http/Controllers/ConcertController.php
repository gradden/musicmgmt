<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConcertRequest;
use App\Http\Resources\ConcertDetailResource;
use App\Http\Resources\ConcertIndexResource;
use App\Http\Resources\ConcertResource;
use App\Services\ConcertService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConcertController extends Controller
{
    private ConcertService $concertService;

    public function __construct(ConcertService $concertService)
    {
        $this->concertService = $concertService;
    }

    /**
     * @OA\Get(
     *   tags={"Concert"},
     *   path="/concerts",
     *   summary="Show all concerts",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ConcertIndexResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function index()
    {
        return $this->json(ConcertIndexResource::make($this->concertService->getAll()));
    }

    /**
     * @OA\Post(
     *   tags={"Concert"},
     *   path="/concerts",
     *   summary="Create Concert",
     *   security={ {"bearerAuth": {} }},
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/ConcertRequest")
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Created",
     *     @OA\JsonContent(ref="#/components/schemas/ConcertResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=422, description="Unprocessable entity"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function store(ConcertRequest $request)
    {
        $data = $request->only([
            'eventName',
            'clubId',
            'createdBy',
            'eventStartDate',
            'eventEndDate',
            'description',
            'income',
            'facebookUrl',
            'livesetUrl',
            'isExpired'
        ]);

        return $this->json(ConcertResource::make($this->concertService->create($data)), Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *   tags={"Concert"},
     *   path="/concerts/{id}",
     *   summary="Show a concert",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the concert",
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ConcertDetailResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function show(int $id)
    {
        return $this->json(ConcertDetailResource::make($this->concertService->show($id)));
    }

    /**
     * @OA\Put(
     *   tags={"Concert"},
     *   path="/concerts/{id}",
     *   summary="Edit a concert object",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the concert",
     *     required=true,
     *   ),
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/ConcertRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ConcertResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=422, description="Unprocessable entity"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function update(int $id, ConcertRequest $request)
    {
        $data = $request->only([
            'eventName',
            'clubId',
            'createdBy',
            'eventStartDate',
            'eventEndDate',
            'description',
            'income',
            'facebookUrl',
            'livesetUrl',
            'isExpired'
        ]);

        return $this->json(ConcertResource::make($this->concertService->update($id, $data)));
    }

    /**
     * @OA\Delete(
     *   tags={"Concert"},
     *   path="/concerts/{id}",
     *   summary="Delete a concert object",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the concert",
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response=204,
     *     description="No content"
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function destroy(int $id)
    {
        $this->concertService->delete($id);
        return $this->noContent();
    }

    /**
     * @OA\Get(
     *   tags={"Concert"},
     *   path="/concerts/user/{userId}",
     *   summary="Get concert objects by userId",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="userId",
     *     in="path",
     *     description="ID of the user",
     *     required=true,
     *   ),
     *   @OA\Parameter(
     *     name="eventType",
     *     in="query",
     *     description="Available values: 'upcoming|past|all'. Defaultly is 'all'",
     *     @OA\Items(
     *             type="string",
     *             enum={"upcoming", "past", "all"},
     *             default="all",
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ConcertIndexResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function indexByUserId(int $userId, Request $request)
    {
        $data['eventType'] = $request->get('eventType') ?? null;
        return $this->json(ConcertIndexResource::make($this->concertService->indexByUserId($userId, $data)));
    }
}
