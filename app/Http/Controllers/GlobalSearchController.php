<?php

namespace App\Http\Controllers;

use App\Http\Requests\GlobalSearchRequest;
use App\Http\Resources\GlobalSearchResource;
use App\Services\GlobalSearchService;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    private GlobalSearchService $globalSearchService;

    public function __construct(GlobalSearchService $globalSearchService)
    {
        $this->globalSearchService = $globalSearchService;
    }

    /**
     * @OA\Get(
     *   tags={"GlobalSearch"},
     *   path="/global-search",
     *   summary="Search everywhere",
     *   security={ {"bearerAuth": {} }},
     *   @OA\Parameter(
     *     name="input",
     *     in="query",
     *     description="Search parameter",
     *     required=true,
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(ref="#/components/schemas/GlobalSearchResource")
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=422, description="Unprocessable entity"),
     *   @OA\Response(response=500, description="Server error"),
     * )
     */
    public function search(GlobalSearchRequest $request)
    {
        $data = $request->get('input');

        return $this->json(GlobalSearchResource::make($this->globalSearchService->search($data)));
    }
}
