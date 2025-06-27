<?php

namespace App\Repositories;

use App\Models\ProjectType;
/**
 * class ProjectTypeRepository
 */
class ProjectTypeRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return ProjectType::all();
    }

    /**
     * @param int $id ID of the project type to find.
     * @return \App\Models\ProjectType The project type instance.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the project type is not found.
     */
    public function find($id)
    {
        return ProjectType::findOrFail($id);
    }

    /**
     * @param array $data 
     * @return \App\Models\ProjectType
     */
    public function create(array $data)
    {
        return ProjectType::create($data);
    }

    /**
     * @param int $id 
     * @param array $data 
     * @return \App\Models\ProjectType 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function update($id, array $data)
    {
        $type = $this->find($id);
        $type->update($data);
        return $type;
    }

    /**
     * @param int $id
     * @return int 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function delete($id)
    {
        $type = $this->find($id);
        return $type->delete();
    }

    /**
     * @param array $ids 
     * @return int 
     */
    public function bulkDelete(array $ids)
    {
        return ProjectType::whereIn('id', $ids)->delete();
    }
}
