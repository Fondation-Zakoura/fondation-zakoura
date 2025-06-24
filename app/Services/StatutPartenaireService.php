<?php

namespace App\Services;

use App\Models\StatutPartenaire;
use App\Repositories\StatutPartenaireRepository;
use Illuminate\Database\Eloquent\Collection;

class StatutPartenaireService
{
    protected StatutPartenaireRepository $repository;

    public function __construct(StatutPartenaireRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all StatutPartenaire.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repository->all();
    }

    /**
     * Store a new StatutPartenaire.
     *
     * @param array $data
     * @return StatutPartenaire
     */
    public function store(array $data): StatutPartenaire
    {
        return $this->repository->store($data);
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
        return $this->repository->update($statut, $data);
    }

    /**
     * Delete a StatutPartenaire if not used.
     *
     * @param StatutPartenaire $statut
     * @return bool|null
     */
    public function delete(StatutPartenaire $statut): ?bool
    {
        return $this->repository->delete($statut);
    }
}