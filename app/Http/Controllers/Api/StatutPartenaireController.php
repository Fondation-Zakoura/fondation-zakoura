<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatutPartenaireRequest;
use App\Http\Requests\UpdateStatutPartenaireRequest;
use App\Http\Resources\StatutPartenaireResource;  
use App\Models\StatutPartenaire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatutPartenaireController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return StatutPartenaireResource::collection(StatutPartenaire::all());
    }

    public function store(StoreStatutPartenaireRequest $request): StatutPartenaireResource
    {
        $statut = StatutPartenaire::create($request->validated());
        return new StatutPartenaireResource($statut);
    }

    public function show(StatutPartenaire $statuts_partenaire): StatutPartenaireResource
    {
        return new StatutPartenaireResource($statuts_partenaire);
    }

    public function update(UpdateStatutPartenaireRequest $request, StatutPartenaire $statuts_partenaire): StatutPartenaireResource
    {
        $statuts_partenaire->update($request->validated());
        return new StatutPartenaireResource($statuts_partenaire);
    }

    public function destroy(StatutPartenaire $statuts_partenaire): JsonResponse
    {
        if ($statuts_partenaire->partenaires()->exists()) {
            return response()->json([
                'message' => 'Ce statut est utilisé et ne peut pas être supprimé.'
            ], 409);
        }

        $statuts_partenaire->delete();
        return response()->json(null, 204);
    }
}