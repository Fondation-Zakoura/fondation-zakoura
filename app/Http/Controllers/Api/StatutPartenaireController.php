<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatutPartenaireRequest;
use App\Http\Requests\UpdateStatutPartenaireRequest;
use App\Http\Resources\StatutPartenaireResource;  
use App\Models\StatutPartenaire;
use App\Services\StatutPartenaireService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatutPartenaireController extends Controller
{
    protected StatutPartenaireService $service;

    public function __construct(StatutPartenaireService $service)
    {
        $this->service = $service;
    }

    public function index(): AnonymousResourceCollection
    {
        return StatutPartenaireResource::collection($this->service->all());
    }

    public function store(StoreStatutPartenaireRequest $request): StatutPartenaireResource
    {
        $statut = $this->service->store($request->validated());
        return new StatutPartenaireResource($statut);
    }

    public function show(StatutPartenaire $statuts_partenaire): StatutPartenaireResource
    {
        return new StatutPartenaireResource($statuts_partenaire);
    }

    public function update(UpdateStatutPartenaireRequest $request, StatutPartenaire $statuts_partenaire): StatutPartenaireResource
    {
        $this->service->update($statuts_partenaire, $request->validated());
        return new StatutPartenaireResource($statuts_partenaire);
    }

    public function destroy(StatutPartenaire $statuts_partenaire): JsonResponse
    {
        if (!$this->service->delete($statuts_partenaire)) {
            return response()->json([
                'message' => 'Ce statut est utilisé et ne peut pas être supprimé.'
            ], 409);
        }
        return response()->json(null, 204);
    }
}