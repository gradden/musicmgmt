<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubRequest;
use App\Http\Resources\ClubIndexResource;
use App\Http\Resources\ClubResource;
use App\Services\ClubService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClubController extends Controller
{
    private ClubService $clubService;

    public function __construct(ClubService $clubService)
    {
        $this->clubService = $clubService;
    }

    /**
     * @OA\Post(
     *   tags={"Club"},
     *   path="/clubs",
     *   summary="Store a club object",
     *   security={ {"bearerAuth": {} }},
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/ClubRequest")
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Created",
     *     @OA\JsonContent(ref="#/components/schemas/ClubResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function store(ClubRequest $request): JsonResponse
    {
        $inputData = $request->only([
            'name', 
            'location', 
            'facebookUrl', 
            'instagramTag', 
            'instagramUrl', 
            'description'
        ]);

        return $this->json(ClubResource::make($this->clubService->createClub($inputData)), Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *   tags={"Club"},
     *   path="/clubs",
     *   summary="Show all stored clubs",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ClubIndexResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function index(): JsonResponse
    {
        return $this->json(ClubIndexResource::make($this->clubService->getAll()));
    }

    /**
     * @OA\Get(
     *   tags={"Club"},
     *   path="/clubs/{id}",
     *   summary="Show a club",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the club",
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ClubResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function show(int $id): JsonResponse
    {
        return $this->json(ClubResource::make($this->clubService->showBy('id', $id)));
    }

    /**
     * @OA\Put(
     *   tags={"Club"},
     *   path="/clubs/{id}",
     *   summary="Edit a club object",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the club",
     *     required=true,
     *   ),
     *   @OA\RequestBody(
     *     @OA\JsonContent(ref="#/components/schemas/ClubRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ClubResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=422, description="Unprocessable entity"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function update(int $id, ClubRequest $request): JsonResponse 
    {
        $inputData = $request->only([
            'name', 
            'location', 
            'facebookUrl', 
            'instagramTag', 
            'instagramUrl', 
            'description'
        ]);

        return $this->json(ClubResource::make($this->clubService->edit($id, $inputData)));
    }

    /**
     * @OA\Delete(
     *   tags={"Club"},
     *   path="/clubs/{id}",
     *   summary="Delete a club object",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the club",
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
        $this->clubService->delete($id);
        return $this->noContent();
    }

    /**
     * @OA\Get(
     *   tags={"Club"},
     *   path="/clubs/search",
     *   summary="Search in clubs object",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="name",
     *     in="query",
     *     description="Name of the club"
     *   ),
     *   @OA\Parameter(
     *     name="location",
     *     in="query",
     *     description="Location of the club"
     *   ),
     *   @OA\Parameter(
     *     name="description",
     *     in="query",
     *     description="Location of the club"
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/ClubIndexResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function searchByName(Request $request)
    {
        $searchParams = $request->only(['name', 'location', 'description']) ?? '';

        return ClubIndexResource::make($this->clubService->searchByName($searchParams));
    }
}

