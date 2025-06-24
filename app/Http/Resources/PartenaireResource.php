<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartenaireResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom_partenaire' => $this->nom_partenaire,
            'abreviation' => $this->abreviation,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'actions' => $this->actions,
            'adresse' => $this->adresse,
            'pays' => $this->pays,
            'note' => $this->note,
            'logo_url' => $this->logo_partenaire ? asset('storage/' . $this->logo_partenaire) : null,
            'cree_le' => $this->created_at->format('d/m/Y H:i'),

            // Charger les noms depuis les relations
            'nature_partenaire' => $this->whenLoaded('naturePartenaire', $this->naturePartenaire->nom),
            'structure_partenaire' => $this->whenLoaded('structurePartenaire', $this->structurePartenaire->nom),
            'statut' => $this->whenLoaded('statut', $this->statut->nom),
            
            // Inclure les IDs pour faciliter le pré-remplissage des formulaires dans le frontend
            'nature_partenaire_id' => $this->nature_partenaire_id,
            'structure_partenaire_id' => $this->structure_partenaire_id,
            'statut_id' => $this->statut_id,
            
            'personnes_contact' => PersonneContactResource::collection($this->whenLoaded('personnesContact')),
        ];
    }
}