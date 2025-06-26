<?php

namespace App\Repositories;

use App\Models\NaturePartenaire;
use Illuminate\Database\Eloquent\Collection;

class NaturePartenaireRepository
{
    /**
     * Get all NaturePartenaire.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return NaturePartenaire::all();
    }

    /**
     * Store a new NaturePartenaire.
     *
     * @param array $data
     * @return NaturePartenaire
     */
    public function store(array $data): NaturePartenaire
    {
        return NaturePartenaire::create($data);
    }

    /**
     * Update an existing NaturePartenaire.
     *
     * @param NaturePartenaire $nature
     * @param array $data
     * @return NaturePartenaire
     */
    public function update(NaturePartenaire $nature, array $data): NaturePartenaire
    {
        $nature->update($data);
        return $nature;
    }

    /**
     * Delete a NaturePartenaire if not used.
     *
     * @param NaturePartenaire $nature
     * @return bool|null
     */
    public function delete(NaturePartenaire $nature): ?bool
    {
        if ($nature->partenaires()->exists()) {
            return false;
        }
        return $nature->delete();
    }
}