<?php

namespace App\Repositories;

use App\Models\StatutPartenaire;
use Illuminate\Database\Eloquent\Collection;

class StatutPartenaireRepository
{
    /**
     * Get all StatutPartenaire.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return StatutPartenaire::all();
    }

    /**
     * Store a new StatutPartenaire.
     *
     * @param array $data
     * @return StatutPartenaire
     */
    public function store(array $data): StatutPartenaire
    {
        return StatutPartenaire::create($data);
    }

    /**
     * Update an existing StatutPartenaire.
     *
     * @param StatutPartenaire $statut
     * @param array $data
     * @return StatutPartenaire
     */
    public function update(StatutPartenaire $statut, array $data): StatutPartenaire
    {
        $statut->update($data);
        return $statut;
    }

    /**
     * Delete a StatutPartenaire if not used.
     *
     * @param StatutPartenaire $statut
     * @return bool|null
     */
    public function delete(StatutPartenaire $statut): ?bool
    {
        if ($statut->partenaires()->exists()) {
            return false;
        }
        return $statut->delete();
    }
}