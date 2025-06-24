<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartenaireRequest;
use App\Http\Requests\UpdatePartenaireRequest;
use App\Http\Resources\PartenaireResource;
use App\Models\Partenaire;
use App\Services\PartenaireService;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    protected $partenaireService;

    public function __construct(PartenaireService $partenaireService)
    {
        $this->partenaireService = $partenaireService;
    }

    public function index(Request $request)
    {
        $partenaires = $this->partenaireService->getAllPartenaires($request->all());
        return PartenaireResource::collection($partenaires);
    }

    public function store(StorePartenaireRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo_partenaire')) {
            $data['logo_partenaire'] = $request->file('logo_partenaire')->store('logos', 'public');
        }
        $partenaire = $this->partenaireService->createPartenaire($data);
        return new PartenaireResource($partenaire->load(['naturePartenaire', 'structurePartenaire', 'statut']));
    }

    public function show(Partenaire $partenaire)
    {
        return new PartenaireResource($partenaire->load(['personnesContact', 'naturePartenaire', 'structurePartenaire', 'statut']));
    }

    public function update(UpdatePartenaireRequest $request, Partenaire $partenaire)
    {
        $partenaire = $this->partenaireService->updatePartenaire($partenaire, $request->validated());
        return new PartenaireResource($partenaire->load(['naturePartenaire', 'structurePartenaire', 'statut']));
    }

    public function destroy(Partenaire $partenaire)
    {
        $this->partenaireService->deletePartenaires([$partenaire->id]);
        return response()->noContent();
    }
    
    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'exists:partenaires,id']);
        $this->partenaireService->deletePartenaires($request->input('ids'));
        return response()->noContent();
    }
}