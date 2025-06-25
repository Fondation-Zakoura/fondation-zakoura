<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    /**
     * Retrieve all projects.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function all()
    {
        return Project::all();
    }

    /**
     * Find a project by its ID.
     *
     * @param int $id ID of the project to find.
     *
     * @return \App\Models\Project The project instance.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the project is not found.
     */
    public function find($id)
    {
        return Project::findOrFail($id);
    }

    /**
     * Create a new project.
     *
     * @param array $data The data to create the project with.
     *
     * @return \App\Models\Project The newly created project instance.
     */
    public function create(array $data)
    {
        return Project::create($data);
    }

    /**
     * Update an existing project.
     *
     * @param int $id ID of the project to update.
     * @param array $data Data to update the project with.
     *
     * @return \App\Models\Project The updated project instance.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the project is not found.
     */
    public function update($id, array $data)
    {
        $project = $this->find($id);
        $project->update($data);
        return $project;
    }

    /**
     * Delete a project by its ID.
     *
     * @param int $id ID of the project to delete.
     *
     * @return int The number of affected rows.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the project is not found.
     */
    public function delete($id)
    {
        $project = $this->find($id);
        return $project->delete();
    }

    /**
     * Delete multiple projects by their IDs.
     *
     * @param array $ids An array of project IDs to delete.
     *
     * @return int The number of affected rows.
     */

    public function bulkDelete(array $ids)
    {
        return Project::whereIn('id', $ids)->delete();
    }
}
