<?php

namespace App\Services;

use App\Models\ProjectStatus;
use App\Repositories\ProjectStatusRepository;

class ProjectStatusService
{
    /**
     * @var ProjectStatusRepository
     */
    protected ProjectStatusRepository $projectStatusRepository;
    /**
     * @param ProjectStatusRepository $projectStatusRepository
     */

    public function __construct(ProjectStatusRepository $projectStatusRepository)
    {
        $this->projectStatusRepository = $projectStatusRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectStatus[]
     */
    public function getAll()
    {
        return $this->projectStatusRepository->all();
    }

    /**
     * @param int $id 
     * @return \App\Models\ProjectStatus
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function find($id)
    {
        return $this->projectStatusRepository->find($id);
    }

    /**
     * @param array $data 
     * @return \App\Models\ProjectStatus
     */

    public function create(array $data)
    {
        return $this->projectStatusRepository->create($data);
    }

    /**
     * @param int $id 
     * @param array $data 
     * @return \App\Models\ProjectStatus 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data)
    {
        return $this->projectStatusRepository->update($id, $data);
    }

    /**
     * @param int $id 
     * @return int
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        return $this->projectStatusRepository->delete($id);
    }
}
