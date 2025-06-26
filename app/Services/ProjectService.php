<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectBankAccountRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;

class ProjectService
{
    /** @var ProjectRepository */
    protected ProjectRepository  $projectRepository;

    /**  @var UserRepository */
    protected UserRepository $userRepository;

    /**  @var ProjectBankAccountRepository */
    protected ProjectBankAccountRepository $bankAccountRepository;

    /**
     * @param ProjectRepository $projectRepository
     * @param UserRepository $userRepository
     * @param ProjectBankAccountRepository $bankAccountRepository
     */
    public function __construct(ProjectRepository $projectRepository, UserRepository $userRepository, ProjectBankAccountRepository $bankAccountRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
        $this->bankAccountRepository = $bankAccountRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProjects()
    {
        $query = $this->projectRepository->all();
        return $query->with(['responsible', 'createdBy', 'projectBankAccount','projectType','projectStatus'])->paginate(10); 
    }

    /**
     * @param array $data 
     * @param int|null $responsableId 
     * @param int|null $compteBancaireId
     * @param int $createdById 
     * @return Project 
     * @throws Exception 
     */
    public function createProject(array $data, ?int $responsableId, ?int $compteBancaireId = null, int $createdById): Project
    {
        DB::beginTransaction();
        try {
            $createdByUser = $this->userRepository->findOrFail($createdById);
            $responsibleUser = $responsableId ? $this->userRepository->find($responsableId) : null;
            $bankAccount = $compteBancaireId ? $this->bankAccountRepository->find($compteBancaireId) : null;
            $project = $this->projectRepository->createWithAssociations(
                $data,
                $createdByUser,
                $responsibleUser,
                $bankAccount
            );
            DB::commit();
            return $project;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Failed to create the project.");
        }
    }

   /**
     * @param Project $project 
     * @param array $data 
     * @param int|null $responsableId 
     * @param int|null $compteBancaireId 
     * @return Project 
     * @throws Exception
     */
    public function updateProject(Project $project, array $data, ?int $responsableId, ?int $compteBancaireId = null): Project
    {
        DB::beginTransaction();
        try {
            $responsibleUser = $responsableId ? $this->userRepository->find($responsableId) : null;
            $bankAccount = $compteBancaireId ? $this->bankAccountRepository->find($compteBancaireId) : null;
            $updatedProject = $this->projectRepository->update(
                $project,
                $data,
                $responsibleUser,
                $bankAccount
            );
            DB::commit();
            return $updatedProject;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Failed to update the project.");
        }
    }

    /**
     * @param array $projectIds 
     * @return int 
     * @throws Exception 
     */
    public function deleteProjects(array $projectIds): int
    {
        return $this->projectRepository->bulkDelete($projectIds);
    } 
}
