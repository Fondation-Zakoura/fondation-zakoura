<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStructurePartenaireRequest; // Assurez-vous de créer ce fichier
use App\Http\Requests\UpdateStructurePartenaireRequest; // Assurez-vous de créer ce fichier
use App\Http\Resources\StructurePartenaireResource;   // Assurez-vous de créer ce fichier
use App\Models\StructurePartenaire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StructurePartenaireController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return StructurePartenaireResource::collection(StructurePartenaire::all());
    }

    public function store(StoreStructurePartenaireRequest $request): StructurePartenaireResource
    {
        $structure = StructurePartenaire::create($request->validated());
        return new StructurePartenaireResource($structure);
    }

    public function show(StructurePartenaire $structures_partenaire): StructurePartenaireResource
    {
        return new StructurePartenaireResource($structures_partenaire);
    }

    public function update(UpdateStructurePartenaireRequest $request, StructurePartenaire $structures_partenaire): StructurePartenaireResource
    {
        $structures_partenaire->update($request->validated());
        return new StructurePartenaireResource($structures_partenaire);
    }

    public function destroy(StructurePartenaire $structures_partenaire): JsonResponse
    {
        if ($structures_partenaire->partenaires()->exists()) {
            return response()->json([
                'message' => 'Cette structure est utilisée et ne peut pas être supprimée.'
            ], 409);
        }

        $structures_partenaire->delete();
        return response()->json(null, 204);
    }
}