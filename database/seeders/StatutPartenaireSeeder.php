<?php

namespace Database\Seeders;

use App\Models\StatutPartenaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatutPartenaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $statuts = [
        ['nom' => 'Prospection'],
        ['nom' => 'En discussion'],
        ['nom' => 'Convention signée'],
        ['nom' => 'Contrat actif'],
        ['nom' => 'Archivé'],
    ];
    foreach ($statuts as $statut) {
        StatutPartenaire::create($statut);
    }
}
}
