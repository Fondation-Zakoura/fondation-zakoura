<?php

namespace App\Services;

use App\Models\ProjectType;
use App\Repositories\ProjectTypeRepository;

class ProjectTypeService
{
    protected $projectTypeRepository;

    public function __construct(ProjectTypeRepository $projectTypeRepository)
    {
        $this->projectTypeRepository = $projectTypeRepository;
    }

    public function getAll()
    {
        return $this->projectTypeRepository->all();
    }

    public function find($id)
    {
        return $this->projectTypeRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->projectTypeRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->projectTypeRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->projectTypeRepository->delete($id);
    }
}
