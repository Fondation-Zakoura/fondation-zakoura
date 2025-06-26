<?php

namespace App\Services;

use App\Models\NaturePartenaire;
use App\Repositories\NaturePartenaireRepository;
use Illuminate\Database\Eloquent\Collection;

class NaturePartenaireService
{
    protected NaturePartenaireRepository $repository;

    public function __construct(NaturePartenaireRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all NaturePartenaire.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repository->all();
    }

    /**
     * Store a new NaturePartenaire.
     *
     * @param array $data
     * @return NaturePartenaire
     */
    public function store(array $data): NaturePartenaire
    {
        return $this->repository->store($data);
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
        return $this->repository->update($nature, $data);
    }

    /**
     * Delete a NaturePartenaire if not used.
     *
     * @param NaturePartenaire $nature
     * @return bool|null
     */
    public function delete(NaturePartenaire $nature): ?bool
    {
        return $this->repository->delete($nature);
    }
}