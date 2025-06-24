<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNaturePartenaireRequest;
use App\Http\Requests\UpdateNaturePartenaireRequest;
use App\Http\Resources\NaturePartenaireResource;
use App\Models\NaturePartenaire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NaturePartenaireController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return NaturePartenaireResource::collection(NaturePartenaire::all());
    }

    public function store(StoreNaturePartenaireRequest $request): NaturePartenaireResource
    {
        $nature = NaturePartenaire::create($request->validated());
        return new NaturePartenaireResource($nature);
    }

    public function show(NaturePartenaire $natures_partenaire): NaturePartenaireResource
    {
        return new NaturePartenaireResource($natures_partenaire);
    }

    public function update(UpdateNaturePartenaireRequest $request, NaturePartenaire $natures_partenaire): NaturePartenaireResource
    {
        $natures_partenaire->update($request->validated());
        return new NaturePartenaireResource($natures_partenaire);
    }

    public function destroy(NaturePartenaire $natures_partenaire): JsonResponse
    {
        // Règle de sécurité : vérifier si l'option est utilisée
        if ($natures_partenaire->partenaires()->exists()) {
            return response()->json([
                'message' => 'Cette nature est utilisée et ne peut pas être supprimée.'
            ], 409); // 409 Conflict
        }

        $natures_partenaire->delete();

        return response()->json(null, 204); // No Content
    }
}