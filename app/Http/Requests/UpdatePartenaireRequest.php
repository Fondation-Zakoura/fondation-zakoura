<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartenaireRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;

    
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_partenaire' => 'required|string|max:255', // 
            'abreviation' => 'required|string|max:5', // 
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'nature_partenaire' => 'required|in:Organisation non gouvernementale,Institution publique,Individu',
            'type_partenaire' => 'required|in:National,International',
            'structure_partenaire' => 'required|in:Publique,Privée,Associative,Coopérative',
            'statut' => 'required|in:Prospection,En discussion,Convention signée,Contrat actif,Archivé',
            'actions' => 'nullable|string',
            'adresse' => 'nullable|string',
            'pays' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'logo_partenaire' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // 
            // Validation pour la personne de contact
            'contact_nom' => 'required|string|max:255', // 
            'contact_prenom' => 'required|string|max:255', // 
            'contact_poste' => 'required|string|max:255', // 
            'contact_email' => 'required|email|max:255',
            'contact_telephone' => 'required|string|max:20',
        ];
    }
}
