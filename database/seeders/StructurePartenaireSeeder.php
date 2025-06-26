<?php

namespace Database\Seeders;

use App\Models\StructurePartenaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructurePartenaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $structures = [
        ['nom' => 'Publique'],
        ['nom' => 'Privée'],
        ['nom' => 'Associative'],
        ['nom' => 'Coopérative'],
    ];
    foreach ($structures as $structure) {
        StructurePartenaire::create($structure);
    }
}
}
