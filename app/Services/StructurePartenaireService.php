<?php

namespace App\Services;

use App\Models\StructurePartenaire;
use App\Repositories\StructurePartenaireRepository;
use Illuminate\Database\Eloquent\Collection;

class StructurePartenaireService
{
    protected StructurePartenaireRepository $repository;

    public function __construct(StructurePartenaireRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all StructurePartenaire.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repository->all();
    }

    /**
     * Store a new StructurePartenaire.
     *
     * @param array $data
     * @return StructurePartenaire
     */
    public function store(array $data): StructurePartenaire
    {
        return $this->repository->store($data);
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
        return $this->repository->update($structure, $data);
    }

    /**
     * Delete a StructurePartenaire if not used.
     *
     * @param StructurePartenaire $structure
     * @return bool|null
     */
    public function delete(StructurePartenaire $structure): ?bool
    {
        return $this->repository->delete($structure);
    }
}