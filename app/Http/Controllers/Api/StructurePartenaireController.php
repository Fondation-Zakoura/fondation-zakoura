<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStructurePartenaireRequest; // Assurez-vous de créer ce fichier
use App\Http\Requests\UpdateStructurePartenaireRequest; // Assurez-vous de créer ce fichier
use App\Http\Resources\StructurePartenaireResource;   // Assurez-vous de créer ce fichier
use App\Models\StructurePartenaire;
use App\Services\StructurePartenaireService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StructurePartenaireController extends Controller
{
    protected StructurePartenaireService $service;

    public function __construct(StructurePartenaireService $service)
    {
        $this->service = $service;
    }

    public function index(): AnonymousResourceCollection
    {
        return StructurePartenaireResource::collection($this->service->all());
    }

    public function store(StoreStructurePartenaireRequest $request): StructurePartenaireResource
    {
        $structure = $this->service->store($request->validated());
        return new StructurePartenaireResource($structure);
    }

    public function show(StructurePartenaire $structures_partenaire): StructurePartenaireResource
    {
        return new StructurePartenaireResource($structures_partenaire);
    }

    public function update(UpdateStructurePartenaireRequest $request, StructurePartenaire $structures_partenaire): StructurePartenaireResource
    {
        $this->service->update($structures_partenaire, $request->validated());
        return new StructurePartenaireResource($structures_partenaire);
    }

    public function destroy(StructurePartenaire $structures_partenaire): JsonResponse
    {
        if (!$this->service->delete($structures_partenaire)) {
            return response()->json([
                'message' => 'Cette structure est utilisée et ne peut pas être supprimée.'
            ], 409);
        }
        return response()->json(null, 204);
    }
}