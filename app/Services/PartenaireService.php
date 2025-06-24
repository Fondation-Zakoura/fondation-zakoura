<?php

// app/Services/PartenaireService.php
namespace App\Services;

use App\Models\Partenaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PartenaireService
{
    /**
     * Récupère une liste paginée et filtrée de partenaires.
     */
    public function getAllPartenaires(array $filters)
    {
        $query = Partenaire::query()->with([
            'personnesContact', 
        'naturePartenaire', 
        'structurePartenaire', 
        'statut'
        ]);

        // Application des filtres prévus dans la user story
        $query->when($filters['nom_partenaire'] ?? null, function ($q, $nom) {
            return $q->where('nom_partenaire', 'like', '%' . $nom . '%');
        });
        $query->when($filters['nature_partenaire'] ?? null, function ($q, $nature) {
            return $q->where('nature_partenaire', $nature);
        });
        $query->when($filters['type_partenaire'] ?? null, function ($q, $type) {
            return $q->where('type_partenaire', $type);
        });
        $query->when($filters['structure_partenaire'] ?? null, function ($q, $structure) {
            return $q->where('structure_partenaire', $structure);
        });
         $query->when($filters['statut'] ?? null, function ($q, $statut) {
            return $q->where('statut', $statut);
        });

        return $query->latest()->paginate(10);
    }

    /**
     * Crée un partenaire et sa personne de contact associée.
     * Utilise une transaction pour garantir l'intégrité des données.
     */
    public function createPartenaire(array $data): Partenaire
    {
        return DB::transaction(function () use ($data) {
            $partenaireData = collect($data)->except(['contact_nom', 'contact_prenom', 'contact_poste', 'contact_email', 'contact_telephone'])->toArray();
            $partenaireData['cree_par_id'] = Auth::id();

            $partenaire = Partenaire::create($partenaireData);

            $partenaire->personnesContact()->create([
                'nom' => $data['contact_nom'],
                'prenom' => $data['contact_prenom'],
                'poste' => $data['contact_poste'],
                'email' => $data['contact_email'],
                'telephone' => $data['contact_telephone']
            ]);

            return $partenaire;
        });
    }

    /**
     * Met à jour un partenaire existant.
     */
    public function updatePartenaire(Partenaire $partenaire, array $data): Partenaire
    {
        $partenaire->update($data);
        return $partenaire->fresh(); // Retourne le modèle mis à jour
    }

    /**
     * Supprime un ou plusieurs partenaires.
     */
    public function deletePartenaires(array $ids): int
    {
        return Partenaire::destroy($ids);
    }
}