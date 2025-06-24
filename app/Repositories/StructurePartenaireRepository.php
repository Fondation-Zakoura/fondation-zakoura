<?php

namespace App\Repositories;

use App\Models\StructurePartenaire;
use Illuminate\Database\Eloquent\Collection;

class StructurePartenaireRepository
{
    /**
     * Get all StructurePartenaire.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return StructurePartenaire::all();
    }

    /**
     * Store a new StructurePartenaire.
     *
     * @param array $data
     * @return StructurePartenaire
     */
    public function store(array $data): StructurePartenaire
    {
        return StructurePartenaire::create($data);
    }

    /**
     * Update an existing StructurePartenaire.
     *
     * @param StructurePartenaire $structure
     * @param array $data
     * @return StructurePartenaire
     */
    public function update(StructurePartenaire $structure, array $data): StructurePartenaire
    {
        $structure->update($data);
        return $structure;
    }

    /**
     * Delete a StructurePartenaire if not used.
     *
     * @param StructurePartenaire $structure
     * @return bool|null
     */
    public function delete(StructurePartenaire $structure): ?bool
    {
        if ($structure->partenaires()->exists()) {
            return false;
        }
        return $structure->delete();
    }
}