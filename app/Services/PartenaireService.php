<?php

// app/Services/PartenaireService.php
namespace App\Services;

use App\Models\Partenaire;
use App\Repositories\PartenaireRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PartenaireService
{
    protected PartenaireRepository $partenaireRepository;

    public function __construct(PartenaireRepository $partenaireRepository)
    {
        $this->partenaireRepository = $partenaireRepository;
    }

    /**
     * Get a paginated and filtered list of partenaires.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPartenaires(array $filters): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Partenaire::query()
            ->where('is_active', true) 
            ->with([
                'personnesContact',
                'naturePartenaire',
                'structurePartenaire',
                'statut',
            ]);

        // This filter is correct.
        $query->when($filters['nom_partenaire'] ?? null, function ($q, $nom) {
            return $q->where('nom_partenaire', 'like', '%' . $nom . '%');
        });

        // --- CORRECTED FILTERS ---

        // Filter by the foreign key `nature_partenaire_id`
        $query->when($filters['nature_partenaire_id'] ?? null, function ($q, $natureId) {
            return $q->where('nature_partenaire_id', $natureId);
        });

        // This filter is correct as `type_partenaire` is a string column.
        $query->when($filters['type_partenaire'] ?? null, function ($q, $type) {
            return $q->where('type_partenaire', $type);
        });

        // Filter by the foreign key `structure_partenaire_id`
        $query->when($filters['structure_partenaire_id'] ?? null, function ($q, $structureId) {
            return $q->where('structure_partenaire_id', $structureId);
        });

        // Filter by the foreign key `statut_id`
        $query->when($filters['statut_id'] ?? null, function ($q, $statutId) {
            return $q->where('statut_id', $statutId);
        });
        // dd(Partenaire::all());
        // Paginate the results after filtering and sorting
        return $query->latest()->paginate(10);
    }

    /**
     * Create a partenaire and its associated contact person.
     * Uses a transaction to ensure data integrity.
     *
     * @param array $data
     * @return Partenaire
     */
    public function createPartenaire(array $data): Partenaire
    {
        return DB::transaction(function () use ($data): Partenaire {
            $partenaireData = collect($data)->except(['contact_nom', 'contact_prenom', 'contact_poste', 'contact_email', 'contact_telephone'])->toArray();
            $partenaireData['cree_par_id'] = auth()->user()->id;
            // if($partenaireData['cree_par_id'] == null){
            //     $partenaireData['cree_par_id'] = 1;
            // }
            $partenaire = $this->partenaireRepository->create($partenaireData);

            $partenaire->personnesContact()->create([
                'nom' => $data['contact_nom'],
                'prenom' => $data['contact_prenom'],
                'poste' => $data['contact_poste'],
                'email' => $data['contact_email'],
                'telephone' => $data['contact_telephone'],
                'adresse' => $data['contact_adresse'],
            ]);

            return $partenaire;
        });
    }

    /**
     * Update an existing partenaire.
     *
     * @param Partenaire $partenaire
     * @param array $data
     * @return Partenaire
     */
    public function updatePartenaire(Partenaire $partenaire, array $data): Partenaire
    {
        $this->partenaireRepository->update($partenaire->id, $data);
        return $partenaire->fresh();
    }

    /**
     * Delete one or more partenaires.
     *
     * @param array $ids
     * @return int
     */
    public function deletePartenaires(array $ids): int
    {
        // Update is_active to false for all given ids
        return $this->partenaireRepository->deactivate($ids);
    }
}
