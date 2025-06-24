<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonneContact extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'personnes_contact'; // Ajoutez cette ligne

    protected $fillable = [
        'partenaire_id',
        'nom',
        'prenom',
        'poste',
        'email',
        'telephone',
        'adresse',
    ];

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }
}
