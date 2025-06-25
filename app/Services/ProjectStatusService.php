<?php

namespace App\Services;

use App\Models\ProjectStatus;
use App\Repositories\ProjectStatusRepository;

class ProjectStatusService
{
    protected $projectStatusRepository;

    public function __construct(ProjectStatusRepository $projectStatusRepository)
    {
        $this->projectStatusRepository = $projectStatusRepository;
    }

    public function getAll()
    {
        return $this->projectStatusRepository->all();
    }

    public function find($id)
    {
        return $this->projectStatusRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->projectStatusRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->projectStatusRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->projectStatusRepository->delete($id);
    }
}
