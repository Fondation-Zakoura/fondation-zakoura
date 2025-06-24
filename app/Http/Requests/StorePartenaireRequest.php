<?php
// app/Http/Requests/StorePartenaireRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartenaireRequest extends FormRequest
{
    public function authorize(): bool
    {
        // La logique d'autorisation sera gérée par une Policy ou un middleware
        return true;
    }

    public function rules(): array
    {
        return [
            'nom_partenaire' => 'required|string|max:255|unique:partenaires,nom_partenaire', // 
            'abreviation' => 'required|string|max:5', // 
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:partenaires,email',
            'nature_partenaire' => 'required|in:Organisation non gouvernementale,Institution publique,Individu',
            'type_partenaire' => 'required|in:National,International',
            'structure_partenaire' => 'required|in:Publique,Privée,Associative,Coopérative',
            'statut' => 'required|in:Prospection,En discussion,Convention signée,Contrat actif,Archivé',
            'actions' => 'nullable|string',
            'adresse' => 'nullable|string',
            'pays' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'logo_partenaire' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 
            // Validation pour la personne de contact
            'contact_nom' => 'required|string|max:255', // 
            'contact_prenom' => 'required|string|max:255', // 
            'contact_poste' => 'required|string|max:255', // 
            'contact_email' => 'required|email|max:255|unique:personnes_contact,email',
            'contact_telephone' => 'required|string|max:20',
        ];
    }
}