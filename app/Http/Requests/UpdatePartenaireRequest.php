<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePartenaireRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // La logique d'autorisation est gérée par le middleware `auth:sanctum`
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // On récupère l'ID du partenaire depuis la route (ex: /api/partenaires/{partenaire})
        // Laravel injecte automatiquement le modèle 'partenaire' dans la requête.
        $partenaireId = $this->route('partenaire')->id;

        return [
            // --- Champs de l'objet Partenaire ---
            
            // Le nom doit être unique, SAUF pour l'enregistrement que nous mettons à jour.
            'nom_partenaire' => ['required', 'string', 'max:255', Rule::unique('partenaires')->ignore($partenaireId)], //
            
            'abreviation' => 'required|string|max:5', //
            'telephone' => 'nullable|string|max:30',
            
            // L'email doit être unique, SAUF pour l'enregistrement actuel.
            'email' => ['nullable', 'email', 'max:255', Rule::unique('partenaires')->ignore($partenaireId)],
            
            'actions' => 'nullable|string', //
            'adresse' => 'nullable|string', //
            'pays' => 'required|string|max:255', //
            'note' => 'nullable|string', //
            'logo_partenaire' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', //

            // --- Clés étrangères ---
            'nature_partenaire_id' => 'required|exists:nature_partenaires,id', //
            'type_partenaire' => 'required|in:National,International', //
            'structure_partenaire_id' => 'required|exists:structure_partenaires,id', //
            'statut_id' => 'required|exists:statut_partenaires,id', //

            'nom_contact' => 'nullable|string|max:255',
            'prenom_contact' => 'nullable|string|max:255',
            'email_contact' => 'nullable|email|max:255',
            'telephone_contact' => 'nullable|string|max:30',
            'poste_contact' => 'nullable|string|max:255',
            'adresse_contact' => 'nullable|string',

            // Note: Normalement, la mise à jour des personnes de contact se fait via un endpoint dédié
            // pour éviter la complexité. Nous n'incluons donc pas les champs 'contact_*' ici.

        ];
    }
}