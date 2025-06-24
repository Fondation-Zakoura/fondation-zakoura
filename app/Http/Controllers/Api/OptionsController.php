<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NaturePartenaire;
use App\Models\StructurePartenaire;
use App\Models\StatutPartenaire;

class OptionsController extends Controller
{
    public function natures()
    {
        return NaturePartenaire::all(['id', 'nom']);
    }

    public function structures()
    {
        return StructurePartenaire::all(['id', 'nom']);
    }

    public function statuts()
    {
        return StatutPartenaire::all(['id', 'nom']);
    }
}