<?php

namespace App\Repositories;

use App\Models\ProjectStatus;
/**
 * class ProjectStatusRepository
 */
class ProjectStatusRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectStatus[]
     */
    public function all()
    {
        return ProjectStatus::all();
    }

    /**
     * @param int $id
     * @return \App\Models\ProjectStatus
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return ProjectStatus::findOrFail($id);
    }

    /**
     * @param array $data
     * @return \App\Models\ProjectStatus
     */
    public function create(array $data)
    {
        return ProjectStatus::create($data);
    }

    /**
     * @param int $id 
     * @param array $data 
     * @return \App\Models\ProjectStatus 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data)
    {
        $status = $this->find($id);
        $status->update($data);
        return $status;
    }

    /**
     * @param int $id
     * @return int 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $status = $this->find($id);
        return $status->delete();
    }

    /**
     * @param array $ids
     * @return int
     */
    public function bulkDelete(array $ids)
    {
        return ProjectStatus::whereIn('id', $ids)->delete();
    }
}
