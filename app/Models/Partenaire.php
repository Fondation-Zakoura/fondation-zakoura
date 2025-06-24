<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_partenaire', 'abreviation', 'telephone', 'email', 'actions', 'adresse',
        'pays', 'note', 'logo_partenaire', 'cree_par_id',
        'nature_partenaire_id', 'structure_partenaire_id', 'statut_id','type_partenaire'
    ];

    // Définir les nouvelles relations
    public function naturePartenaire()
    {
        return $this->belongsTo(NaturePartenaire::class , 'nature_partenaire_id');
    }

    public function structurePartenaire()
    {
        return $this->belongsTo(StructurePartenaire::class, 'structure_partenaire_id');
    }

    public function statut()
    {
        return $this->belongsTo(StatutPartenaire::class, 'statut_id');
    }

    // Les autres relations restent inchangées
    public function personnesContact()
    {
        return $this->hasMany(PersonneContact::class);
    }
    // ...
}
