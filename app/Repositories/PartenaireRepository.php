<?php

namespace App\Repositories;

use App\Models\Partenaire;

class PartenaireRepository
{
    /**
     * Get all partenaires with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all($perPage = 15)
    {
        return Partenaire::paginate($perPage);
    }

    /**
     * Find a partenaire by ID.
     *
     * @param int $id
     * @return Partenaire
     */
    public function find($id)
    {
        return Partenaire::findOrFail($id);
    }

    /**
     * Create a new partenaire.
     *
     * @param array $data
     * @return Partenaire
     */
    public function create(array $data)
    {
        return Partenaire::create($data);
    }

    /**
     * Update a partenaire by ID.
     *
     * @param int $id
     * @param array $data
     * @return Partenaire
     */
    public function update($id, array $data)
    {
        $partenaire = $this->find($id);
        $partenaire->update($data);
        return $partenaire;
    }

    /**
     * Delete a partenaire by ID.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        $partenaire = $this->find($id);
        return $partenaire->delete();
    }

    /**
     * Bulk delete partenaires by IDs.
     *
     * @param array $ids
     * @return int
     */
    public function bulkDelete(array $ids)
    {
        return Partenaire::whereIn('id', $ids)->delete();
    }

    /**
     * Deactivate partenaires by IDs.
     *
     * @param array $ids
     * @return int
     */
    public function deactivate(array $ids): int
    {
        return Partenaire::whereIn('id', $ids)->update(['is_active' => false]);
    }
}