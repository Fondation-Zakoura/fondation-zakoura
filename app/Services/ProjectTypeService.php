<?php

namespace App\Services;

use App\Models\ProjectType;
use App\Repositories\ProjectTypeRepository;

class ProjectTypeService
{
    /** @var ProjectTypeRepository */
    protected ProjectTypeRepository $projectTypeRepository;

    /**
     * @param ProjectTypeRepository $projectTypeRepository
     */
    public function __construct(ProjectTypeRepository $projectTypeRepository)
    {
        $this->projectTypeRepository = $projectTypeRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectType[]
     */
    public function getAll()
    {
        return $this->projectTypeRepository->all();
    }

    /**
     * @param int $id 
     * @return \App\Models\ProjectType
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function find($id)
    {
        return $this->projectTypeRepository->find($id);
    }

    /**
     * @param array $data
     * @return \App\Models\ProjectType 
     */
    public function create(array $data)
    {
        return $this->projectTypeRepository->create($data);
    }

    /*
     * @param int $id ID of the project type to update.
     * @param array $data Data to update the project type with.
     * @return \App\Models\ProjectType The updated project type.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the project type is not found.
     */

    public function update($id, array $data)
    {
        return $this->projectTypeRepository->update($id, $data);
    }

    /**

     * @param int $id 
     * @return int 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function delete($id)
    {
        return $this->projectTypeRepository->delete($id);
    }
}
