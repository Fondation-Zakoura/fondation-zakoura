<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNaturePartenaireRequest;
use App\Http\Requests\UpdateNaturePartenaireRequest;
use App\Http\Resources\NaturePartenaireResource;
use App\Models\NaturePartenaire;
use App\Services\NaturePartenaireService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NaturePartenaireController extends Controller
{
    protected NaturePartenaireService $service;

    public function __construct(NaturePartenaireService $service)
    {
        $this->service = $service;
    }

    public function index(): AnonymousResourceCollection
    {
        return NaturePartenaireResource::collection($this->service->all());
    }

    public function store(StoreNaturePartenaireRequest $request): NaturePartenaireResource
    {
        $nature = $this->service->store($request->validated());
        return new NaturePartenaireResource($nature);
    }

    public function show(NaturePartenaire $natures_partenaire): NaturePartenaireResource
    {
        return new NaturePartenaireResource($natures_partenaire);
    }

    public function update(UpdateNaturePartenaireRequest $request, NaturePartenaire $natures_partenaire): NaturePartenaireResource
    {
        $this->service->update($natures_partenaire, $request->validated());
        return new NaturePartenaireResource($natures_partenaire);
    }

    public function destroy(NaturePartenaire $natures_partenaire): JsonResponse
    {
        if (!$this->service->delete($natures_partenaire)) {
            return response()->json([
                'message' => 'Cette nature est utilisée et ne peut pas être supprimée.'
            ], 409);
        }
        return response()->json(null, 204);
    }
}