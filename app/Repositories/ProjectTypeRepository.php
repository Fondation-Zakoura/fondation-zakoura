<?php

namespace App\Repositories;

use App\Models\ProjectType;

class ProjectTypeRepository
{
    /**
     * Retrieve all project types.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */

    public function all()
    {
        return ProjectType::all();
    }

    /**
     * Find a project type by its ID.
     *
     * @param int $id ID of the project type to find.
     *
     * @return \App\Models\ProjectType The project type instance.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the project type is not found.
     */
    public function find($id)
    {
        return ProjectType::findOrFail($id);
    }

    /**
     * Create a new project type.
     *
     * @param array $data The data to create the project type with.
     *
     * @return \App\Models\ProjectType The newly created project type.
     */
    public function create(array $data)
    {
        return ProjectType::create($data);
    }

    /**
     * Update an existing project type.
     *
     * @param int $id ID of the project type to update.
     * @param array $data Data to update the project type with.
     *
     * @return \App\Models\ProjectType The updated project type.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the project type is not found.
     */
    public function update($id, array $data)
    {
        $type = $this->find($id);
        $type->update($data);
        return $type;
    }

    /**
     * Delete a project type in the database.
     *
     * @param int $id The ID of the project type to delete.
     *
     * @return int The number of affected rows.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the project type is not found.
     */
    public function delete($id)
    {
        $type = $this->find($id);
        return $type->delete();
    }

    /**
     * Delete multiple project types in the database.
     *
     * @param array $ids An array of project type IDs to delete.
     *
     * @return int The number of affected rows.
     */
    public function bulkDelete(array $ids)
    {
        return ProjectType::whereIn('id', $ids)->delete();
    }
}
