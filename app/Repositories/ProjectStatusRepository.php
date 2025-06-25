<?php

namespace App\Repositories;

use App\Models\ProjectStatus;

class ProjectStatusRepository
{
    /**
     * Retrieve all project statuses from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectStatus[]
     */
    public function all()
    {
        return ProjectStatus::all();
    }

    /**
     * Retrieve a project status from the database by ID.
     *
     * @param int $id
     * @return \App\Models\ProjectStatus
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return ProjectStatus::findOrFail($id);
    }

    /**
     * Create a new project status.
     *
     * @param array $data The data to create the project status with.
     * @return \App\Models\ProjectStatus The newly created project status.
     */
    public function create(array $data)
    {
        return ProjectStatus::create($data);
    }

    /**
     * Update a project status in the database.
     *
     * @param int $id The ID of the project status to update.
     * @param array $data The data to update the project status with.
     * @return \App\Models\ProjectStatus The updated project status.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data)
    {
        $status = $this->find($id);
        $status->update($data);
        return $status;
    }

    /**
     * Delete a project status in the database.
     *
     * @param int $id The ID of the project status to delete.
     * @return int The number of affected rows.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $status = $this->find($id);
        return $status->delete();
    }

    /**
     * Delete multiple project statuses by their IDs.
     *
     * @param array $ids An array of project status IDs to delete.
     * @return int The number of affected rows.
     */

    public function bulkDelete(array $ids)
    {
        return ProjectStatus::whereIn('id', $ids)->delete();
    }
}
