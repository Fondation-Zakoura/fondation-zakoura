<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartenaireRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Pour l'instant, nous autorisons tout le monde, car la protection est gérée
        // par le middleware 'auth:sanctum' sur la route.
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
            // --- Champs de l'objet Partenaire ---
            'nom_partenaire' => 'required|string|max:255|unique:partenaires,nom_partenaire', // 
            'abreviation' => 'required|string|max:5', // 
            'telephone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255|unique:partenaires,email',
            'actions' => 'nullable|string', // 
            'adresse' => 'nullable|string', // 
            'pays' => 'required|string|max:255', // 
            'note' => 'nullable|string', // 
            'logo_partenaire' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // 

            // --- Clés étrangères (après refactorisation) ---
            // On valide que l'ID envoyé existe bien dans la table correspondante.
            'nature_partenaire_id' => 'required|exists:nature_partenaires,id', // 
            'type_partenaire' => 'required|in:National,International', // 
            'structure_partenaire_id' => 'required|exists:structure_partenaires,id', // 
            'statut_id' => 'required|exists:statut_partenaires,id', // 

            // --- Champs pour la création de la Personne de Contact associée ---
            'contact_nom' => 'required|string|max:255', // 
            'contact_prenom' => 'required|string|max:255', // 
            'contact_poste' => 'required|string|max:255', // 
            'contact_email' => 'required|email|max:255|unique:personnes_contact,email', // 
            'contact_telephone' => 'required|string|max:30', // 
        ];
    }
}