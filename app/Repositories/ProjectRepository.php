<?php

namespace App\Repositories;

use App\Models\ProjectBankAccount;
use App\Models\Project;
use App\Models\User;

/**
 * class ProjectRepository
 */
class ProjectRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function all()
    {
        return Project::query();
    }

    /**
     * @param int $id 
     * @return \App\Models\Project 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException 
     */
    public function find($id)
    {
        return Project::findOrFail($id);
    }

    /**
     * @param array $data 
     * @return \App\Models\Project
     */
    public function create(array $data)
    {
        return Project::create($data);
    }

    /**
     * @param array $data
     * @param User $createdByUser
     * @param User|null $responsibleUser 
     * @param ProjectBankAccount|null $bankAccount
     * @return Project
     */
    public function createWithAssociations(array $data,User $createdByUser,?User $responsibleUser,?ProjectBankAccount $bankAccount): Project {
        $project = new Project($data);
        $project->createdBy()->associate($createdByUser);
        if ($responsibleUser) {
            $project->responsible()->associate($responsibleUser);
        }
        if ($bankAccount) {
            $project->projectBankAccount()->associate($bankAccount);
        }
        $project->save();
        return $project;
    }

   /**
     * @param Project $project
     * @param array $data 
     * @param User|null $responsibleUser 
     * @param ProjectBankAccount|null $bankAccount
     * @return Project 
     */
    public function update(
        Project $project,
        array $data,
        ?User $responsibleUser,
        ?ProjectBankAccount $bankAccount
    ): Project {
        $project->fill($data);
        $project->responsible()->associate($responsibleUser);
        $project->projectBankAccount()->associate($bankAccount);
        $project->save();
        return $project;
    }

    /**
     * @param int $id 
     * @return int 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $project = $this->find($id);
        return $project->delete();
    }

    /**
     * @param array $ids
     * @return int
     */

    public function bulkDelete(array $ids)
    {
        return Project::whereIn('id', $ids)->delete();
    }
    /**
     * @param array $data 
     * @return \App\Models\Project 
     */

    public function make(array $data): Project
    {
        return new Project($data);
    }

    /**
     * @param Project $project 
     * @return bool
     */
    public function save(Project $project): bool
    {
        return $project->save();
    }
}
