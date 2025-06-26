<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NaturePartenaire;

class NaturePartenaireSeeder extends Seeder
{
    public function run(): void
    {
        $natures = [
            ['nom' => 'Organisation non gouvernementale'],
            ['nom' => 'Institution publique'],
            ['nom' => 'Individu'],
        ];
        foreach ($natures as $nature) {
            NaturePartenaire::create($nature);
        }
    }
}