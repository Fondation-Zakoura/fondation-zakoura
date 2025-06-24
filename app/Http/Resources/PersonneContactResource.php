<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonneContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom, 
            'prenom' => $this->prenom, 
            'nom_arabe' => $this->nom_arabe, 
            'prenom_arabe' => $this->prenom_arabe, 
            'poste' => $this->poste, 
            'telephone' => $this->telephone, 
            'email' => $this->email, 
            'adresse' => $this->adresse, 
            'partenaire' => [
                'id' => $this->partenaire->id,
                'nom_partenaire' => $this->partenaire->nom_partenaire,
            ],
            'date_creation' => $this->created_at->format('d/m/Y H:i'), // 
            // On peut inclure l'utilisateur créateur si la relation est chargée
            'cree_par' => new UserResource($this->whenLoaded('creePar')),
        ];
    }
}